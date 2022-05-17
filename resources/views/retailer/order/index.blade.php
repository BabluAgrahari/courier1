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
                <a href="{{ route('order.create') }}"><button class="btn btn-primary" style="float:right;"><i
                            class="fa fa-plus"></i> New</button></a>
                {{-- @endpermission --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="datatable table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>OrderId</th>
                        <th>Buyer Name</th>
                        <th>Phone</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $val)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$val->order_id}}</td>
                                <td>{{$val->buyer_name}}</td>
                                <td>{{$val->phone}}</td>
                                <td>{{$val->order_date}}</td>
                                <td>
                                    <a class="btn btn-warning btn-xs changeStatus" href="{{ route('order.edit',[$val->id]) }}">Edit</a>
                                    <a type="button" class="btn btn-info btn-xs shipment" data-toggle="modal" data-target="#exampleModalCenter" data-id={{$val->id}}>
                                        Ready To Ship
                                    </a>
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

@include('retailer.order.model')
@push('custom-script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });


        $('body').on('click','.shipment',function(){
            $('body').find('.ship_id').val($(this).data('id'))
        });

    </script>
@endpush
@endsection
