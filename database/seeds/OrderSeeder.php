<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderDetails;
use App\Model\Product;


class OrderSeeder extends Seeder
{
    /**
     * Seed the application's database with Order and OrderDetails models.
     *
     * @return void
     */
    public function run()
    {   
        for ($i = 0; $i < 50; $i++) {
            $product = Product::all()->random(1)->first();
            
            // Insert Order model 
            $order = Order::create([
                'customer_id' => Customer::all()->random(1)->pluck('id')->first(),
                'quantity' => $quantity = $product->product_quantity > 0 ? rand(1, $product->product_quantity) : 0,
                'sub_total' => $subtotal = $product->selling_price * $quantity,
                'tax' => $tax = null, // alternatively, if there's a tax value: Extra::all()->first()->tax,
                'total' => $total = $tax ? $subtotal * $tax : $subtotal,
                'pay' => $pay = rand($total / 2, $total),
                'due' => $total - $pay,
                'payment_method' => ['Dinheiro', 'Crédito', 'Débito', 'Pix'][rand(0, 3)],
                'order_date' => date('d/m/Y', $time = strtotime('-' . rand(1, 7) . ' days')),
                'order_month' => ucfirst(Carbon::parseFromLocale(date('F', $time), 'pt-BR')->translatedFormat('F')),
                'order_year' => date('Y', $time)
            ]);

            // Insert OrderDetails model
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => Customer::all()->random(1)->pluck('id')->first(),
                'product_quantity' => $quantity = $product->product_quantity > 0 ? rand(1, $product->product_quantity) : 0,
                'product_price' => $price = $product->selling_price,
                'sub_total' => $subtotal = $price * $quantity,
            ]);
        }
    }
}
