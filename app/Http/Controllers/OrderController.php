<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderController extends Controller
{
    public function getTodayOrders()
    {
        $current_date = date('d/m/Y');

        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('order_date', $current_date)
            ->select('customers.name', 'orders.*')
            ->orderBy('orders.id', 'DESC')->get();

        return response()->json($orders, 200);
    }


    public function show($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('orders.id', $id)
            ->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
            ->first();

        return response()->json($order, 200);
    }


    public function showDetails($id)
    {
        $order_details = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->where('order_details.order_id', $id)
            ->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
            ->get();

        return response()->json($order_details, 200);
    }

    public function searchByDate(Request $request)
    {
        $order_date = new DateTime($request->date);
        $order_date = $order_date->format('d/m/Y');

        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('orders.order_date', $order_date)
            ->get();

        return response()->json($order, 200);
    }
}
