<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\OrderMade;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success(Order::with('items','items.product')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products' => 'array|required',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required',
            'delievery_method' => 'required',
            'phone'  =>  'required',
            'email'  =>  'email|required',
            'location'  =>  'required',
        ]);

        if($validator->fails()) {
            return response()->fail($validator->errors(), 422);
        }

        $products = collect($request->products)->mapWithKeys(function($item){
            return [$item['product_id'] => $item['quantity']];
        })->toArray();

        $productsArr = [];

        $order = new Order;

        $order->total = 0.0;
        $order->user_id = auth()->user()->id;
        $order->delievery_method = $request->delievery_method;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->location = $request->delievery_method;
        $order->status = 'pending';

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
