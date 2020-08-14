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
                        
                    {{ __('Welcome to Mini-CRM Portal!') }}
                    </div>

                    <div class="text-center div-pad">
                        <a href="{{url('/company')}}"><button type="button" class="btn btn-secondary text-size mt-5">Manage Companies</button></a>
                        <a href="{{url('/employee')}}"><button type="button" class="btn btn-dark text-size mt-5">Manage Employees</button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
