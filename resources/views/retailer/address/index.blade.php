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
            <table class="datatable table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Title</th>
                        <th>Address</th>
                        <th>Pincode</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $key => $address)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $address->title }}</td>
                            <td>{{ $address->address }}</td>
                            <td>{{ $address->pincode }}</td>
                            <td><span
                                    class="badge {{ $address->status == 1 ? 'bg-success' : 'bg-danger' }} ">{{ $address->status == 1 ? 'Active' : 'Deactive' }}</span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-xs">Edit</button>
                                @if ($address->status == 1)
                                    <button class="btn btn-danger btn-xs changeStatus">Deactive</button>
                                @else
                                    <button class="btn btn-success btn-xs changeStatus">Active</button>
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
            $('body').on('click', '.changeStatus', function() {
                var status = $(this).text();
                swal({
                        title: `${status}`,
                        text: `Are You Sure Want ${status}`,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            alert('This is Under Maintaince')
                        }
                    });
            })

            $('.datatable').DataTable();
        });
    </script>
@endpush
@endsection
