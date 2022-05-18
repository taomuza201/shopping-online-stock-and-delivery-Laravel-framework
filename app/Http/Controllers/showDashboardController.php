<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class showDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function top_user_sale()
    {
        $top_user_sale = DB::table('holds')
            ->join('users', 'holds.holds_users_id', '=', 'users.id')
            ->select('holds_users_id', DB::raw('count(holds_users_id) as total'))
            ->whereIn('holds_status', ['p11', 'n10'])
            ->groupBy('holds_users_id')
            ->orderBy('total', 'desc')
            ->get();
        return view('dashboard.top_user_sale.index', compact('top_user_sale'));
    }

    public function product_not_moving()
    {
        $product_not_moving_ch = DB::table('hold_details')
            ->select('hold_details_products_id')
            ->groupBy('hold_details_products_id')
            ->get();
        $product_not_moving_ch_arr = array();
        foreach ($product_not_moving_ch as $product_not_moving_ch) {
            $product_not_moving_ch_arr[] = $product_not_moving_ch->hold_details_products_id;

        }
        $product_not_moving = DB::table('products')
            ->whereNotIn('products_id', $product_not_moving_ch_arr)
            ->get();

        return view('dashboard.product_not_moving.index', compact('product_not_moving'));
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
