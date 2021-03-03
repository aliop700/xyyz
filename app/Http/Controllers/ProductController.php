<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Actions\UploadFileAction;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success(Product::whereNotNUll('id')->with('car')->get(), 200);
    }
    public function productDetails(Request $request, $id)
    {
        return response()->success(Product::whereNotNUll('id')->with('car')->get(), 200);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }
    public function view()
    {
        return view('product.view');
    }
    
    // public function checkout()
    // {
    //     return view('product.checkout');
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'name_ar'  =>  'required',
            'image'  =>  'file',
            'price' => 'required',
            'desc' => 'required',
            'desc_ar' => 'required',
            'car_id' => 'exists:cars,id'
        ]);

        if($validator->fails()) {
            return response()->fail($validator->errors(), 422);
        }

        $data = request()->only('name','name_ar','price','desc','desc_ar');

        $data['car_id'] = 0;
        if($request->has('car_id'))
            $data['car_id'] = $request->car_id;
        
        if($request->has('image')) {
            
            $file = (new UploadFileAction)($request->file('image'));
            $data['image'] = $file->id;
        }
        

        $product = Product::create($data);

        return response()->success($product, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.view')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit')->with(compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'name_ar'  =>  'required',
            'image'  =>  'file',
            'price' => 'required',
            'desc' => 'required',
            'desc_ar' => 'required',
            'car_id' => 'exists:cars,id'
        ]);

        if($validator->fails()) {
            return response()->fail($validator->errors(), 422);
        }

        try {
            $data = $request->validated(); 
            if($request->has('image')) {
                
                $file = (new UploadFileAction)($request->file('image'));
                $fileId = $file->id;

                $data+= ['image' => $fileId];
            }

            DB::table(Product::getTable())->where('id', $product->id)->update();
        } catch(\Exception $e) {
            return response()->fail('something went wrong' ,400);
        }

        return response()->success(Product::find($product->id), 202);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->success('deleted', 204);
    }
}
