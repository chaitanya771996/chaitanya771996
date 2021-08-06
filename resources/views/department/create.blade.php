@extends('layouts.app')

@section('content')

<div class="container">
  <div class="jumbotron">
    <div class="text-center">
      <h2>Add Department Detail</h2>
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

  <form action="{{ url('department/store')}}" id="emp_form" method="POST">
    @csrf()
    <input type="hidden" name="dept_id" value="{{ isset($dept_details)?encrypt($dept_details->id):''}}">
    <div class="form-group">
      <label for="email">Department Name: <span class="textRed">*</span></label>
      <input type="text" class="form-control" id="dept_name" placeholder="Enter First Name" name="dept_name" value="{{ old('dept_name',(isset($dept_details) && !empty($dept_details->dept_name) )?$dept_details->dept_name:'')}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('department.home')}}"><button type="button" class="btn btn-outline-primary">back</button></a>
  </form>
</div>
</div>
@endsection
