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
            <form id="form" method="post" action="{{ route('order.store') }}" class="form-horizontal form-label-left"
                autocomplete="off">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="buyer_name">
                                Buyer Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="buyer_name" class="form-control form-control-sm" id="buyer_name"
                                placeholder="Buyer Name" value="{{ old('buyer_name') }}">
                            <span class="requride_cls" id="buyer_name_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="phone">
                                Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control form-control-sm" id="phone"
                                placeholder="Phone" value="{{ old('phone') }}" >
                            <span class="requride_cls" id="phone_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="phone_alt_alt">
                                Alternate Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone_alt" class="form-control form-control-sm" id="phone_alt"
                                placeholder="Alternate Phone" value="{{ old('phone_alt') }}" >
                            <span class="requride_cls" id="phone_alt_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="email">
                                E-Mail ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="email" class="form-control form-control-sm" id="email"
                                placeholder="E-Mail" value="{{ old('email') }}" >
                            <span class="requride_cls" id="email_msg"><strong></strong></span>
                        </div>
                    </div>
                </div>


                <hr>
                <h3>Buyer Address</h3>

                <div class="billing_address">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="bill_address_1">
                                    Billing Address 1<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_address_1" class="form-control form-control-sm"
                                    id="bill_address_1" placeholder="House Building No"
                                    value="{{ old('bill_address_1') }}" >
                                <span class="requride_cls" id="bill_address_1_msg"><strong></strong></span>
                            </div>

                            <div class="col-sm-6">
                                <label for="bill_address_2">
                                    Billing Address 2<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_address_2" class="form-control form-control-sm"
                                    id="bill_address_2" placeholder="Street Name" value="{{ old('bill_address_2') }}"
                                    >
                                <span class="requride_cls" id="bill_address_2_msg"><strong></strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="pincode">
                                    Pincode <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="bill_pincode" class="form-control form-control-sm"
                                    id="pincode" placeholder="Pincode" value="{{ old('pincode') }}" required>
                                <span class="requride_cls" id="pincode_msg"><strong></strong></span>
                            </div>

                            <div class="col-sm-3">
                                <label for="city">
                                    City <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_city" class="form-control form-control-sm" id="city"
                                    placeholder="City" value="{{ old('bill_city') }}" >
                                <span class="requride_cls" id="bill_city_msg"><strong></strong></span>
                            </div>


                            <div class="col-sm-3">
                                <label for="country">
                                    Country <span class="requride_cls">*</span>
                                </label>
                                <select name="bill_country" class="form-control">
                                    <option value="">Select Country</option>
                                    <option value="India">India</option>
                                </select>

                                <span class="requride_cls" id="bill_country_msg"><strong></strong></span>
                            </div>


                            <div class="col-sm-3">
                                <label for="state">
                                    State <span class="requride_cls">*</span>
                                </label>
                                <select name="bill_state" class="form-control">
                                    <option value="">Select Stete</option>
                                    <option value="Gujarat">Gujarat</option>
                                </select>

                                <span class="requride_cls" id="bill_state_msg"><strong></strong></span>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="same_both" class="same_both" name="address_both_same"> Billing
                    address same as delivery address
                </div>

                <div class="shipping_address">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ship_address_1">
                                    Shipping Address 1<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="ship_address_1" class="form-control form-control-sm"
                                    id="ship_address_1" placeholder="House Building No"
                                    value="{{ old('ship_address_1') }}" required>
                                @if ($errors->has('ship_address_1'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('ship_address_1') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="ship_address_2">
                                    Shipping Address 2<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="ship_address_2" class="form-control form-control-sm"
                                    id="ship_address_2" placeholder="Street Name"
                                    value="{{ old('ship_address_2') }}" required>
                                @if ($errors->has('ship_address_2'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('ship_address_2') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="pincode">
                                    Pincode <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="ship_pincode" class="form-control form-control-sm"
                                    id="pincode" placeholder="Pincode" value="{{ old('pincode') }}" required>
                                @if ($errors->has('pincode'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('pincode') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label for="city">
                                    City <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="ship_city" class="form-control form-control-sm" id="city"
                                    placeholder="City" value="{{ old('ship_city') }}" required>
                                @if ($errors->has('ship_city'))
                                    <span class="requride_cls"><strong>{{ $errors->first('city') }}</strong></span>
                                @endif
                            </div>


                            <div class="col-sm-3">
                                <label for="country">
                                    Country <span class="requride_cls">*</span>
                                </label>
                                <select name="ship_country" class="form-control" required>
                                    <option>Select Country</option>
                                    <option>India</option>
                                </select>

                                @if ($errors->has('ship_country'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('country') }}</strong></span>
                                @endif
                            </div>


                            <div class="col-sm-3">
                                <label for="state">
                                    State <span class="requride_cls">*</span>
                                </label>
                                <select name="ship_state" class="form-control" required>
                                    <option>Select Stete</option>
                                    <option>Gujarat</option>
                                </select>

                                @if ($errors->has('ship_state'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('ship_state') }}</strong></span>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <input type="checkbox" id="hyperlocal_shipment" name="hyperlocal_shipment" checked> Select For
                    Hyperlocal Shipment
                </div>

                <div class="form-group hyperlocal_shipment">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="location">
                                Enter Location<span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="location" class="form-control form-control-sm" id="location"
                                placeholder="Enter a Location" value="{{ old('location') }}" required>
                            @if ($errors->has('location'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('location') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Order Details</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="order_id">
                                Order ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="order_id" class="form-control form-control-sm" id="order_id"
                                placeholder="Order ID" value="ORD-{{ random_int(00000000000, 999999999) }}" >
                            @if ($errors->has('order_id'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_id') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-3">
                            <label for="order_id">
                                Order Date <span class="requride_cls">*</span>
                            </label>
                            <input type="date" name="order_date" class="form-control form-control-sm" id="order_date"
                                placeholder="Order Date" value="ORD-{{ random_int(00000000000, 999999999) }}"
                                required>
                            @if ($errors->has('order_date'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_date') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-3">
                            <label for="order_channel">
                                Order Channel <span class="requride_cls">*</span>
                            </label>
                            <select name="order_channel" class="form-control form-control-sm" >
                                <option value="">Select Channel</option>
                                <option value="Channel 1">Channel 1</option>
                            </select>

                            <span class="requride_cls" id="order_channel_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="order_type">
                                Order Type <span class="requride_cls">*</span>
                            </label>
                            <select name="order_type" class="form-control form-control-sm" >
                                <option value="">Order Type</option>
                                <option value="Online">Online</option>
                            </select>

                            <span class="requride_cls" id="order_type_msg"><strong></strong></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="order_tag">
                                Order Tag <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="order_tag" class="form-control form-control-sm" id="order_tag"
                                placeholder="Order Tag" value="{{ old('order_tag') }}" >
                            <span class="requride_cls" id="order_tag_msg"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Product Details</h3>

                <div class="products">
                    <div class="form-group productFirst">
                        <hr>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label for="product_name">
                                    Product Name <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="product_name[]" class="form-control form-control-sm"
                                    id="product_name" placeholder="Product Name" value="{{ old('product_name') }}"
                                    >
                            </div>

                            <div class="col-sm-3">
                                <label for="sku">
                                    SKU <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="sku[]" class="form-control form-control-sm" id="sku"
                                    placeholder="SKU" value="{{ old('sku') }}" >
                            </div>


                            <div class="col-sm-3">
                                <label for="qty">
                                    Quantity <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="qty[]" class="form-control form-control-sm qty calculate"
                                    id="qty" placeholder="Quantity" value="{{ old('qty', 0) }}" >
                            </div>


                            <div class="col-sm-3">
                                <label for="unit_price">
                                    Unit Price <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="unit_price[]"
                                    class="form-control form-control-sm unit_price calculate" id="unit_price"
                                    placeholder="Unit Price" value="{{ old('unit_price') }}" >
                            </div>

                            <div class="col-sm-3">
                                <label for="tax_rate">
                                    Tax Rate<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="tax_rate[]" class="form-control form-control-sm" id="tax_rate"
                                    placeholder="Tax Rate" value="{{ old('tax_rate') }}" >
                            </div>

                            <div class="col-sm-3">
                                <label for="hsn">
                                    HSN <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="hsn[]" class="form-control form-control-sm" id="hsn"
                                    placeholder="HSN" value="{{ old('hsn') }}" >
                            </div>

                            <div class="col-sm-3">
                                <label for="discount">
                                    Discount (optional) <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="discount[]"
                                    class="form-control form-control-sm discount calculate" id="discount"
                                    placeholder="Discount" value="{{ old('discount', 0) }}" >
                            </div>

                            <div class="col-sm-3">
                                <label for="category">
                                    Product Category <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="category[]" class="form-control form-control-sm" id="category"
                                    placeholder="Product Category" value="{{ old('category') }}" >
                            </div>

                            <div class="col-sm-3">
                                <label for="amount">
                                    Total Amount <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="amount[]" class="form-control form-control-sm amount"
                                    id="amount" placeholder="Amount" value="{{ old('amount', 0) }}" readonly>
                            </div>

                            <div class="col-sm-3">
                                <button class="remove_product btn btn-danger mt-3"> Remove </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="button" class="addMore btn btn-success">Add More.</button>
                </div>

                <hr>
                <h3>Payments</h3>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Case On Delivery</label>
                                <input type="radio" name="payment_type" value="case">
                            </div>
                            <span class="requride_cls" id="payment_type_msg"><strong></strong></span>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Prepaid</label>
                                <input type="radio" name="payment_type" value="prepaid">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Sub Total</label>
                                <input type="text" name="sub_total" value="0" class="form-control" id="sub_total"
                                    >
                                <span class="requride_cls" id="sub_total_msg"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h3>Pickup Address</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Select a pickup location for the Order</label>
                                <input type="text" name="pickup_address"
                                    placeholder="Search by location name,address,city,state,pincode"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        @foreach ($addresses as $key => $val)
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ $val->title }}
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{{ $val->address }}</p>
                                            <p class="card-text">{{ $val->pincode }}</p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <input type="radio" name="pickup_address_id" class="custom-control"
                                                value="{{ $val->id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <h3>Package Weight</h3>

                <div class="packageWeight">
                    <div class="form-group packageFirst">
                        <div class="package">
                            <hr>
                            <div class="row">
                                <div class="col-2">
                                    <label>Weight (KG)</label>
                                    <input type="text" name="weight[]" placeholder="KG" value="0"
                                        class="form-control form-control-sm" >
                                </div>
                                <div class="col-2">
                                    <label>Length (CM)</label>
                                    <input type="text" name="length[]" placeholder="CM" value="0"
                                        class="form-control form-control-sm" >
                                </div>

                                <div class="col-2">
                                    <label>Width (CM)</label>
                                    <input type="text" name="width[]" placeholder="CM" value="0"
                                        class="form-control form-control-sm" >
                                </div>

                                <div class="col-2">
                                    <label>Height (CM)</label>
                                    <input type="text" name="height[]" placeholder="CM" value="0"
                                        class="form-control form-control-sm" >
                                </div>

                                <div class="col-2">
                                    <button type="button" class="remove_package btn btn-danger mt-3">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group mt-3">
                    <button type="button" class="addPackage btn btn-success">Add More.</button>
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
        $(document).ready(function() {

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


            $('body').on('change', '#same_both', function() {
                if ($(this).is(':checked')) {
                    $('.shipping_address').hide();
                } else {
                    $('.shipping_address').show();
                }
            })

            $('body').on('change', '#hyperlocal_shipment', function() {
                if ($(this).is(':checked')) {
                    $('.hyperlocal_shipment').show();
                } else {
                    $('.hyperlocal_shipment').hide();
                }
            })

            let addMore = $('.productFirst').clone().html();
            $('body').on('click', '.addMore', function(e) {
                e.preventDefault();
                $('.productFirst').append(addMore);
            })

            $('body').on('click', '.remove_product', function(e) {
                e.preventDefault();
                if ($(this).closest('.productFirst').find('.form-group').length > 1) {
                    $(this).closest('.form-group').remove();
                }
            })

            $('body').on('click', '.remove_package', function(e) {
                e.preventDefault();

                if($('.package').length >1) {
                    $(this).closest('.package').remove();
                }
            })



            let addPckage = $('.packageFirst').clone().html();
            $('body').on('click', '.addPackage', function(e) {
                e.preventDefault();
                $('.packageWeight').append(addPckage);
            })

            const calculation = () => {
                var sub_total = 0;
                var qty = 0;
                var unitPrice = 0;
                var discount = 0;
                var amount = 0;

                $('.discount').each(function() {
                    var unitPrice = $(this).closest('.form-group').find('.unit_price').val()
                    var qty = $(this).closest('.form-group').find('.qty').val()
                    var discount = $(this).val();
                    var amount = (qty * unitPrice) - discount;
                    $(this).closest('.form-group').find('.amount').val(amount.toFixed(2));
                })

                $('.amount').each(function() {
                    sub_total += parseFloat($(this).val());
                })

                $('#sub_total').val(sub_total.toFixed(2));
            }

            $('body').on('keyup', '.calculate', function() {
                calculation()
            })
        });
    </script>
@endpush
@endsection
