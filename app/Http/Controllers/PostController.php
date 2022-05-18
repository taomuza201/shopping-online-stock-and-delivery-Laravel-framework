<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select('*')->where('products_type','post')->get();
        return view('post.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

        $product = new Product();
        $product->products_name = $request->products_name;


        $product->products_price_cost = 0;
        $product->products_price = 0;
        $product->products_amount = 0;


 
        $product->products_cover_photo = 'none';
        $product->products_type = 'post';
       
      
     

        $check_image_no = 1;
        foreach ($request->file('images') as $file) {
            if ($check_image_no == 1) {
                $clientOriginalName = $file->getClientOriginalName();
                $newFileName = time() . $clientOriginalName;
                $file->move(public_path() . '/uploads_image/', $newFileName);
                $product->products_photo_1 = $newFileName;
            } elseif ($check_image_no == 2) {
                $clientOriginalName = $file->getClientOriginalName();
                $newFileName = time() . $clientOriginalName;
                $file->move(public_path() . '/uploads_image/', $newFileName);
                $product->products_photo_2 = $newFileName;
            } elseif ($check_image_no == 3) {
                $clientOriginalName = $file->getClientOriginalName();
                $newFileName = time() . $clientOriginalName;
                $file->move(public_path() . '/uploads_image/', $newFileName);
                $product->products_photo_3 = $newFileName;
            } elseif ($check_image_no == 4) {
                $clientOriginalName = $file->getClientOriginalName();
                $newFileName = time() . $clientOriginalName;
                $file->move(public_path() . '/uploads_image/', $newFileName);
                $product->products_photo_4 = $newFileName;
            } elseif ($check_image_no == 5) {
                $clientOriginalName = $file->getClientOriginalName();
                $newFileName = time() . $clientOriginalName;
                $file->move(public_path() . '/uploads_image/', $newFileName);
                $product->products_photo_5 = $newFileName;
            }
            $check_image_no++;
        }
        $product->save();

      
             return redirect('post');
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
        $product = Product::find($id);
        $dataimg="";
        if( $product->products_photo_1 !=''){
            $dataimg = "{id:1,src:'".asset('uploads_image/'.$product->products_photo_1)."'}";
        }
        if( $product->products_photo_2 !=''){
            $dataimg .= ",{id:2,src:'".asset('uploads_image/'.$product->products_photo_2)."'}";
        }
        if( $product->products_photo_3 !=''){
            $dataimg .= ",{id:3,src:'".asset('uploads_image/'.$product->products_photo_3)."'}";
        }
        if( $product->products_photo_4 !=''){
            $dataimg .= ",{id:4,src:'".asset('uploads_image/'.$product->products_photo_4)."'}";
        }
        if( $product->products_photo_5 !=''){
            $dataimg .= ",{id:5,src:'".asset('uploads_image/'.$product->products_photo_5)."'}";
        }


        return view('post.edit',compact('product','dataimg'));
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
        $product = Product::find($id);
        $product->products_name = $request->products_name;
        if($request->file('images')  !=''){
            $check_image_no = 1;
            $product->products_photo_1 ='';
            $product->products_photo_2 ='';
            $product->products_photo_3 ='';
            $product->products_photo_4 ='';
            $product->products_photo_5 ='';
            foreach ($request->file('images') as $file) {

                if ($check_image_no == 1) {
                    $clientOriginalName = $file->getClientOriginalName();
                    $newFileName = time() . $clientOriginalName;
                    $file->move(public_path() . '/uploads_image/', $newFileName);
                    $product->products_photo_1 = $newFileName;
                    echo $newFileName;
                } elseif ($check_image_no == 2) {
                    $clientOriginalName = $file->getClientOriginalName();
                    $newFileName = time() . $clientOriginalName;
                    $file->move(public_path() . '/uploads_image/', $newFileName);
                    $product->products_photo_2 = $newFileName;
                    echo $newFileName;
                } elseif ($check_image_no == 3) {
                    $clientOriginalName = $file->getClientOriginalName();
                    $newFileName = time() . $clientOriginalName;
                    $file->move(public_path() . '/uploads_image/', $newFileName);
                    $product->products_photo_3 = $newFileName;
                    echo $newFileName;
                } elseif ($check_image_no == 4) {
                    $clientOriginalName = $file->getClientOriginalName();
                    $newFileName = time() . $clientOriginalName;
                    $file->move(public_path() . '/uploads_image/', $newFileName);
                    $product->products_photo_4 = $newFileName;
                    echo $newFileName;
                } elseif ($check_image_no == 5) {
                    $clientOriginalName = $file->getClientOriginalName();
                    $newFileName = time() . $clientOriginalName;
                    $file->move(public_path() . '/uploads_image/', $newFileName);
                    $product->products_photo_5 = $newFileName;
                    echo $newFileName;
                }
                $check_image_no++;
            }
        }
        $product->save();

        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('post');
    }
}
