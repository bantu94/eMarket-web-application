@extends('admin.admin_dashboard')


@section('admin__content')

@section('title','| AdBanners ')


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ad Banners</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ad Banners Table</li>
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
                            <th>Banner Title</th>
                            <th>Banner Url</th>
                            <th>Banner Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($banners as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->banner_title }}</td>
                            <td>{{ $item->banner_url }}</td>
                            <td>
                                <img src="{{ asset($item->banner_image) }}" alt="bannerimage" style="width: 90px;height: 70px;">
                            </td>
                            <td>
                                <a href="{{ route('edit_banner', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('delete_banner', $item->id) }}" class="btn btn-danger" id="delete" >Delete</a>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Banner Title</th>
                            <th>Banner Url</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
