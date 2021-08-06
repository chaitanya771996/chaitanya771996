@extends('layouts.app')

@section('content')

<div class="container">
  <div class="jumbotron">
    <div class="text-center">
      <h2>Add Employee Detail</h2>
      @if(Session::has('success'))

        <div class="alert alert-success">

            {{ Session::get('success') }}

            @php

                Session::forget('success');

            @endphp

        </div>

      @endif
      @if(Session::has('errors'))

        <div class="alert alert-danger">

            {{ Session::get('errors') }}

            @php

                Session::forget('errors');

            @endphp

        </div>

      @endif

    </div>

  <form action="{{ route('employee.store')}}" id="emp_form" method="POST">
    @csrf()
    <input type="hidden" name="emp_id" value="{{ isset($emp_detail)?encrypt($emp_detail->id):''}}">
    <div class="form-group">
      <label for="email">First Name: <span class="textRed">*</span></label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value="{{ old('fname',(isset($emp_detail) && !empty($emp_detail->first_name) )?$emp_detail->first_name:'')}}">
    </div>
    <div class="form-group">
      <label for="email">Last Name: <span class="textRed">*</span></label>
      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" value="{{ old('lname',(isset($emp_detail) && !empty($emp_detail->last_name) )?$emp_detail->last_name:'')}}">
    </div>
    <div class="form-group">
      <label for="email">Company:</label>
      <select class="form-control" name="company_id">
        <option>Select Company</option>
        @if(isset($company_listing))
        @foreach($company_listing as $company)
        <option value="{{$company->id}}" {{ old('company_id',(isset($emp_detail) && ($emp_detail->company_id)?$emp_detail->company_id:''))}} {{(isset($emp_detail) && !empty($emp_detail->last_name) && ($emp_detail->company_id == $company->id )?'selected':'')}} > {{$company->name}}</option>
        @endforeach
        @endif
      </select>
      
    </div>
    <div class="form-group">
      <label>Department :</label>
      <select class="form-control" name="dept_id">
        <option>Select Department</option>
        @if(isset($dept_listing))
        @foreach($dept_listing as $department)
        <option value="{{$department->id}}" {{old('dept_id', (isset($emp_detail) && ($emp_detail->dept_id == $department->id)? "selected": ""))}} >{{$department->dept_name}}</option>
        @endforeach
        @endif
      </select>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email',(isset($emp_detail) && !empty($emp_detail->email) )?$emp_detail->email:'')}}">
    </div>
    <div class="form-group">
      <label for="email">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone" value="{{ old('phone',(isset($emp_detail) && !empty($emp_detail->phone) )?$emp_detail->phone:'')}}">
    </div>
    
    
    
    
    
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('employee.index')}}"><button type="button" class="btn btn-outline-primary">back</button></a>
  </form>
</div>
</div>
@endsection
