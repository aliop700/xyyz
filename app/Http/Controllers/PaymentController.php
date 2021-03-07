<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Product;
use App\Order;
use App\OrderItem;
use App\Events\OrderMade;

class PaymentController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('payment.checkout');
    }
    public function checkoutSuccessful()
    {
        return view('payment.checkoutSuccessful');
    }
    public function getProductPrices(array $product_ids){
        $products = Product::whereIn('id', array_keys($product_ids))->get();
        $amount = 0;
        foreach($products as $product){
            $amount += $product->price * ($product_ids[$product->id]);
        }
        return $amount;
    }
    public function postPaymentWithpaypal(Request $request)
    {   
        $items_list = json_decode($request->get('items_list'));
        $request->session()->put('payment_request', $request->all());

        $max = count($items_list);
        $product_ids = [];
       
        $custom_items_to_paypal = [];
        

        foreach($items_list as $key => $item){
            $product_ids[$item->id] = $item->quantity;

            $custom_items_to_paypal[$key] = new Item();
            $custom_items_to_paypal[$key]->setName($item->name)
                ->setCurrency('USD')
                ->setQuantity($item->quantity)
                ->setPrice($item->price);
        }

        $item_list_to_paypal = new ItemList();
        $item_list_to_paypal->setItems($custom_items_to_paypal);

        $total_prices = $this->getProductPrices($product_ids);
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total_prices);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list_to_paypal);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('paywithpaypal');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
    	return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');
        $payment_request =  $request->session()->get('payment_request');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error',__("Payment failed !!"));
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {   
            $payment_result = $result;
            
            $data = ['paypal' => $payment_result, 'payment_request' => $payment_request];

            $this->saveOrder($data);
            \Session::put('success','Payment success !!');
            return Redirect::route('checkoutSuccessful');
        }

        \Session::put('error','__("Payment failed !!")' );
		return Redirect::route('paywithpaypal');
    }

    public function saveOrder(array $data)
    {        
        $products = collect( json_decode($data['payment_request']['items_list'], true))->mapWithKeys(function($item){
            return [$item['id'] => $item['quantity']];
        })->toArray();
        
        $productsArr = [];
        $order = new Order;

        $order->total = 0.0;
        $order->user_id = auth()->user()->id;
        $order->delievery_method =$data['payment_request']['delivery_method'];
        $order->phone = $data['payment_request']['phone'];
        $order->email = $data['payment_request']['email'];
        $order->location = $data['payment_request']['location'];
        $order->status = 'pending';
        $order->payment_id = $data['paypal']->id;

        $order->save();

        $productsRec = Product::whereIn('id', array_keys($products))->get();

        foreach($productsRec as $product) {
            $orderItem = new OrderItem;
            $orderItem->product_id = $product->id;
            $orderItem->price = $product->price;
            $orderItem->quantity = $products[$product->id];
            $order->items()->save($orderItem);

        }

        $order->reCalculateTotal();
        
        event(new OrderMade($order, auth()->user()));
        return response()->success($order);




    }
}