@extends('retailer.layouts.app')
@section('content')
@section('page_heading', 'Spent Amount Topup List')

<div class="cover-loader d-none">
    <div class="loader"></div>
  </div>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ $moduleName }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{ url('dashboard') }}"><i
                                class="nav-icon fas fa-tachometer-alt"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href=" {{ url('city') }}">{{ $moduleName }}</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
            <h3 class="card-title">Create New Record</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <form id="form" method="post" action="{{ route('address.store') }}" class="form-horizontal form-label-left"
                autocomplete="off">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="name">
                                Address Title <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="title" class="form-control input-sm" id="title" placeholder="Address Title"
                                value="{{ old('title') }}">
                                <span class="requride_cls" id="title_msg"><strong></strong></span>

                        </div>

                        <div class="col-sm-4">
                            <label for="status">
                                Status <span class="requride_cls">*</span>
                            </label>

                            <select name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <span class="requride_cls" id="status_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-4">
                            <label for="pincode">
                                Pincode <span class="requride_cls">*</span>
                            </label>
                            <input type="number" name="pincode" class="form-control input-sm" id="pincode" placeholder="Pincode"
                                value="{{ old('pincode') }}">
                                <span class="requride_cls" id="pincode_msg"><strong></strong></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address">Address *</label>
                            <textarea cols="4" rows="4" class="form-control" placeholder="Address" id="address" name="address"></textarea>
                            <span class="requride_cls" id="address_msg"><strong></strong></span>
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <center>
                <a href=" {{ route('address.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info">Submit</button>
        </div>
        </form>
        <!-- /.card-footer-->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@push('custom-script')
<script>
    /*start form submit functionality*/
    $("#form").submit(function(e) {
        e.preventDefault();
        formData = new FormData(this);
        var url = $(this).attr('action');
        $.ajax({
            data: formData,
            type: "POST",
            url: url,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.cover-loader').removeClass('d-none');
            },
            success: function(res) {
                //hide loader
                $('.cover-loader').addClass('d-none');

                /*Start Validation Error Message*/
                $('span.requride_cls').html('');
                $.each(res.validation, (index, msg) => {
                    $(`#${index}_msg`).html(`${msg}`);
                    $(`#${index}_msg`).addClass('text-danger')
                })
                /*Start Validation Error Message*/

                /*Start Status message*/
                if (res.status == 'success' || res.status == 'error') {
                    Swal.fire(
                        `${res.status}!`,
                        res.msg,
                        `${res.status}`,
                    )
                }
                /*End Status message*/

                //for reset all field
                if (res.status == 'success') {
                    $('#form')[0].reset();
                    $('#custom-file-label').html('');
                }
            }
        });
    });
    /*end form submit functionality*/
</script>
@endpush
@endsection
