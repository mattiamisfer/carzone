@extends('layouts.backend')

@section('style')
<link href="{{ asset('backend/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Subscription Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    {{-- <a href="{{ route('admin.option.create',request('id'))}}" class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                        <div class="font-22 text-primary">	<i class="fadeIn animated bx bx-plus"></i>
                        </div>
                        <div class="ms-4">Add New </div>
                    </a> --}}
                    {{-- <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div> --}}


                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">DataTable Import</h6>
        <hr/>

        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))

                <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
                </div>
                @endif
                @if (Session::has('failure'))
                <div class="alert alert-danger" role="alert">
                  {{ Session::get('failure') }}
                </div>
             @endif
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                              
                                <th>Plan Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Order ID</th>
                                <th>User </th>
                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($subscriptions as $subs)
                            <tr>
                                <td>{{ $subs->name}}</td>
                               <td>  

                                @if($subs->plan()->count())
                                 {{ $subs->plan->name}}
                           @else
                                Guest
                           @endif
                               </td>
                                <td>{{ $subs->amount}}</td>
                                <td>{{ $subs->status}}</td>
                                <td>{{ $subs->start}}</td>
                                <td>{{ $subs->end}}</td>
                                <td>{{ $subs->order_id}}</td>

                                <td>
                                    @if ($subs->subscribe()->count())
                                  
                                   
                                    @if ($subs->subscribe->start_time < \Carbon\Carbon::now() AND   $subs->subscribe->end_time < \Carbon\Carbon::now() )
                                    Expired
                                    @else
                                   {{ $subs->subscribe->end_time}}
                                    @endif
                                    @else
                                        Guest
                                    @endif
                                </td>
                                
                                {{-- <td>{{ $subs->name}}</td>
                                <td>{{ $subs->name}}</td> --}}



                               






 
                                

                            </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                              
                                <th>Plan Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Order ID</th>
                                <th>User </th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
@endsection
