@extends('retailer.layouts.app')
@section('content')
@section('page_heading', $moduleName)

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i
                                class="nav-icon fas fa-tachometer-alt"></i> Home</a></li>
                    <li class="breadcrumb-item active">{{ $moduleName }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $moduleName }}</h3>
            <div class="card-tools">
                {{-- @permission('add.penalty.type') --}}
                <a href="{{ route('transport.create') }}"><button class="btn btn-primary" style="float:right;"><i
                            class="fa fa-plus"></i> New</button></a>
                {{-- @endpermission --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="datatable table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Owner Name</th>
                        <th>Transport From</th>
                        <th>Mobile No</th>
                        <th>Business Name</th>
                        <th>GST No</th>
                        <th>Whatsapp No</th>
                        <th>E-Mail</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transports as $key => $val)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$val->owner_name}}</td>
                            <td>{{$val->transport_from}}</td>
                            <td>{{$val->mobile_no}}</td>
                            <td>{{$val->business_name}}</td>
                            <td>{{$val->gst_no}}</td>
                            <td>{{$val->whatsapp_no}}</td>
                            <td>{{$val->email}}</td>
                            <td>{{$val->country}}</td>
                            <td>{{$val->state}}</td>
                            <td>{{$val->city}}</td>
                            <td>{{$val->pincode}}</td>
                            <td>{{($val->status == 1) ? "Active" : "In-Active"}}</td>
                            <td>
                                <td>
                                    <a class="btn btn-warning btn-xs changeStatus" href="{{ route('transport.edit',[$val->id]) }}"><i class="far fa-edit"></i></a>
                                    <a type="button" class="btn btn-info btn-xs shipment" data-toggle="modal" data-target="#exampleModalCenter" data-id={{$val->id}}>
                                        Ready To Ship
                                    </a>
                                </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>

        <!-- /.card-footer-->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@push('custom-script')
    <script>
        $(document).ready(function() {
        $('.datatable').DataTable();

        $('body').on('click','.shipment',function(){
            var orderId = $(this).data('id');
            $('body').find('.ship_id').val(orderId);
            $.ajax({
                type: "GET",
                url: `{{ url('retailer/order/getDistance/${orderId}') }}`,
                dataType: "json",
                success: function (response) {
                    $('body').find('#order_km').text(response);
                }
            });
        });

})
    </script>
@endpush
@endsection
