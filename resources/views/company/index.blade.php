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
                        
                    {{ __('Company Details Listing') }}
                    </div>

                    <div class="text-center div-pad2">
                    	<div class="text-right mb-3">
                    		
                        <a href="{{url('/company/create')}}"><button type="button" class="btn btn-secondary">Add Companies</button></a>
                    	</div>

                        <div class=" table-center">
                        	<table class="table table-striped">
                        		<thead>
		                            <tr>
			                            <th>Logo</th>
		                        		<th>Name</th>
		                        		<th>Email</th>
		                        		<th>Website</th>
		                        		<th>Action</th>
		                            </tr>
		                        </thead>

		                        <tbody>
		                        	{{-- @dd() --}}
		                        	@if(isset($companies) &&  !empty($companies->toArray()['data']))
								    @foreach ($companies as $company)
								    <tr>
								        <td><img src="{{asset('storage/'.$company->logo)}}"></td>
								        <td>{{ $company->name }}</td>
								        <td>{{ $company->email }}</td>
								        <td>{{ $company->website }}</td>
								        <td>
								        	<div class="edit_data d-inline-block"><a href="{{route('company.edit',encrypt($company->id))}}"><button class="btn btn-primary btn-xs">Edit</button></a></div>
								        	<div class="delete_data d-inline-block">
								        		<form action="{{ route('company.destroy', $company->id)}}" method="post" style="display:inline;">
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
								    	<td colspan="5" class="text-center">No record found !</td>
								    </tr>
								    @endif
		                        </tbody>
                        	</table>

						{{ $companies->links() }}
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
