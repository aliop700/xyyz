<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success(Product::all(), 200);
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
            // 'image'  =>  'required',
            'price' => 'required',
            'car_id' => 'required|exists:cars,id'
        ]);

        if($validator->fails()) {
            return response()->fail($validator->errors(), 422);
        }

        $data = request()->only('name','name_ara','price','car_id');

        $data['image'] = '1.png';

        $product = Product::create($data);

        return response()->success($product, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show')->with(compact('product'));
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
            // 'image'  =>  'file',
            'price' => 'required',
            'car_id' => 'required|exists:cars,id'
        ]);

        if($validator->fails()) {
            return response()->fail($validator->errors(), 422);
        }

        try {
            DB::table(Product::getTable())->where('id', $product->id)->update($request->validated());
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
