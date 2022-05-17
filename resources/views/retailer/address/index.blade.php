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
                <a href="{{ route('address.create') }}"><button class="btn btn-primary" style="float:right;"><i
                            class="fa fa-plus"></i> New</button></a>
                {{-- @endpermission --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Pickup Location</th>
                        <th>Address 1</th>
                        <th>Pincode</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $key => $address)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $address->pickup_location }}</td>
                            <td>{{ $address->address_1 }}</td>
                            <td>{{ $address->pincode }}</td>
                            <td><span
                                    class="badge {{ $address->status == 1 ? 'bg-success' : 'bg-danger' }} ">{{ $address->status == 1 ? 'Active' : 'Deactive' }}</span>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-xs" href="{{ route('address.edit',[$address->id]) }}">Edit</a>
                                @if ($address->status == 1)
                                    <a class="btn btn-success btn-xs" href="{{ route('address.changeStatus',[$address->id]) }}">Deactive</a>
                                @else
                                    <a class="btn btn-danger btn-xs" href="{{ route('address.changeStatus',[$address->id]) }}">Active</a>
                                @endif

                                <a class="btn btn-danger btn-xs changeStatus" href="{{ route('address.destroy',[$address->id]) }}">Delete</a>
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
            })

            $('.datatable').DataTable();
        });
    </script>
@endpush
@endsection
