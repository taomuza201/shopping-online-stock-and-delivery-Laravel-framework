<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Product_tags;
use Illuminate\Http\Request;

class shopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo $request->get('tags');

        if ($request->get('tags') == '' && $request->get('search') != '') {
        $product = Product::whereNotIn('products_type', ['post'])->where('products_name', 'like', '%' . $request->get('search') . '%')->get();
        
        } else if ($request->get('tags') == '') {
            $product = Product::inRandomOrder()->get();
        } else {
            $product = Product_tags::join('products', 'product_tags.products_id', '=', 'products.products_id')->where('product_tags.tags_id', $request->get('tags'))->
                whereNotIn('products_type', ['post'])
                ->get();
        }
     

       
 
        return view('welcome', compact('product'));
    }

    public function detail($id)
    {

        $comment = Comment::where('products_id', $id)->get();
        $product = Product::find($id);
        $product_story = str_replace("../../uploads_image", "../uploads_image", $product->products_story);
        return view('show.detail', compact('product', 'product_story', 'comment'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
