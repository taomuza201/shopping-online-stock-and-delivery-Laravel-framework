<?php

namespace App\Http\Controllers;

use App\Models\Hold;
use App\Models\HoldDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class HoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $product = Product::get();
        $hold = Hold::join('users', 'holds.holds_users_id', '=', 'users.id')->where('holds_users_id', Auth::user()->id)
            ->whereNotIn('holds_status', ['n10', 'p11'])
            ->get();
        return view('hold.index', compact('product', 'hold'));
    }

    public function all()
    {

        $product = Product::get();
        $hold = Hold::join('users', 'holds.holds_users_id', '=', 'users.id')
            ->whereNotIn('holds_status', ['n10', 'p11'])
            ->get();
        return view('hold.index', compact('product', 'hold'));
    }

    public function check_order($id, Request $request)
    {

        $hold_detail = HoldDetail::where('hold_details_hold_id', $id)
            ->get();
        $check_order = 'none';
        foreach ($hold_detail as $row) {

            $dataproduct = Product::find($row->hold_details_products_id);
            if ($row->hold_details_products_amount > $dataproduct->products_amount) {
                $check_order = 'yes';
            }
        }

        return response()->json($check_order);
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
        $last = Hold::OrderBy('holds_id', 'DESC')->first();

        if ($last == '') {

            $now = date('dmYHis', strtotime(now()));
            $invID = str_pad(1, 4, '0', STR_PAD_LEFT);

            $last = $now . $invID;
        } else {

            $now = date('dmYHis', strtotime(now()));
            $invID = str_pad($last->holds_id, 4, '0', STR_PAD_LEFT);
            $last = $now . $invID;
        }

        $hold = new Hold();
        $hold->holds_code = $last;
        $hold->holds_name = $request->holds_name;
        $hold->holds_tel = $request->holds_tel;
        $hold->holds_detail = $request->holds_detail;
        $hold->holds_status = 'start';

        $hold->holds_users_id = Auth::user()->id;
        $hold->save();

        // return redirect()->back();
        $last_store = Hold::OrderBy('holds_id', 'DESC')->first();
        return redirect('hold-details/' . $last_store->holds_id);
    }

    public function details($id)
    {

        $hold_detail = HoldDetail::where('hold_details_hold_id', $id)
            ->join('holds', 'hold_details.hold_details_hold_id', '=', 'holds.holds_id')
            ->join('products', 'hold_details.hold_details_products_id', '=', 'products.products_id')
            ->get();
        $product = Product::where('products_amount', '>', 0)->get();
        $hold = Hold::find($id);

        $provinces = DB::table('provinces')->get();
        $amphures = DB::table('amphures')->get();
        $districts = DB::table('districts')->get();
        return view('hold.details', compact('hold', 'product', 'hold_detail', 'provinces', 'amphures', 'districts'));
    }

    public function store_details(Request $request)
    {
        $check_hold_detail = HoldDetail::where('hold_details_hold_id', $request->holds_id)
            ->where('hold_details_products_id', $request->hold_details_products_id)->first();

        if ($check_hold_detail != '') {
            $data = HoldDetail::find($check_hold_detail->hold_details_id);
            $data->hold_details_products_amount = $request->hold_details_products_amount + $check_hold_detail->hold_details_products_amount;

            $data->save();

        } else {
            $product = Product::find($request->hold_details_products_id);
            $data = new HoldDetail();
            $data->hold_details_products_amount = $request->hold_details_products_amount;
            $data->hold_details_products_price = $product->products_price;
            $data->hold_details_products_id = $request->hold_details_products_id;
            $data->hold_details_hold_id = $request->holds_id;
            $data->save();
        }

        // print_r($request->all());
        return redirect()->back();
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
    public function showproduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function showproduct_detail($id)
    {
        $data = HoldDetail::find($id);
        $product = Product::find($data->hold_details_products_id);

        return response()->json([$data, $product]);
    }
    public function update_details(Request $request, $id)
    {
        $data = HoldDetail::find($id);
        $data->hold_details_products_amount = $request->hold_details_products_amount_edit;
        $data->save();
        return redirect()->back();
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
    public function status($status, $id, Request $request)
    {
        $hold = Hold::find($id);
        $hold->holds_status = $status;

        if ($status == 'n3' || $status == 'p3') {
            $hold->holds_house_number = $request->get('house_number');
            $hold->holds_village = $request->get('village');
            $hold->holds_alley = $request->get('alley');
            $hold->holds_road = $request->get('road');

            $provinces = DB::table('provinces')->where('id', $request->get('provinces'))->first();
            $amphures = DB::table('amphures')->where('id', $request->get('amphures'))->first();
            $hold->holds_provinces = $provinces->id;
            $hold->holds_amphures = $amphures->id;
            $hold->holds_districts = $request->get('districts');
            $hold->holds_zip_code = $request->get('zip_code');
        }

        if ($status == 'n5' || $status == 'p6') {
            $hold->holds_transport_number = $request->get('holds_transport_number');
        }

        if ($status == 'n2' || $status == 'p2') {

            $hold_detail = HoldDetail::where('hold_details_hold_id', $id)
                ->get();

            foreach ($hold_detail as $row) {
                $product = Product::find($row->hold_details_products_id);
                $product_data = Product::find($row->hold_details_products_id);
                $product->products_amount = $product_data->products_amount - $row->hold_details_products_amount;
                $product->save();
            }
        }
        $hold->save();
    }

    public function blackstatus($status, $id, Request $request)
    {
        $hold = Hold::find($id);
        $hold->holds_status = $status;
        $hold->save();

        if ($status == 'start') {

            $hold_detail = HoldDetail::where('hold_details_hold_id', $id)
                ->get();

            foreach ($hold_detail as $row) {
                $product = Product::find($row->hold_details_products_id);
                $product_data = Product::find($row->hold_details_products_id);
                $product->products_amount = $product_data->products_amount + $row->hold_details_products_amount;
                $product->save();
            }
        }

    }

    public function upload_file_status($status, $id, Request $request)
    {
        $hold = Hold::find($id);
        $hold->holds_status = $status;

        if ($status == 'n10' || $status == 'p11') {
            $clientOriginalName = $request->holds_slip_to_owner->getClientOriginalName();
            $newFileName = time() . $clientOriginalName;
            $request->holds_slip_to_owner->move(public_path() . '/uploads_image/', $newFileName);
            $hold->holds_slip_to_owner = $newFileName;

        }

        if ($status == 'p4') {
            $clientOriginalName = $request->holds_slip_pay->getClientOriginalName();
            $newFileName = time() . $clientOriginalName;
            $request->holds_slip_pay->move(public_path() . '/uploads_image/', $newFileName);
            $hold->holds_slip_pay = $newFileName;

        }

        $hold->save();

        return redirect()->back();
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
    public function delete_detail($id)
    {
        $data = HoldDetail::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function provinces($id)
    {

        $provinces = DB::table('provinces')->get();

        return response()->json($provinces);
    }
    public function amphures($id, Request $request)
    {
        $amphures = DB::table('amphures')->where('province_id', $id)->get();

        $hold = Hold::find($request->get('hold_id'))->first();
        return view('hold.amphures', compact('amphures', 'hold'))->render();
    }
    public function districts($id)
    {
        $districts = DB::table('districts')->where('amphure_id', $id)->get();

        return view('hold.districts', compact('districts'))->render();
    }

    public function printbill($id)
    {

        $hold = Hold::find($id);
        $hold_detail = HoldDetail::where('hold_details_hold_id', $id)
            ->join('products', 'hold_details.hold_details_products_id', '=', 'products.products_id')->get();
        $pdf = PDF::loadView('report.bill.index', compact('hold', 'hold_detail'))->setPaper('a5');

        // return $pdf->stream();

        return $pdf->stream('bill.pdf');

        
    }

    public function printdelivery($id)
    {

        $hold_detail = HoldDetail::where('hold_details_hold_id', $id)
            ->join('products', 'hold_details.hold_details_products_id', '=', 'products.products_id')
            ->get();
        $product = Product::get();
        $hold = Hold::where('holds_id', $id)->join('provinces', 'holds.holds_provinces', '=', 'provinces.id')->join('amphures', 'holds.holds_amphures', '=', 'amphures.id')->first();

        $provinces = DB::table('provinces')->get();
        $amphures = DB::table('amphures')->get();
        $districts = DB::table('districts')->get();

        $pdf = PDF::loadView('report.delivery.index', compact('hold'))->setPaper('a6', 'landscape');

        // // return $pdf->stream();

        return $pdf->stream('delivery.pdf');
    }

}
