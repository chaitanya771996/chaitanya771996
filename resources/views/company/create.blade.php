@extends('layouts.app')

@section('content')

<div class="container">
  <div class="jumbotron">
    <div class="text-center">
      <h2>Add Company Detail</h2>
      {{-- @dd(Session::all()) --}}
      @if(Session::has('success'))
      {{-- @dd('here') --}}

        <div class="alert alert-success">

            {{ Session::get('success') }}

            @php

                Session::forget('success');

            @endphp

        </div>

      @endif
      @if(Session::has('errors'))
      {{-- @dd('here3') --}}

        <div class="alert alert-danger">

            {{ Session::get('errors') }}

            @php

                Session::forget('errors');

            @endphp

        </div>

      @endif
    </div>
  <form action="{{ route('company.store')}}"  enctype='multipart/form-data' id="company_form" method="POST">
    @csrf()
    <input type="hidden" name="company_id" value="{{ isset($company_detail)?encrypt($company_detail->id):''}}">
    <div class="form-group">
      <label for="email">Name: <span class="textRed">*</span></label>
      {{-- @dd($company_detail) --}}
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name',(isset($company_detail) && !empty($company_detail->name) )?$company_detail->name:'')}}">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email',(isset($company_detail) && !empty($company_detail->email) )?$company_detail->email:'')}}">
    </div>
    <label for="email">Logo:</label>
   <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="filename">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
      @if(isset($company_detail) && !empty($company_detail->logo) )
        <img src="{{asset('storage/'.$company_detail->logo)}}" class="img-responsive img-pad">
      @endif
    <div class="form-group">
      <label for="email">Website:</label>
      <input type="text" class="form-control" id="website" placeholder="Enter website" name="website" value="{{ old('website',(isset($company_detail) && !empty($company_detail->website) )?$company_detail->website:'')}}">
    </div>
    
    
    
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('company.index')}}"><button type="button" class="btn btn-outline-primary">back</button></a>
  </form>
</div>
</div>
@endsection
