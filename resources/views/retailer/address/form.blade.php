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
            <form id="form" method="post" action="{{ route('address.store') }}"
                class="form-horizontal form-label-left" autocomplete="off">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="name">
                                Pickup Location <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="pickup_location" class="form-control form-control-sm" id="title"
                                placeholder="Pickup Location" value="{{ old('title') }}">
                            <span class="requride_cls" id="pickup_location_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="status">
                                Status <span class="requride_cls">*</span>
                            </label>

                            <select name="status" class="form-control form-control-sm" id="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <span class="requride_cls" id="status_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="address_1">
                                Address 1 <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="address_1" class="form-control form-control-sm" id="address-1"
                                placeholder="Address 1" value="{{ old('address_1') }}">
                            <span class="requride_cls" id="address_1_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="address_2">
                                Address 2 <span class="address_2">*</span>
                            </label>
                            <input type="text" name="address_2" class="form-control form-control-sm" id="address_2"
                                placeholder="Address 2" value="{{ old('address_2') }}">
                            <span class="requride_cls" id="address_2_msg"><strong></strong></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="city">
                                City <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="city" class="form-control form-control-sm" id="city"
                                placeholder="City" value="{{ old('city') }}">
                            <span class="requride_cls" id="city_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="state">
                                State <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="state" class="form-control form-control-sm" id="state"
                                placeholder="State" value="{{ old('state') }}">
                            <span class="requride_cls" id="state_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="country">
                                Country <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="country" class="form-control form-control-sm" id="country"
                                placeholder="Country" value="{{ old('country') }}">
                            </strong><span class="requride_cls" id="country_msg"><strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="pincode">
                                Pincode <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="pincode" class="form-control form-control-sm" id="pincode"
                                placeholder="Pincode" value="{{ old('pincode') }}">
                            </strong><span class="requride_cls" id="pincode_msg"><strong></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="email">
                                E-mail <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="email" class="form-control form-control-sm" id="email"
                                placeholder="E-mail" value="{{ old('email') }}" />
                            <span class="requride_cls" id="email_msg"></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="phone">
                                Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control form-control-sm" id="phone"
                                placeholder="State" value="{{ old('phone') }}">
                            <span class="requride_cls" id="phone_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="name">
                                Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="name" class="form-control form-control-sm" id="name"
                                placeholder="Name" value="{{ old('name') }}">
                            <strong><span class="requride_cls" id="name_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="company_id">
                                Company ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="company_id" class="form-control form-control-sm" id="company_id"
                                placeholder="Company ID" value="{{ old('company_id') }}">
                            <strong><span class="requride_cls" id="company_id_msg"></strong></span>
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
