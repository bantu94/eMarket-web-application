@extends('admin.admin_dashboard')


@section('admin__content')

@section('title', '|  Sliders')


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Slider Table</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Short</th>
                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($sliders as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->slider_title }}</td>
                            <td>{{ $item->short_title }}</td>
                            <td>
                                <img src="{{ asset($item->slider_image) }}" alt="category_photo" style="width: 120px;height: 90px;">
                            </td>
                            <td>
                                <a href="{{ route('edit_slider', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('delete_slider', $item->id) }}" class="btn btn-danger" id="delete" >Delete</a>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Short</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
