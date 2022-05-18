<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Products_log;
use App\Models\Product_tags;
use App\Models\Proposal;
use App\Models\Proposal_tag;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proposal = Proposal::find($id);
        $tags = tag::get();
        $proposals_tags = Proposal_tag::where('proposals_id', '=', $id)->select('tags_id')->get();
        return view('products.addproduct', compact('proposal', 'tags', 'proposals_tags'));
    }
    function list() {
        $product = Product::select('*')->where('products_type','normal')->get();
        return view('products.index', compact('product'));
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

    public function upload(Request $request)
    {
        $fileName = time() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('uploads_image'), $fileName);
        $url = "../uploads_image/" . $fileName;
        return response()->json(['location' => $url]);
    }

    public function upload_update(Request $request)
    {
        $fileName = time() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('uploads_image'), $fileName);
        // $url = "../uploads_image/".$fileName;
        // return response()->json(['location' => $url ]);
        $url = "../../uploads_image/" . $fileName;
        return response()->json(['location' => $url]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $proposal = Proposal::find($id);

        $product = new Product();
        $product->products_name = $request->products_name;
        $product->products_name_short = $request->products_name_short;
        $product->products_about_short = $request->products_about_short;
        $product->products_about_size = $request->products_about_size;
        $product->products_price_cost = $request->products_price_cost;
        $product->products_price = $request->products_price;
        $product->products_amount = $request->products_amount;
        $product->products_proposals_id = $proposal->proposals_id;

        if ($request->products_cover_photo == '') {
            $product->products_cover_photo = $proposal->proposals_cover_photo;
        } else {
            $clientOriginalName = $request->products_cover_photo->getClientOriginalName();
            $newFileName = time() . $clientOriginalName;
            $request->products_cover_photo->move(public_path() . '/uploads_image/', $newFileName);
            $product->products_cover_photo = $newFileName;
        }
        $product->products_story = str_replace("uploads_image", "../uploads_image", $request->products_story);
        $product->products_owner_id = $proposal->proposals_owner_id;

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

        //บันทึกหมวดหม่สินค้า
        foreach ($request->tags as $tags) {
            $data = new Product_tags();
            $data->products_id = $id;
            $data->tags_id = $tags;
            $data->save();
        }
        //เปลี่ยนสถานะ proposal
        $proposal_check_status = Proposal::find($id);
        $proposal_check_status->proposals_status = 5;
        $proposal_check_status->save();
        return Redirect::to('/proposal-list-request');
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
        $tags = tag::get();
        $products_tags = Product_tags::where('products_id', '=', $id)->select('tags_id')->get();
        $product = Product::find($id);

        $dataimg = "";

        if ($product->products_photo_1 != '') {
            $dataimg = "{id:1,src:'" . asset('uploads_image/' . $product->products_photo_1) . "'}";
        }
        if ($product->products_photo_2 != '') {
            $dataimg .= ",{id:2,src:'" . asset('uploads_image/' . $product->products_photo_2) . "'}";
        }
        if ($product->products_photo_3 != '') {
            $dataimg .= ",{id:3,src:'" . asset('uploads_image/' . $product->products_photo_3) . "'}";
        }
        if ($product->products_photo_4 != '') {
            $dataimg .= ",{id:4,src:'" . asset('uploads_image/' . $product->products_photo_4) . "'}";
        }
        if ($product->products_photo_5 != '') {
            $dataimg .= ",{id:5,src:'" . asset('uploads_image/' . $product->products_photo_5) . "'}";
        }

        return view('products.detail', compact('product', 'tags', 'products_tags', 'dataimg'));
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

        $product_check = Product::find($id);

        $product = Product::find($id);
        $product->products_name = $request->products_name;
        $product->products_name_short = $request->products_name_short;
        $product->products_about_short = $request->products_about_short;
        $product->products_about_size = $request->products_about_size;
        $product->products_price = $request->products_price;
        $product->products_amount = $request->products_amount;

        if ($request->products_cover_photo == '') {

        } else {

            $clientOriginalName = $request->products_cover_photo->getClientOriginalName();
            $newFileName = time() . $clientOriginalName;
            $request->products_cover_photo->move(public_path() . '/uploads_image/', $newFileName);
            $product->products_cover_photo = $newFileName;
        }
        // $product->products_story = str_replace("uploads_image", "../uploads_image", $request->products_story);
        $product->products_story = $request->products_story;
        if ($request->file('images') != '') {
            $check_image_no = 1;
            $product->products_photo_1 = '';
            $product->products_photo_2 = '';
            $product->products_photo_3 = '';
            $product->products_photo_4 = '';
            $product->products_photo_5 = '';
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
        }

        $product->save();
        //ลบแท็ก
        $tags_delete = DB::table('product_tags')->where('products_id', $id)->delete();

        //บันทึกหมวดหม่สินค้า
        foreach ($request->tags as $tags) {
            $data = new Product_tags();
            $data->products_id = $id;
            $data->tags_id = $tags;
            $data->save();
        }

        $amount = $product_check->products_amount - $request->products_amount;

        if ($amount != 0) {

            $log = new Products_log();
            $log->products_logs_amount = $amount;
            if ($product_check < $request->products_amount) {
                $log->products_logs_status = "add";
            } else {
                $log->products_logs_status = "reduce";
            }

            $log->products_id = $id;
            $log->products_logs_make_by = Auth::user()->id;
            $log->save();
        }

        return redirect()->back();
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
