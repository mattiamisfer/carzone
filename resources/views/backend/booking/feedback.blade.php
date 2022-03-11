@extends('layouts.backend')

@section('style')
<link href="{{ asset('backend/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />



@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Feedback Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Feedback Table</li>
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

        <h6 class="mb-0 text-uppercase">Feedback Import</h6>
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
                              
                                <th>Reason</th>
                                <th>Feedback</th>
                                <th>Status</th>
                                
                             

                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($feedbacks as $book)
                            <tr>

                            
                                <td>{{ $book->user->name}}</td>
                                <td>{{ $book->reason}}</td>
                                <td> {{ $book->feedback }}</td>
                                

                                <td class="myStatus_{{$book->id}}">
                                @if ($book->status =='Pending')
                                 <a  type="button" data-toggle="modal" data-target="#exampleModal" class="btn_update" id="{{$book->id}}"> Update</a>
                                 @else 
                                 <span> Active</span>                                    
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
                              
                                <th>Reason</th>
                                <th>Feedback</th>
                                <th>Status</th>
                               
                            </tr>
                        </tfoot>
                    </table>
         
              
            

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="msgbox"></div>

                 

                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Status</label>

                               <input type="hidden" id="id" value="">
                            <select class="form-control validate" id="status">
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                            </select>
                          </div>
                  

                    
                 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
                    {{-- //pop up  --}}
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
			

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        $(document).ready(function(){

            var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
           // $(".btn_update").click(function(){
            $('#example2').on('click','.btn_update',function () {

                var ID = $(this).attr("id");

                $('#id').val(ID);

             //   alert('workign' + ID);
            $("#myModal").modal('show');
            });

            $("#submit").click(function() {
                var token = $("meta[name='csrf-token']").attr("content");

 
                  var id = $('#id').val();
                  var status = $('#status').val();

                  $.post("/admin/status/update_status/"+id,
  {
    id : id,
    status: status,
    "_token": token,
  },
  function(data, status){
      console.log(status);
    //alert("Data: " + data + "\nStatus: " + status);
    $("#msgbox").append("<p style='color:green;'>"+ data[1] + "</p>").delay(2000)
        .queue(function() {
            $(this).remove();
            $("#myModal").modal('hide');
           
        });

        $('.myStatus_'+id).append("<span>Active</span>");

  });

            });


        });

        $(function () {
            $(".close").click(function() {
   $('#myModal').modal('hide');
});
});
    </script>
@endsection
