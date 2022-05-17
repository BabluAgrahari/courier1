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
            <form id="form" method="post" action="{{ route('address.update', [$address->id]) }}"
                class="form-horizontal form-label-left" autocomplete="off">
                @method('PUT')
                @csrf
                <input type="hidden" value="{{ $address->id }}" name="id">

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="name">
                                Pickup Location <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="pickup_location" class="form-control form-control-sm" id="title"
                                placeholder="Pickup Location" value="{{ old('pickup_location',$address->pickup_location) }}">
                            <span class="requride_cls" id="pickup_location_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="status">
                                Status <span class="requride_cls">*</span>
                            </label>

                            <select name="status" class="form-control form-control-sm" id="status">
                                <option value="1" {{ ($address->status == 1) ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ ($address->status == 0) ? 'selected' : ''}}>Deactive</option>
                            </select>
                            <span class="requride_cls" id="status_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="address_1">
                                Address 1 <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="address_1" class="form-control form-control-sm" id="address-1"
                                placeholder="Address 1" value="{{ old('address_1',$address->address_1) }}">
                            <span class="requride_cls" id="address_1_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="address_2">
                                Address 2 <span class="address_2">*</span>
                            </label>
                            <input type="text" name="address_2" class="form-control form-control-sm" id="address_2"
                                placeholder="Address 2" value="{{ old('address_2',$address->address_2) }}">
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
                                placeholder="City" value="{{ old('city',$address->city) }}">
                            <span class="requride_cls" id="city_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="state">
                                State <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="state" class="form-control form-control-sm" id="state"
                                placeholder="State" value="{{ old('state',$address->state) }}">
                            <span class="requride_cls" id="state_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="country">
                                Country <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="country" class="form-control form-control-sm" id="country"
                                placeholder="Country" value="{{ old('country',$address->country) }}">
                            </strong><span class="requride_cls" id="country_msg"><strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="pincode">
                                Pincode <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="pincode" class="form-control form-control-sm" id="pincode"
                                placeholder="Pincode" value="{{ old('pincode',$address->pincode) }}">
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
                                placeholder="E-mail" value="{{ old('email',$address->email) }}" />
                            <span class="requride_cls" id="email_msg"></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="phone">
                                Phone <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control form-control-sm" id="phone"
                                placeholder="State" value="{{ old('phone',$address->phone) }}">
                            <span class="requride_cls" id="phone_msg"><strong></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="name">
                                Name <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="name" class="form-control form-control-sm" id="name"
                                placeholder="Name" value="{{ old('name',$address->name) }}">
                            <strong><span class="requride_cls" id="name_msg"></strong></span>
                        </div>

                        <div class="col-sm-3">
                            <label for="company_id">
                                Company ID <span class="requride_cls">*</span>
                            </label>
                            <input type="text" name="company_id" class="form-control form-control-sm" id="company_id"
                                placeholder="Company ID" value="{{ old('company_id',$address->company_id) }}">
                            <strong><span class="requride_cls" id="company_id_msg"></strong></span>
                        </div>


                    </div>
                </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <center>
                <a href=" {{ route('address.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info">Update</button>
        </div>
        </form>
        <!-- /.card-footer-->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@endsection
