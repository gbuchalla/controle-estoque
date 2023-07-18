<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    private $current_month;
    private $current_date;


    public function __construct()
    {
        $this->current_month = ucfirst(Carbon::now()->locale('pt-BR')->translatedFormat('F'));
        $this->current_date = Carbon::now()->format('d/m/Y');
    }


    public function getMonthSales()
    {
        $current_month = $this->current_month;
        $sales = DB::table('orders')->where('order_month', $current_month)->sum('total');

        return response()->json($sales, 200);
    }


    public function getTodaySales()
    {
        $current_date = $this->current_date;
        $sales = DB::table('orders')->where('order_date', $current_date)->sum('total');

        return response()->json($sales, 200);
    }


    public function getMonthExpenses()
    {
        $current_month = $this->current_month;

        $expenses = DB::table('expenses')->get()->filter(function ($expense, $key) {
            $expense_date = $expense->expense_date;
            $expense->amount = floatval($expense->amount); // Convert 'amount' field of model instance fom string to float
            return 
                $this->current_month == 
                ucfirst(Carbon::createFromFormat('d/m/Y', $expense_date)->locale('pt-BR')->translatedFormat('F'));
        });

        $expenses_sum = $expenses->sum('amount');

        $salary_payments = DB::table('salaries')->where('salary_month', $current_month)->sum('amount');

        $total_expense = $expenses_sum +  $salary_payments;

        return response()->json($total_expense, 200);
    }


    public function getStockOut()
    {
        $products = DB::table('products')->where('product_quantity', '<', '1')->get();
        return response()->json($products, 200);
    }
}
