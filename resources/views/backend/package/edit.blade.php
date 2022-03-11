@extends('layouts.backend')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Services</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="card border-top border-0 border-4 border-danger">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">

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
                    </div>
                    <hr>

                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                    <form class="row g-3" method="POST" action="{{ route('admin.package.update',$package->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                     @csrf


                        @foreach ($fields as $item)
                        <div class="col-12">
                            <label for="{!!  Str::of(str_replace(' ', '_', $item['label']))->lower();  !!}" class="form-label"> {{ $item['label']}}</label>

                           @if ($item['type'] =='select')

                           @if ( $item['data'] == true)
                           <select class="form-select mb-3"   id="input_{{$item['name']}}"
                           name="input_{{$item['name']}}" aria-label="Default select example">
                            <option value="">Select Category</option>

                            @foreach ($item['list'] as $category)
                            <option {{  $category->id == $item['value'] ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach


                        </select>
                        @else
                        <select class="form-select mb-3"   id="input_{{$item['name']}}"
                        name="input_{{$item['name']}}" aria-label="Default select example">
                        <option value="">Sub Category Select</option>
                        

                    </select>
                    @endif

                        @elseif ($item['type'] =='textarea')
                        <textarea  id="my-editor" name="input_{{ $item['name']}}" class="form-control">
                            {{$item['value']}}
                        </textarea>


                        @elseif ($item['type'] =='image')
                     <div class="row">
                        <div class="col-8">
                            <div class="input-group">
                                {{-- <span class="input-group-btn">
                                  <a id="input_{{$item['name']}}" data-input="thumbnail_{{$item['name']}}" data-preview="holder_{{$item['name']}}" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input value="{{$item['value']}}" id="thumbnail_{{$item['name']}}" class="form-control" type="text" name="input_{{$item['name']}}">
                                                    </div> --}}

                                                    <input  id="thumbnail_{{$item['name']}}" class="form-control"   name="input_{{$item['name']}}" type="file" class="form-control">

                                                    <input type="hidden" value="{{$item['value']}}" name="already_exist"/>
                          </div>
                     </div>

                          <div class="col-4">
                            <img id="imgPreview" width="300"   src="{{Storage::disk('s3')->url('images/'.$item['value'])}}" alt="pic" />

                           </div>
                     </div>

                           @elseif ($item['type'] =='text')

                            <div class="input-group">

                                @if ($item['icon'] ==true)
                                <span class="input-group-text bg-transparent">
                                    <i class="bx bxs-{{ $item['icon_name']}}"></i></span>
                                    @else
                                    <span class="input-group-text bg-transparent"></span>
                                @endif

                                <input type="{{$item['type']}}"
                                 class="form-control border-start-0"
                                  id="input_{{$item['name']}}"
                                  name="input_{{$item['name']}}"
                                  value="{{$item['value']}}"




                                   placeholder="{{ $item['label']}}">
                            </div>

                            @endif

                            @error('input_'.$item['name'])


                            <strong class="red">{{ $message }}</strong>
                    @enderror


                        </div>
                        @endforeach



                             <input type="hidden" id="subcat" value="{{$package->subcategory_id }}">



                        <div class="col-12">
                            <button type="submit" class="btn btn-danger px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>

@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
{{-- <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script> --}}
<script src="{{ asset('backend/ckeditor_4.17.1_full/ckeditor/ckeditor.js')}}"></script>
<script>
  $('#input_image').filemanager('filepath');
 $('#lfm1').filemanager('filepath1');


 </script>


 <script>
       var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

    CKEDITOR.replace('my-editor', options);












    

    $(function() {
        $("#input_category_name").change(function(e){
        $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    e.preventDefault();
        var id = $(this).find("option:selected").val();

        var token = $("meta[name='csrf-token']").attr("content");



        var option =  $('#input_sub_category_name');
       option.empty();

        $.ajax({
           type:'POST',
           url:"{{ route('admin.ajaxRequest.post')}}",
          // _token: 'MSJuiQE8xTHugPOLZw0N4qiHZkk8w2B0kc4QjP58' ,
           data:{id:id, '_token':token},
           success:function(data){
             // alert(data.success);
              console.log(data);
              var data = data.success;
              for (var i = 0; i < data.length; i++) {

                  console.log(data[i].id);
                 option.append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].name + '</option>');
            }
           }
        });
 

});
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  


var sub_cat = $('#subcat').val();
if($('#subcat').val().length) {
var option =  $('#input_sub_category_name');

//alert('working');

$.get("/admin/ajaxRequestcars/"+sub_cat,
 function(data, status){
     var data = data.success;
//console.log(data);
    // alert(data.id);
      option.append('<option selected id=' + data.id + ' value=' + data.id + '>' + data.name + '</option>');

});
}
    });

    </script>
@endsection
