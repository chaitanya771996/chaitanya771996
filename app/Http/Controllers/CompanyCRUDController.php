<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\AdminUser;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;


class CompanyCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(10);
        // dd($companies->toArray());

        return view('company.index', ['companies' => $companies]);
        // return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {  
        $validated = $request->validated();
        $id = ($request->company_id)?decrypt($request->company_id):'';
        $fileName = '';
        if ($request->hasFile('filename')) {
            $image      = $request->file('filename');
            $fileName   = 'company_logo_'.time() . '.' . $image->getClientOriginalExtension();

            $img = \Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('public/'.$fileName, $img, 'public');
        }
        // dd($fileName);

        $data = [
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
        ];
        if($fileName){

            $data['logo'] = $fileName;
        }
        // dd($data);
        if($id){

            $insert = Company::updateOrCreate(['id'=>$id],$data);
            $msg = 'Company details has been Updated';
        }else{
            $insert = Company::create($data);
            $msg = 'Company details has been added Sucessfully !';

        }
        if($insert){
            return redirect(route('company.index'))->with('success',$msg);
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
        $company_detail = Company::where('id',$id)->first();
        // dd($company_detail->toArray());

        return view('company.create', ['company_detail' => $company_detail]);
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
        $company = Company::where('id',$id);
        $company->delete();    
        return redirect()->back()->with(['success' => 'successful delete!']);
    }
}
