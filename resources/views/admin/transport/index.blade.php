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
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val->owner_name }}</td>
                            <td>{{ $val->transport_from }}</td>
                            <td>{{ $val->mobile_no }}</td>
                            <td>{{ $val->business_name }}</td>
                            <td>{{ $val->gst_no }}</td>
                            <td>{{ $val->whatsapp_no }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->country }}</td>
                            <td>{{ $val->state }}</td>
                            <td>{{ $val->city }}</td>
                            <td>{{ $val->pincode }}</td>
                            <td>{{ $val->payment_accept}}</td>
                            <td><span
                                    class="badge {{ $val->status == 1 ? 'bg-success' : 'bg-danger' }} ">{{ $val->status == 1 ? 'Active' : 'Deactive' }}</span>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-xs"
                                    href="{{ route('transport.edit', [$val->id]) }}">Edit</a>
                                @if ($val->status == 1)
                                    <a class="btn btn-success btn-xs m-1"
                                        href="{{ route('transport.changeStatus', [$val->id]) }}">Deactive</a>
                                @else
                                    <a class="btn btn-danger btn-xs m-1"
                                        href="{{ route('transport.changeStatus', [$val->id]) }}">Active</a>
                                @endif
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

            $('body').on('click', '.changeStatus', function(e) {
                e.preventDefault();
                var status = $(this).text();
                var url = $(this).attr('href');
                swal({
                        title: `${status}`,
                        text: `Are You Sure Want ${status}`,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location = url;
                        }
                    });
            });

        })
    </script>
@endpush
@endsection
