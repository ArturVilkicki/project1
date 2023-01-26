<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('getStock', 'tag')->paginate(20);

        return view('products.index', compact(
          'products'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        Cache::forever("product_query_results", $product);

        $relatedProducts = Product::where('id','!=', $product->id)->take(3)->get();

        return view('products.single', compact('product', 'relatedProducts'));

    }

    public function api()
    {
        $products = Product::all();

        return response()->json(['products' => $products]);
    }

}
