<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PosController extends Controller
{
    public function getFilteredProducts($category_id)
    {
        $products = DB::table('products')
            ->where('category_id', $category_id)
            ->get();
        return response()->json($products, 200);
    }


    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'payment_method' => 'required',
        ]);

        // Store order's basic transaction data
        $data = $request->all();
        $data['order_date'] = date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        // Store order's purchased products details
        $cart_products = DB::table('pos')->get();
        $order_details = array();

        foreach ($cart_products as $cart_product) {
            $order_details['order_id'] = $order_id;
            $order_details['product_id'] = $cart_product->product_id;
            $order_details['product_quantity'] = $cart_product->product_quantity;
            $order_details['product_price'] = $cart_product->product_price;
            $order_details['sub_total'] = $cart_product->sub_total;
            DB::table('order_details')->insert($order_details);

            // Update product quantity in stock
            DB::table('products')
                ->where('id', $cart_product->product_id)
                ->update(['product_quantity' => DB::raw('product_quantity -' . $cart_product->product_quantity)]);
        }

        // Delete the cart data
        DB::table('pos')->delete();

        return response('A ordem foi registrada com sucesso', 200);
    }
}
