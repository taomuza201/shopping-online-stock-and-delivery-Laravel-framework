<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $topsale = DB::table('hold_details')->join('products', 'hold_details.hold_details_products_id', '=', 'products.products_id')
            ->join('holds', 'hold_details.hold_details_hold_id', '=', 'holds.holds_id')
            ->select('products.products_name', DB::raw('SUM(hold_details_products_amount)as total'))->whereIn('holds_status', ['p11', 'n10'])->groupBy('hold_details.hold_details_products_id')->orderBy('total', 'desc')->paginate(6);

        $month = DB::table('holds')
            ->select(DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as month_year"))
            ->groupBy('month_year')
            ->orderBy('month_year', 'asc')
            ->whereIn('holds_status', ['p11', 'n10'])
            ->paginate(5);

        $arr_month = array();
        $arr_total = array();

        foreach ($month as $row_month) {
            $arr_month[] = formatDatemonth($row_month->month_year);
            $product_of_month = DB::table('hold_details')
                ->join('holds', 'hold_details.hold_details_hold_id', '=', 'holds.holds_id')
                ->select('*', DB::raw("(DATE_FORMAT(holds.created_at, '%Y-%m')) as month_year"))->whereIn('holds_status', ['p11', 'n10'])
                ->whereYear('holds.created_at', '=', date('Y', strtotime($row_month->month_year)))
                ->whereMonth('holds.created_at', '=', date('m', strtotime($row_month->month_year)))
                ->get();
            $total_of_month = 0;
            foreach ($product_of_month as $product_cal) {
                $total_of_month += $product_cal->hold_details_products_amount * $product_cal->hold_details_products_price;
            }
            $arr_total[] = $total_of_month;
        }

        $top_user_sale = DB::table('holds')
            ->join('users', 'holds.holds_users_id', '=', 'users.id')
            ->select('holds_users_id', DB::raw('count(holds_users_id) as total'))
            ->whereIn('holds_status', ['p11', 'n10'])
            ->groupBy('holds_users_id')
            ->orderBy('total', 'desc')
            ->paginate(5);
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
            ->paginate(5);

        return view('dashboard', compact('topsale', 'arr_month', 'arr_total', 'top_user_sale', 'product_not_moving'));
    }
}
