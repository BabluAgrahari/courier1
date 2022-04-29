@extends('retailer.layouts.app')
@section('content')
@section('page_heading', 'Spent Amount Topup List')


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
                        <div class="col-sm-4">
                            <label for="buyer_name">
                                Buyer Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="buyer_name" class="form-control input-sm" id="buyer_name"
                                placeholder="Buyer Name" value="{{ old('buyer_name') }}" required>
                            @if ($errors->has('buyer_name'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('buyer_name') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="phone">
                                Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control input-sm" id="phone" placeholder="Phone"
                                value="{{ old('phone') }}" required>
                            @if ($errors->has('phone'))
                                <span class="requride_cls"><strong>{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="phone_alt_alt">
                                Alternate Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone_alt" class="form-control input-sm" id="phone_alt"
                                placeholder="Alternate Phone" value="{{ old('phone_alt') }}" required>
                            @if ($errors->has('phone_alt'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('phone_alt') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="email">
                                E-Mail ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="email" class="form-control input-sm" id="email"
                                placeholder="E-Mail" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="requride_cls"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
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
                                <input type="text" name="bill_address_1" class="form-control input-sm"
                                    id="bill_address_1" placeholder="House Building No"
                                    value="{{ old('bill_address_1') }}" required>
                                @if ($errors->has('bill_address_1'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('bill_address_1') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="bill_address_2">
                                    Billing Address 2<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_address_2" class="form-control input-sm"
                                    id="bill_address_2" placeholder="Street Name" value="{{ old('bill_address_2') }}"
                                    required>
                                @if ($errors->has('bill_address_2'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('bill_address_2') }}</strong></span>
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
                                <input type="number" name="bill_pincode" class="form-control input-sm" id="pincode"
                                    placeholder="Pincode" value="{{ old('pincode') }}">
                                @if ($errors->has('pincode'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('pincode') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label for="city">
                                    City <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_city" class="form-control input-sm" id="city"
                                    placeholder="City" value="{{ old('bill_city') }}" required>
                                @if ($errors->has('bill_city'))
                                    <span class="requride_cls"><strong>{{ $errors->first('city') }}</strong></span>
                                @endif
                            </div>


                            <div class="col-sm-3">
                                <label for="country">
                                    Country <span class="requride_cls">*</span>
                                </label>
                                <select name="bill_country" class="form-control">
                                    <option>Select Country</option>
                                    <option>India</option>
                                </select>

                                @if ($errors->has('bill_country'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('country') }}</strong></span>
                                @endif
                            </div>


                            <div class="col-sm-3">
                                <label for="state">
                                    State <span class="requride_cls">*</span>
                                </label>
                                <select name="bill_state" class="form-control">
                                    <option>Select Stete</option>
                                    <option>Gujarat</option>
                                </select>

                                @if ($errors->has('bill_state'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('bill_state') }}</strong></span>
                                @endif
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
                                <input type="text" name="ship_address_1" class="form-control input-sm"
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
                                <input type="text" name="ship_address_2" class="form-control input-sm"
                                    id="ship_address_2" placeholder="Street Name" value="{{ old('ship_address_2') }}"
                                    required>
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
                                <input type="number" name="ship_pincode" class="form-control input-sm" id="pincode"
                                    placeholder="Pincode" value="{{ old('pincode') }}">
                                @if ($errors->has('pincode'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('pincode') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label for="city">
                                    City <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="ship_city" class="form-control input-sm" id="city"
                                    placeholder="City" value="{{ old('ship_city') }}" required>
                                @if ($errors->has('ship_city'))
                                    <span class="requride_cls"><strong>{{ $errors->first('city') }}</strong></span>
                                @endif
                            </div>


                            <div class="col-sm-3">
                                <label for="country">
                                    Country <span class="requride_cls">*</span>
                                </label>
                                <select name="ship_country" class="form-control">
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
                                <select name="ship_state" class="form-control">
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
                            <input type="text" name="location" class="form-control input-sm" id="location"
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
                        <div class="col-sm-6">
                            <label for="order_id">
                                Order ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="buyer_name" class="form-control input-sm" id="order_id"
                                placeholder="Order ID" value="ORD-{{ random_int(00000000000, 999999999) }}" required>
                            @if ($errors->has('order_id'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_id') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="order_id">
                                Order Date <span class="requride_cls">*</span>
                            </label>
                            <input type="date" name="order_date" class="form-control input-sm" id="order_date"
                                placeholder="Order Date" value="ORD-{{ random_int(00000000000, 999999999) }}"
                                required>
                            @if ($errors->has('order_date'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_date') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="order_channel">
                                Order Channel <span class="requride_cls">*</span>
                            </label>
                            <select name="order_channel" class="form-control" required>
                                <option>Select Channel</option>
                                <option>Channel 1</option>
                            </select>

                            @if ($errors->has('order_channel'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_channel') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="order_type">
                                Order Type <span class="requride_cls">*</span>
                            </label>
                            <select name="order_type" class="form-control" required>
                                <option>Order Type</option>
                                <option>Online</option>
                            </select>

                            @if ($errors->has('order_type'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_type') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="order_tag">
                                Order Tag <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="order_tag" class="form-control input-sm" id="order_tag"
                                placeholder="Order Tag" value="{{ old('order_tag') }}" required>
                            @if ($errors->has('order_tag'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_tag') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Product Details</h3>

                <div class="products">
                    <div class="form-group productFirst">
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="product_name">
                                    Product Name <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="product_name[]" class="form-control input-sm" id="product_name"
                                    placeholder="Product Name" value="{{ old('product_name') }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="sku">
                                    SKU <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="sku[]" class="form-control input-sm" id="sku" placeholder="SKU"
                                    value="{{ old('sku') }}" required>
                            </div>


                            <div class="col-sm-3">
                                <label for="qty">
                                    Quantity <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="qty[]" class="form-control input-sm" id="qty"
                                    placeholder="Quantity" value="{{ old('qty') }}" required>
                            </div>


                            <div class="col-sm-3">
                                <label for="unit_price">
                                    Unit Price <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="unit_price[]" class="form-control input-sm" id="unit_price"
                                    placeholder="Unit Price" value="{{ old('unit_price') }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="tax_rate">
                                    Tax Rate<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="tax_rate[]" class="form-control input-sm" id="tax_rate"
                                    placeholder="Tax Rate" value="{{ old('tax_rate') }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="hsn">
                                    HSN <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="hsn[]" class="form-control input-sm" id="hsn" placeholder="HSN"
                                    value="{{ old('hsn') }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="discount">
                                    Discount (optional) <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="discount[]" class="form-control input-sm" id="discount"
                                    placeholder="Discount" value="{{ old('discount') }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="category">
                                    Product Category <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="category[]" class="form-control input-sm" id="category"
                                    placeholder="Product Category" value="{{ old('category') }}" required>
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
                                <input type="text" name="sub_total" value="0" class="form-control">
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
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <label>Weight (KG)</label>
                                <input type="text" name="weight[]" placeholder="KG" value="0" class="form-control"
                                    required>
                            </div>
                            <div class="col-3">
                                <label>Length (CM)</label>
                                <input type="text" name="length[]" placeholder="CM" value="0" class="form-control"
                                    required>
                            </div>

                            <div class="col-3">
                                <label>Width (CM)</label>
                                <input type="text" name="width[]" placeholder="CM" value="0" class="form-control"
                                    required>
                            </div>

                            <div class="col-3">
                                <label>Height (CM)</label>
                                <input type="text" name="height[]" placeholder="CM" value="0" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group"><br>
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

            $('body').on('click', '.remove', function(e) {
                e.preventDefault();
            })

            let addPckage = $('.packageFirst').clone().html();
            $('body').on('click', '.addPackage', function(e) {
                e.preventDefault();
                $('.packageWeight').append(addPckage);
            })
        });
    </script>
@endpush
@endsection
