<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Model\Employee;
use App\Model\Salary;

class SalarySeeder extends Seeder
{
    /**
     * Seed the application's database with salary payments records.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::all()->toArray();
        // Insert salary payment records for 5 employees
        for ($i=0; $i < 7; $i++) {
            $employee = array_pop($employees);

            // Get the number of months between now and the employee's joining date, and use it as number of payments records
            $dateToday = Carbon::now();
            $joiningDate = Carbon::createFromFormat('d/m/Y', $employee['joining_date']);
            $monthsWorked = $dateToday->diffInMonths($joiningDate);

            for ($m = 1; $m <= $monthsWorked; $m++) {

                // Insert salary payment record 
                Salary::create([
                    'employee_id' => $employee['id'],
                    'amount' => $employee['salary'],
                    //'salary_date' => '10/' . date('m/Y', $time = strtotime('-' . $i . ' months')),
                    'salary_date' => '10/' . $dateToday->copy()->subMonths($m)->format('m/Y'),
                    'salary_month' => $dateToday->copy()->subMonths($m)->locale('pt-BR')->translatedFormat('F'),
                    //'salary_month' => ucfirst(Carbon::parseFromLocale(date('F', $time), 'pt-BR')->translatedFormat('F')),
                    'salary_year' => $dateToday->copy()->subMonths($m)->format('Y')
                ]);
            }
        }
    }
}
