<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Salary;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function pay(Request $request, $employee_id)
    {

        $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id', $employee_id)->where('salary_month', $month)->first();
        if ($check) {
            return response()->json('O salário já foi pago');
        } else {
            $data = array();
            $data['employee_id'] = $employee_id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            
            $salary = new Salary;
            $salary->fill($data)->save();

            return response()->json($salary, 201);
        }
    }


    public function index() // AllSalary
    {
        $salaries = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();

        return response()->json($salaries, 200);
    }


    public function show($month) // ViewSalary
    {
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.salary_month', $month)
            ->get();

        return response()->json($salary, 200);
    }


    public function edit($id)
    {

        $salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();

        return response()->json($salary, 200);
    }



    public function update(Request $request, $id)
    {
        $data = request(['employee_id', 'amount', 'salary_month']);

        $salary= Salary::find($id)->fill($data);
        $salary->save();

        return response()->json($salary, 200);
    }
}
