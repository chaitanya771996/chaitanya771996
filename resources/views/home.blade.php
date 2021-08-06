@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center heading-size">
                        
                    {{ __('Welcome !') }}
                    </div>
                    @if(isset($count) && !empty($count))    
                        <div class="text-center div-pad row">
                            <div class="col-md-4 company_div">
                                <a href="{{url('/company')}}" class="manage">{{ __('Manage Companies') }}<i class="fa fa-building"></i></a>
                                <h4 style="color: white">
                                    {{ $count['comp_count'] }}         
                                </h4>
                            </div>
                            <div class="col-md-4 employee_div">
                                <a href="{{url('/employee')}}" class="manage">{{ __('Manage Employees') }}<i class="fa fa-users"></i></a>
                                <h4 style="color: white">
                                    {{ $count['emp_count'] }}
                                </h4>
                            </div>
                            <div class="col-md-4 dept_div">
                                <a href="{{route('department.home')}}" class="manage">{{ __('Manage Department') }}<i class="fa fa-users"></i></a>
                                <h4 style="color: white">
                                    {{ $count['dept_count'] }}
                                </h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
