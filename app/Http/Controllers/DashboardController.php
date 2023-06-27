<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    public function getTodaySold()
    {
        $current_date = date('d/m/Y');
        $sold = DB::table('orders')->where('order_date', $current_date)->sum('total');

        return response()->json($sold, 200);
    }


    public function getTodayIncome()
    {
        $current_date = date('d/m/Y');
        $income = DB::table('orders')->where('order_date', $current_date)->sum('pay');

        return response()->json($income, 200);
    }


    public function getTodayDue()
    {
        $current_date = date('d/m/Y');
        $todaydue = DB::table('orders')->where('order_date', $current_date)->sum('due');

        return response()->json($todaydue, 200);
    }


    public function getTodayExpense()
    {
        $current_date = date('d/m/Y');
        $expense = DB::table('expenses')->where('expense_date', $current_date)->sum('amount');

        return response()->json($expense, 200);
    }

    
    public function stockOut()
    {

        $product = DB::table('products')->where('product_quantity', '<', '1')->get();
        return response()->json($product, 200);
    }
}
