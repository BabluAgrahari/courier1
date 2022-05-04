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
            <form id="form" method="post" action="{{ route('order.update',[$order->id]) }}" class="form-horizontal form-label-left"
                autocomplete="off">
                @method('PUT')
                <input type="hidden" name="id" value="{{ $order->id }}">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="buyer_name">
                                Buyer Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="buyer_name" class="form-control form-control-sm" id="buyer_name"
                                placeholder="Buyer Name" value="{{ old('buyer_name',$order->buyer_name) }}" required>
                            @if ($errors->has('buyer_name'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('buyer_name') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-3">
                            <label for="phone">
                                Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="number" name="phone" class="form-control form-control-sm" id="phone" placeholder="Phone"
                                value="{{ old('phone',$order->phone) }}" min="10" required>
                            @if ($errors->has('phone'))
                                <span class="requride_cls"><strong>{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-3">
                            <label for="phone_alt_alt">
                                Alternate Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone_alt" class="form-control form-control-sm" id="phone_alt"
                                placeholder="Alternate Phone" value="{{ old('phone_alt') }}">
                            @if ($errors->has('phone_alt',$order->phone_alt))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('phone_alt') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-3">
                            <label for="email">
                                E-Mail ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="email" class="form-control form-control-sm" id="email"
                                placeholder="E-Mail" value="{{ old('email',$order->email) }}" required>
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
                                <input type="text" name="bill_address_1" class="form-control form-control-sm"
                                    id="bill_address_1" placeholder="House Building No"
                                    value="{{ old('bill_address_1',$order->bill_address_1) }}" required>
                                @if ($errors->has('bill_address_1'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('bill_address_1') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="bill_address_2">
                                    Billing Address 2<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_address_2" class="form-control form-control-sm"
                                    id="bill_address_2" placeholder="Street Name" value="{{ old('bill_address_2',$order->bill_address_2) }}"
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
                                <input type="number" name="bill_pincode" class="form-control form-control-sm" id="pincode"
                                    placeholder="Pincode" value="{{ old('pincode',$order->bill_pincode) }}">
                                @if ($errors->has('pincode'))
                                    <span
                                        class="requride_cls"><strong>{{ $errors->first('pincode') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label for="city">
                                    City <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="bill_city" class="form-control form-control-sm" id="city"
                                    placeholder="City" value="{{ old('bill_city',$order->bill_city) }}" required>
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
                                    <option value="India" {{ ($order->bill_country == 'India') ? 'selected' : ''}}>India</option>
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
                                    <option value="Gujarat" {{ ($order->bill_state == 'Gujarat') ? 'selected' : ''}}>Gujarat</option>
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
                    <input type="checkbox" id="same_both" class="same_both" name="address_both_same" @if($order->address_both_same == 1) checked @endif> Billing
                    address same as delivery address
                </div>

                <div class="shipping_address {{ ($order->address_both_same == 1) ? "d-none" : "" }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ship_address_1">
                                    Shipping Address 1<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="ship_address_1" class="form-control form-control-sm"
                                    id="ship_address_1" placeholder="House Building No"
                                    value="{{ old('ship_address_1',$order->ship_address_1) }}">
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
                                    id="ship_address_2" placeholder="Street Name" value="{{ old('ship_address_2',$order->ship_address_2) }}"
                                    >
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
                                <input type="number" name="ship_pincode" class="form-control form-control-sm" id="pincode"
                                    placeholder="Pincode" value="{{ old('pincode',$order->ship_pincode) }}">
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
                                    placeholder="City" value="{{ old('ship_city',$order->ship_city) }}" >
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
                                    <option value="India" {{ ($order->ship_country == 'India') ? 'selected' : ''}}>India</option>
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
                                    <option value="Gujarat" {{ ($order->ship_country == 'Gujarat') ? 'selected' : ''}}>Gujarat</option>
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
                    <input type="checkbox" id="hyperlocal_shipment" name="hyperlocal_shipment" {{($order->hyperlocal_shipment == 1) ? 'checked' : ''}}> Select For
                    Hyperlocal Shipment
                </div>

                <div class="form-group hyperlocal_shipment {{($order->hyperlocal_shipment == 1) ? 'd-none' : ''}}" >
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="location">
                                Enter Location<span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="location" class="form-control form-control-sm" id="location"
                                placeholder="Enter a Location" value="{{ old('location',$order->location) }}">
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
                                placeholder="Order ID" value="{{ old('order_id',$order->order_id)}}" required>
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
                                placeholder="Order Date" value="{{ $order->order_date}}"
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
                            <select name="order_channel" class="form-control form-control-sm" required>
                                <option>Select Channel</option>
                                <option value="Channel 1" {{ ($order->order_channel == 'Channel 1') ? 'selected' : ''}}>Channel 1</option>
                            </select>

                            @if ($errors->has('order_channel'))
                                <span
                                    class="requride_cls"><strong>{{ $errors->first('order_channel') }}</strong></span>
                            @endif
                        </div>

                        <div class="col-sm-3">
                            <label for="order_type">
                                Order Type <span class="requride_cls">*</span>
                            </label>
                            <select name="order_type" class="form-control form-control-sm" required>
                                <option>Order Type</option>
                                <option value="Online" {{($order->order_type == 'Online') ? 'selected' : ''}}>Online</option>
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
                        <div class="col-sm-3">
                            <label for="order_tag">
                                Order Tag <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="order_tag" class="form-control form-control-sm" id="order_tag"
                                placeholder="Order Tag" value="{{ old('order_tag',$order->order_tag) }}" required>
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
                        @php $products = collect($order->productDetails); @endphp
                        @forelse ($products as $val)
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label for="product_name">
                                    Product Name <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="product_name[]" class="form-control form-control-sm" id="product_name"
                                    placeholder="Product Name" value="{{ old('product_name',$val["product_name"]) }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="sku">
                                    SKU <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="sku[]" class="form-control form-control-sm" id="sku" placeholder="SKU"
                                    value="{{ old('sku',$val["sku"]) }}" required>
                            </div>


                            <div class="col-sm-3">
                                <label for="qty">
                                    Quantity <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="qty[]" class="form-control form-control-sm qty calculate" id="qty"
                                    placeholder="Quantity" value="{{ old('qty',$val["qty"]) }}" required>
                            </div>


                            <div class="col-sm-3">
                                <label for="unit_price">
                                    Unit Price <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="unit_price[]" class="form-control form-control-sm unit_price calculate" id="unit_price"
                                    placeholder="Unit Price" value="{{ old('unit_price',$val["unit_price"]) }}"  required>
                            </div>

                            <div class="col-sm-3">
                                <label for="tax_rate">
                                    Tax Rate<span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="tax_rate[]" class="form-control form-control-sm" id="tax_rate"
                                    placeholder="Tax Rate" value="{{ old('tax_rate',$val["tax_rate"]) }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="hsn">
                                    HSN <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="hsn[]" class="form-control form-control-sm" id="hsn" placeholder="HSN"
                                    value="{{ old('hsn',$val['hsn']) }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="discount">
                                    Discount (optional) <span class="requride_cls">*</span>
                                </label>
                                <input type="number" name="discount[]" class="form-control form-control-sm discount calculate" id="discount"
                                    placeholder="Discount" value="{{ old('discount',$val["discount"]) }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="category">
                                    Product Category <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="category[]" class="form-control form-control-sm" id="category"
                                    placeholder="Product Category" value="{{ old('category',$val["category"]) }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="amount">
                                    Total Amount <span class="requride_cls">*</span>
                                </label>
                                <input type="text" name="amount[]" class="form-control form-control-sm amount" id="amount"
                                    placeholder="Amount" value="{{ old('amount',$val["amount"]) }}" readonly>
                            </div>
                        </div>
                        @empty

                        @endforelse
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
                                <input type="radio" name="payment_type" value="case" {{ ($order->payment_type == "case") ? 'checked' : ''}}>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Prepaid</label>
                                <input type="radio" name="payment_type" value="prepaid" {{ ($order->payment_type == "prepaid") ? 'checked' : ''}}>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Sub Total</label>
                                <input type="text" name="sub_total" value="{{ $order->sub_total}}" class="form-control" id="sub_total" readonly>
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
                                    class="form-control" value={{ old('pickup_address',$order->pickup_address)}}>
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
                                                value="{{ $val->id }}" {{ ($val->id == $order->pickup_address_id) ? 'checked' : ''}}>
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
                        @php $packageDetails = collect($order->packageDetail); @endphp
                        @foreach ($packageDetails as $val)
                        <div class="row">
                            <div class="col-3">
                                <label>Weight (KG)</label>
                                <input type="text" name="weight[]" placeholder="KG" value="{{ old('weigth',$val['weight']) }}" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-3">
                                <label>Length (CM)</label>
                                <input type="text" name="length[]" placeholder="CM" value="{{ old('weigth',$val['length']) }}" class="form-control form-control-sm"
                                    required>
                            </div>

                            <div class="col-3">
                                <label>Width (CM)</label>
                                <input type="text" name="width[]" placeholder="CM" value="{{ old('weigth',$val['width']) }}" class="form-control form-control-sm"
                                    required>
                            </div>

                            <div class="col-3">
                                <label>Height (CM)</label>
                                <input type="text" name="height[]" placeholder="CM" value="{{ old('weigth',$val['height']) }}" class="form-control form-control-sm"
                                    required>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="form-group"><br>
                    <button type="button" class="addPackage btn btn-success">Add More.</button>
                </div>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <center>
                <a href=" {{ route('order.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info">Update</button>
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
                    $('.shipping_address').addClass('d-none');
                } else {
                    $('.shipping_address').removeClass('d-none')
                }
            })

            $('body').on('change', '#hyperlocal_shipment', function() {
                if ($(this).is(':checked')) {
                    $('.hyperlocal_shipment').removeClass('d-none');
                } else {
                    $('.hyperlocal_shipment').addClass('d-none');
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

            const calculation = () => {
                var sub_total = 0;
                var qty = 0;
                var unitPrice = 0;
                var discount = 0;
                var amount = 0;

                $('.discount').each(function(){
                    var unitPrice = $(this).closest('.form-group').find('.unit_price').val()
                    var qty = $(this).closest('.form-group').find('.qty').val()
                    var discount = $(this).val();
                    var amount = (qty * unitPrice) - discount;
                    $(this).closest('.form-group').find('.amount').val(amount.toFixed(2));
                })

                $('.amount').each(function(){
                    sub_total += parseFloat($(this).val());
                })

                $('#sub_total').val(sub_total.toFixed(2));
            }

            $('body').on('keyup','.calculate',function(){
                calculation()
            })
        });
    </script>
@endpush
@endsection
