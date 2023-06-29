<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Pos;

class CartController extends Controller
{
	public function addToCart(Request $request, $product_id)
	{
		$id = $product_id;
		$product = DB::table('products')->where('id', $id)->first();

		if ($cart = DB::table('pos')->where('product_id', $id)->first()) {
			DB::table('pos')->where('product_id', $id)->increment('product_quantity');
			$cart = Pos::where('product_id', $id)->first();
			$subtotal = intval($cart->product_quantity)  * intval($cart->product_price);
			$cart->fill(['sub_total' => $subtotal])->save();

			return response()->json($cart, 200);

		} else {
			$data = array();
			$data['product_id'] = $id;
			$data['product_name'] = $product->product_name;
			$data['product_quantity'] = 1;
			$data['product_price'] = $product->selling_price;
			$data['sub_total'] = $product->selling_price;
			$cart = Pos::create($data);

			return response()->json($cart, 201);
		}
	}


	public function getProducts()
	{
		$cart = DB::table('pos')->get();
		return response()->json($cart, 200);
	}



	public function destroy($id)
	{
		DB::table('pos')->where('id', $id)->delete();
		return response()->json(['msg' => 'O carrinho foi removido com sucesso!'], 200);
	}


	public function incrementProduct($id)
	{
		$product = DB::table('pos')->where('id', $id)->first();
		$product->increment('product_quantity');
		$subtotal = $product->product_quantity * $product->product_price;
		$product->update(['sub_total' => $subtotal]);
		return response(['msg' => 'O acréscimo da quantidade de produto foi realizado com sucesso!'], 200);
	}


	public function decrementProduct($id)
	{
		$product = DB::table('pos')->where('id', $id)->first();
		$product->decrement('product_quantity');
		$subtotal = $product->product_quantity * $product->product_price;
		$product->update(['sub_total' => $subtotal]);
		return response(['msg' => 'O descréscimo da quantidade de produto foi realizado com sucesso!'], 200);
	}


	public function getExtraInfo()
	{
		$extra = DB::table('extra')->first();
		return response()->json($extra, 200);
	}
}
