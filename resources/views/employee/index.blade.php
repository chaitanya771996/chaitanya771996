@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
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
                    <div class="text-center heading-size font-weight-bold">
                        
                    {{ __('Employee Details Listing') }}
                    </div>

                    <div class="text-center div-pad2">
                    	<div class="text-right mb-3">
                    		
                        <a href="{{url('/employee/create')}}"><button type="button" class="btn btn-dark">Add Employees</button></a>
                    	</div>

                        <div class=" table-center">
                        	<table class="table table-striped">
                        		<thead>
		                            <tr>
			                            {{-- <th>Logo</th> --}}
		                        		<th>First Name</th>
		                        		<th>Last Name</th>
		                        		<th>Comapny</th>
		                        		<th>Email</th>
		                        		<th>Phone</th>
		                        		<th>Action</th>
		                            </tr>
		                        </thead>

		                        <tbody>
		                        	{{-- @dd() --}}
		                        	@if(isset($employees) &&  !empty($employees->toArray()['data']))
								    @foreach ($employees as $emp)
								    <tr>
								        <td>{{ $emp->first_name }}</td>
								        <td>{{ $emp->last_name }}</td>
								        <td>{{ $emp['company']->name }}</td>
								        <td>{{ $emp->email }}</td>
								        <td>{{ $emp->phone }}</td>
								        <td>
								        	<div class="edit_data d-inline-block"><a href="{{route('employee.edit',encrypt($emp->id))}}"><button class="btn btn-primary btn-xs">Edit</button></a></div>
								        	<div class="delete_data d-inline-block">
								        		<form action="{{ route('employee.destroy', $emp->id)}}" method="post" style="display:inline;">
										        <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure, you want to delete this ?')">Delete</button>
										        {{ method_field('DELETE') }}
										        {{ csrf_field() }}
										      </form>
											</div>
								        </td>
								    </tr>
								    @endforeach
								    @else
								    <tr>
								    	<td colspan="6" class="text-center">No record found !</td>
								    </tr>
								    @endif
		                        </tbody>
                        	</table>

						{{ $employees->links() }}
						<div class="text-right">
							<a href="{{url('/home')}}" class="btn btn-outline-primary">Back to Dashboard</a>
						</div>
						</div>
		                        {{-- @dd($companies) --}}
                        {{-- <a href="{{url('/employee')}}"><button type="button" class="btn btn-dark text-size mt-5">Manage Employee</button></a> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
