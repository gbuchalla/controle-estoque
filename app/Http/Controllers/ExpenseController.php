<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Expense;
use DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Expense::all();
        return response()->json($expense, 200);
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
         'details' => 'required',
         'amount' => 'required',
        ]);

        $expense = new Expense;
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        if ($request->expense_date) {
            $expense->expense_date = date('d/m/y', strtotime($request->expense_date));
        } else {
            $expense->expense_date = date('d/m/y');
        }
        $expense->save();

        return response()->json($expense, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $expense = DB::table('expenses')->where('id',$id)->first();
       return response()->json($expense, 200);
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

        if ($request->expense_date) {
            $data['expense_date'] = date('d/m/y', strtotime($request->expense_date));
        }

        $expense = Expense::find($id)->fill($data);
        $expense->save();
        
        return response()->json($expense, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       DB::table('expenses')->where('id',$id)->delete();

        return response()->json(['msg' => 'A despesa foi removida com sucesso!'], 200);
    }
}
