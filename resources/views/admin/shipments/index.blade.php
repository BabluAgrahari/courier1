@extends('admin.layouts.app')
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
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Home</a></li>
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
            <div class="row">
                <div class="col-md-11">
                    <h3 class="card-title">
                        {{ $moduleName }}
                    </h3>
                </div>
                <div class="col-md-1 d-flex">

                    <!-- <div id="bluckAssignBlock" class="mr-1" style="pointer-events:none !important;">
                        <button class="btn btn-sm btn-success" aria-haspopup="true" id="bluckAssignBtn" disabled>
                            <i class="fas fa-radiation-alt"></i>&nbsp;Action
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="card-body table-responsive py-2 table-sm">
            <table id="table" class="table table-hover text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>OrderId</th>
                        <th>Shipment Date</th>
                        <th>Method</th>
                        <th>AWB Number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $key => $val)
                  
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $val->order_id }}</td>
                        <td>{{ date('Y-m-d',$val->created) }}</td>
                        <td>{{ ucwords($val->payment_type) }}</td>
                        <td>{{ !empty($val->awb_number) ? $val->awb_number: '' }}</td>
                        <td>{{ ucwords($val->ship_status) }}</td>
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


@endsection