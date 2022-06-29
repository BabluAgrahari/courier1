@extends('admin.layouts.app')
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
            <h3 class="card-title">Update New Record</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <form id="form" method="post" action="{{ route('transport.update',$transport->id) }}" class="form-horizontal form-label-left"
                autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $transport->id}}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="transport_from">
                                Transport From <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="transport_from" class="form-control form-control-sm" id="transport_from"
                                placeholder="Transport From" value="{{ old('transport_from',$transport->transport_from) }}">
                                <strong><span class="requride_cls" id="transport_from_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="owner_name">
                                Owner Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="owner_name" class="form-control form-control-sm" id="owner_name"
                                placeholder="Owner Name" value="{{ old('owner_name',$transport->owner_name) }}" >
                                <strong><span class="requride_cls" id="owner_name_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="mobile_no">
                                Mobile No <span class="requride_cls">*</span>
                            </label>
                            <input type="number" name="mobile_no" class="form-control form-control-sm" id="mobile_no"
                                placeholder="Alternate Phone" value="{{ old('mobile_no',$transport->mobile_no) }}" >
                                <span class="requride_cls" id="mobile_no_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="business_name">
                                Business Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="business_name" class="form-control form-control-sm" id="business_name"
                                placeholder="Business Name" value="{{ old('business_name',$transport->business_name) }}" >
                                <strong><span class="requride_cls" id="business_name_msg"></strong></span>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="col-sm-3">
                            <label for="gst_no">
                                GST NO <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="gst_no" class="form-control form-control-sm" id="gst_no"
                                placeholder="GST NO" value="{{ old('gst_no',$transport->gst_no) }}">
                                <strong><span class="requride_cls" id="gst_no_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="gst_no">
                                Whatsapp No <span class="requride_cls">*</span>
                            </label>
                            <input type="number" name="whatsapp_no" class="form-control form-control-sm" id="whatsapp_no"
                                placeholder="Whatsapp No" value="{{ old('whatsapp_no',$transport->whatsapp_no) }}">
                                <strong><span class="requride_cls" id="whatsapp_no_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="phone">
                                Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="number" name="phone" class="form-control form-control-sm" id="phone"
                                placeholder="Phone" value="{{ old('phone',$transport->phone) }}">
                                <strong><span class="requride_cls" id="phone_msg"></strong></span>
                        </div>

                        <br><br><br><br>
                        <div class="col-sm-3">
                            <label for="email">
                                E-Mail ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="email" class="form-control form-control-sm" id="email"
                                placeholder="E-Mail" value="{{ old('email',$transport->email) }}" >
                                <strong><span class="requride_cls" id="email_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="country">
                                Country <span class="requride_cls">*</span>
                            </label>
                            <select name="country" class="form-control">
                                <option value="">Select Country</option>
                                <option value="India" {{ ($transport->country == 'India') ? 'selected' : ''}}>India</option>
                            </select>

                            <strong><span class="requride_cls" id="country_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="state">
                                State <span class="requride_cls">*</span>
                            </label>
                            <select name="state" class="form-control">
                                <option value="">Select Stete</option>
                                <option value="Gujarat" {{ ($transport->state == 'Gujarat') ? 'selected' : ''}}>Gujarat</option>
                            </select>

                            <strong><span class="requride_cls" id="state_msg"></strong></span>
                        </div>

                        <br><br><br><br>
                        <div class="col-sm-3">
                            <label for="city">
                                City <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="city" class="form-control form-control-sm" id="city"
                                placeholder="City" value="{{ old('city',$transport->city) }}">
                                <strong><span class="requride_cls" id="city_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="pincode">
                                Pincode <span class="requride_cls">*</span>
                            </label>
                            <input type="number" name="pincode" class="form-control form-control-sm"
                                id="pincode" placeholder="Pincode" value="{{ old('pincode',$transport->pincode) }}" >
                                <strong><span class="requride_cls" id="pincode_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="address">
                                Address <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="address" class="form-control form-control-sm" id="address"
                                placeholder="Address" value="{{ old('address',$transport->address) }}">
                                <strong><span class="requride_cls" id="address_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="payment_accept">
                                Payment Accept <span class="requride_cls">*</span>
                            </label>
                            <select name="payment_accept" class="form-control">
                                <option value="">Select Payment</option>
                                <option value="prepaid" {{ ($transport->payment_accept == 'prepaid') ? 'selected' : ''}}>Prepaid</option>
                                <option value="to_pay" {{ ($transport->payment_accept == 'to_pay') ? 'selected' : ''}}>To Pay</option>
                            </select>
                            <strong><span class="requride_cls" id="payment_accept_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="service_state">
                                Service State <span class="requride_cls">*</span>
                            </label>
                            <select name="service_state" class="form-control select2" id="service_state">
                                <option value="">Select State</option>
                                @foreach ($states as $key => $val)
                                    <option value="{{ $val->iso2 }}" {{ ($transport->service_state == $val->iso2) ? 'selected' : ''}}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                            <strong><span class="requride_cls" id="service_state_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="service_city">
                                Service City <span class="requride_cls">*</span>
                            </label>
                            <select name="service_city[]" id="service_city" class="form-control select2" multiple>
                                @foreach (explode(',',$transport->service_city) as $city)
                                    <option value="{{$city}}" selected>{{$city}}</option>
                                @endforeach
                            </select>
                            <strong><span class="requride_cls" id="service_city_msg"></strong></span>
                        </div>

                        <br><br><br><br>
                        <div class="col-sm-3">
                            <label for="business_description">
                                Business Description <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="business_description" class="form-control form-control-sm" id="business_description"
                                placeholder="Business Description" value="{{ old('business_description',$transport->business_description) }}">
                                <strong><span class="requride_cls" id="business_description_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="is_verify">
                                Is Verify <span class="requride_cls" >*</span>
                            </label>
                            <select name="is_verify" class="form-control" >
                                <option value="">Select Verify</option>
                                <option value="1" {{ ($transport->is_verify == '1') ? 'selected' : ''}}>Yes</option>
                                <option value="0" {{ ($transport->is_verify == '0') ? 'selected' : ''}}>No</option>
                            </select>
                            <strong><span class="requride_cls" id="is_verify_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="status">
                                Status <span class="requride_cls">*</span>
                            </label>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1" {{ ($transport->status == '1') ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ ($transport->status == '0') ? 'selected' : ''}}>In-Active</option>
                            </select>
                            <strong><span class="requride_cls" id="status_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="logo">
                                Logo <span class="requride_cls">*</span>
                            </label>
                            <input type="file" name="logo" class="form-control form-control-sm" id="logo"
                                placeholder="Logo" accept="jpg,jpeg,png">
                            <input type="hidden" value="{{ $transport->logo}}" name="old_logo">
                            <strong><span class="requride_cls" id="logo_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="store_cover_photo">
                                Store Cover Photo <span class="requride_cls">*</span>
                            </label>
                            <input type="file" name="store_cover_photo" class="form-control form-control-sm" id="store_cover_photo"
                                placeholder="Store Cover Photo" accept="jpg,jpeg,png">
                            <input type="hidden" value="{{ $transport->logo}}" name="old_store_cover_photo">
                            <strong><span class="requride_cls" id="store_cover_photo_msg"></strong></span>
                        </div>

                        <br><br><br><br>
                        <div class="col-sm-3">
                            <label for="logo">Logo</label><br>
                            <img src="{{ asset('transport/'.$transport->logo) }}" width="100%" id="logo"/>
                        </div>

                        <div class="col-sm-3">
                            <label for="cover_photo">Store Cover Photo</label><br>
                            <img src="{{ asset('transport/'.$transport->store_cover_photo) }}" width="100%" id="cover_photo"/>
                        </div>

                    </div>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <center>
                <a href=" {{ route('transport.index') }}" class="btn btn-danger">Cancel</a>
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
        $(document).ready(function() {

            @if(session()->has('success'))
                Swal.fire("{{$moduleName}}","{{ session()->get('success') }}");
            @endif
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
                        $('span.custom-text-danger').html('');
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


            $('body').on('change','#service_state', function() {
                var state = $('#service_state').find(':selected').val();
                var settings = {
                    "url": `https://api.countrystatecity.in/v1/countries/IN/states/${state}/cities`,
                    "method": "GET",
                    "headers": {
                        "X-CSCAPI-KEY": "TjI0c3NLbVFSUmRUckZhdlY2cmROSjNsSmFQR2RjRkR0YTEyTk5KQg=="
                    },
                };

                $.ajax(settings).done(function(res) {
                    $('body').find("#service_city").val('').trigger('change');
                    $("#service_city").html('<option value=""></option>');
                    $.each(res, (index, value) => {
                        $('body').find('#service_city').append(
                            `<option value=${value.name}>${value.name}</option>`)
                    });
                });
            })
        });
    </script>
@endpush
@endsection
