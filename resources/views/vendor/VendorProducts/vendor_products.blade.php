@extends('vendor.vendor_dashboard')


@section('vendor__content')

@section('title', '| Vendor Products')


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Products Count : <span class="badge rounded-pill bg-danger">{{ count($products) }}</span>
                    </li>
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
                            <th>P Image</th>
                            <th>P Name</th>
                            <th>P Price</th>
                            <th>P Quantity</th>
                            <th>P Discount</th>
                            <th>P Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <img src="{{ asset($item->product_thumbnail) }}" alt="category_photo" style="width: 70px;height: 70px;">
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->selling_price }}</td>
                            <td>{{ $item->product_quantity }}</td>


                            <td>
                                @if ($item->discount_price == NULL)
                                    <span class="badge rounded-pill bg-info" >No Discount</span>
                                @else

                                @php
                                    $amount = $item->selling_price - $item->discount_price;
                                    $discount = ($amount/$item->selling_price) * 100;
                                @endphp
                                    <span class="badge rounded-pill bg-info" >{{ round($discount) }} %</span>

                                @endif
                            </td>


                            <td>

                                @if ($item->status == 1)
                                   <span class="badge rounded-pill bg-success" >Active</span>
                                @else
                                   <span class="badge rounded-pill bg-danger" >Inactive</span>

                                @endif

                            </td>

                            <td>
                                <a href="{{ route('edit_vendor_product', $item->id) }}" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>

                                <a href="{{ route('delete_vendor_product', $item->id) }}" class="btn btn-danger" id="delete" title="Delete" ><i class="fa fa-trash"></i></a>
                                <a href="{{ route('edit_category', $item->id) }}" class="btn btn-info" title="Details"><i class="fa fa-eye"></i></a>

                                @if ($item->status == 1)
                                    <a href="{{ route('vendor_inactivate_product', $item->id) }}" class="btn btn-warning" title="Inactivate" ><i class="fa-solid fa-thumbs-down "></i></a>

                                @else
                                    <a href="{{ route('vendor_activate_product', $item->id) }}" class="btn btn-warning" title="Activate" ><i class="fa-solid fa-thumbs-up "></i></a>

                                @endif


                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>P Image</th>
                            <th>P Name</th>
                            <th>P Price</th>
                            <th>P Quantity</th>
                            <th>P Discount</th>
                            <th>P Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
