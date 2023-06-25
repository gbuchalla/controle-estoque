<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Customer;
use Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $customers = Customer::all();
       return response()->json($customers, 200);
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
         'name' => 'required|unique:customers|max:255',
         'email' => 'required',
         'phone' => 'required|unique:customers',

        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $customer = new Customer;
            $customer->fill($request->all()); 
            $customer->photo = $image_url;
            $customer->save(); 
        } else {
            $customer = new Customer;
            $customer->fill($request->all());
            $customer->save(); 
        }
        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = DB::table('customers')->where('id',$id)->first();
        return response()->json($customer, 200);
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
        $image = $request->newphoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);
         
            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('customers')->where('id',$id)->first();
                $image_path = $img->photo;
                unlink($image_path);   
            }

        } elseif ($oldphoto = $request->photo) {
            $data['photo'] = $oldphoto;
        }

        $customer  = Customer::find($id)->fill($data);
        $customer->save();

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = DB::table('customers')->where('id',$id)->first();
        $photo = $customer->photo;
        if ($photo) {
            unlink($photo);
            DB::table('customers')->where('id',$id)->delete();
        } else {
        DB::table('customers')->where('id',$id)->delete();
        }
        return response()->json(['msg' => 'O cliente foi removido com sucesso!'], 200);
    }


}
