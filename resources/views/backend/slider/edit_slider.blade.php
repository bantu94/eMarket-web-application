@extends('admin.admin_dashboard')

@section('admin__content')

@section('title', '| Edit Slider')


<!-- JQuery -->
{{-- Script for showing image when uploaded --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all_sliders') }}">
                <button type="button" class="btn btn-info">Back</button>
                </a>
            </div>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('update_slider') }}" id="my_form" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $slider->id }}">
		                        <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Slider title</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input name="slider_title" type="text" class="form-control" value="{{ $slider->slider_title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short title</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input name="short_title" type="text" class="form-control" value="{{ $slider->short_title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Slider image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="slider_image" type="file" class="form-control" id="image" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="show_image" src="{{ asset($slider->slider_image) }}" alt="sliderphoto"  width="120" height="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input  type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function (){
        $('#my_form').validate({
            rules: {
                slider_title: {
                    required : true,
                },
                short_title: {
                    required : true,
                },
            },
            messages :{
                slider_title: {
                    required : 'Please enter slider title',
                },
                short_title: {
                    required : 'Please enter short title',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>



{{-- Script for showing image when uploaded --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#show_image').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>




@endsection
