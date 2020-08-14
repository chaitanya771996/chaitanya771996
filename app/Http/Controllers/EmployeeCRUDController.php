<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\AdminUser;
use App\Models\Employee;
use App\Models\Company;

class EmployeeCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')->orderBy('id','desc')->paginate(10);
        // dd($companies->toArray());

        return view('employee.index', ['employees' => $employees]);
        // return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_listing = Company::get();
        // dd($company_listing->toArray());
       return view('employee.create',['company_listing' => $company_listing]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {  
        $validated = $request->validated();

        $id = ($request->emp_id)?decrypt($request->emp_id):'';


        $data = [
                'first_name' => $request->fname,
                'last_name' => $request->lname,
                'company_id' => $request->company_id,
                'email' => $request->email,
                'phone' => $request->phone,
        ];
        
        if($id){

            $insert = Employee::updateOrCreate(['id'=>$id],$data);
            $msg = 'Employee details has been Updated';
        }else{
            $insert = Employee::create($data);
            $msg = 'Employee details has been added Sucessfully !';

        }
        if($insert){
            return redirect(route('employee.index'))->with('success',$msg);
        }
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $company_listing = Company::get();
        $emp_detail = Employee::where('id',$id)->first();
        // dd($company_detail->toArray());

        return view('employee.create', ['emp_detail' => $emp_detail,'company_listing' => $company_listing]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::where('id',$id);
        $emp->delete();    
        return redirect()->back()->with(['success' => 'successful delete!']);
    }
}
