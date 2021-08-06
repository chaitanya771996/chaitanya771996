<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function list(){
        /*$users = DB::table('department')->where('id', 4)->value('dept_name');
        $users1 = DB::table('department')->where('id', 4)->pluck('dept_name', 'id')->first();
        $users2 = DB::table('department')->where('id', 4)->select('id','dept_name')->first();
        dd($users, $users1, $users2);*/

        /*DB::table('employees')->orderBy('id')->chunk(100, function($users){
            foreach ($users as $user) {
                echo $user->first_name;
            }

        });*/
        /*echo "New changes added"; -- Added comment for department listing*/
        $department = Department::orderBy('id', 'asc')->paginate(2);
        return view('department.index', ['department'=>$department]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDepartment()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = ($request->dept_id)?decrypt($request->dept_id):'';
        $data = ['dept_name'=>$request->dept_name];
     
        if ($id) {
            $insert = Department::updateOrCreate(['id'=>$id], $data);
            $msg ='Department information updated';
        }else{
            $insert = Department::create($data);
            $msg = "Department added successfully";
        }

        if ($insert) {
            return redirect(route('department.home'))->with('success', $msg);
        }

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
        $dept_details = Department::where('id', $id)->first();
        //dd($dept_details);
        return view('department.create', ['dept_details'=>$dept_details]);
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
    function delete($id){
        $id = decrypt($id);
        $dept = Department::where('id', $id);
        $dept->delete();
        return redirect(route('department.home'))->with('success', 'Department has been deleted');

    }
    public function destroy($id)
    {
        dd($id);
    }
}
