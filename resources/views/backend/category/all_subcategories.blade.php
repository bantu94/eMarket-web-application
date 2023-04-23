@extends('admin.admin_dashboard')


@section('admin__content')

@section('title','| Subcategories')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Subcategories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Subcategories Table</li>
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
                            <th>Category name</th>
                            <th>Subcategory name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subcategories as $key => $item)
                        <tr>

                            <td> {{ $key+1 }} </td>
                            <td> {{ $item['category_relation']['category_name'] }}</td>
                            <td> {{ $item->subcategory_name }}  </td>

                            <td>
                                <a href="{{ route('edit_subcategory', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('delete_subcategory', $item->id) }}" class="btn btn-danger" id="delete" >Delete</a>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Category name</th>
                            <th>Subcategory name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
