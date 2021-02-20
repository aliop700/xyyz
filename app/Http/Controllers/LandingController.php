<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class LandingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::all();
        return view('home')->with(compact('products'));
    }
}
