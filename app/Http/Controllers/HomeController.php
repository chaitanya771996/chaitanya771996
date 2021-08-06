<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Department;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(config('app.url'));
        $company_count    = Company::get()->count();
        $employee_count    = Employee::get()->count();
        $dept_count    = Department::get()->count();
        $count = [
            'comp_count'=>$company_count, 
            'emp_count'=>$employee_count, 
            'dept_count'=>$dept_count
        ];
        
        return view('home', ['count'=>$count]);
    }
}
