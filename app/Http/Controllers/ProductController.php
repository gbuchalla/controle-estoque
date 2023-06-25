<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('suppliers','products.supplier_id','suppliers.id')
                    ->select('categories.category_name','suppliers.name','products.*')
                    ->orderBy('products.id','DESC')
                    ->get();
                    return response()->json($products, 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'product_name' => 'required|max:255',
         'product_code' => 'required|unique:products|max:255',
         'category_id' => 'required',
         'supplier_id' => 'required',
         'buying_price' => 'required',
         'selling_price' => 'required',
         'buying_date' => 'required',
         'product_quantity' => 'required',
        ]);

        $product = new Product;
        $product->fill($request->all());

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $product->image = $image_url;   
    }
        $product->save();

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        
        return response()->json($product, 200);
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
        $data = $request->all();
        $image = $request->newimage;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);
         
        if ($success) {
            $data['image'] = $image_url;
            $img = DB::table('products')->where('id',$id)->first();
            $image_path = $img->image;
            unlink($image_path);
        }
          
        } elseif ($oldphoto = $request->image){
            $data['image'] = $oldphoto;
        }

        $product = Product::find($id)->fill($data);
        $product->save();

        return response()->json($product, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $photo = $product->image;
        if ($photo) {
            unlink($photo);
            DB::table('products')->where('id',$id)->delete();
        } else {
            DB::table('products')->where('id',$id)->delete();
        }
        return response()->json(['msg' => 'O produto foi removido com sucesso!'], 200);
    }


    /**
     * Update the product quantity in stock
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stockUpdate(Request $request, $id)
    {
        $product = Product::find($id)->fill(['product_quantity' => $request->product_quantity]);
        $product->save();

        return response()->json($product, 200);
    }
}
