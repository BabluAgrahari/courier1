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
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Home</a></li>
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
            <div class="row">
                <div class="col-md-11">
                    <h3 class="card-title">
                        {{ $moduleName }}
                    </h3>
                </div>
                <div class="col-md-1 d-flex">

                    <div id="bluckAssignBlock" class="mr-1" style="pointer-events:none !important;">
                        <button class="btn btn-sm btn-success" aria-haspopup="true" id="bluckAssignBtn" disabled>
                            <i class="fas fa-radiation-alt"></i>&nbsp;Action
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive py-2 table-sm">
            <table id="table" class="table table-hover text-nowrap table-sm">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="select_all" id="checkAll" /></th>
                        <th>Sr No.</th>
                        <th>OrderId</th>
                        <th>Order Date</th>
                        <th>Channel</th>
                        <th>Payment</th>
                        <th>Method</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Tags</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $val)
                    <?php
                    $action = '';
                    $checkbox  = '';
                    if ($val->order_status == 'new' || $val->order_status == 'processing') {
                        $checkbox  = '<input type="checkbox" class="select_me checkbox" value="' . $val->_id . '" />';
                    } ?>
                    <tr>
                        <td>{!! $checkbox !!}</td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $val->order_id }}</td>
                        <td>{{ $val->order_date }}</td>
                        <td>{{ $val->order_channel }}</td>
                        <td>{{ $val->sub_total }}</td>
                        <td>{{ ucwords($val->payment_type) }}</td>
                        <td>{{ ucwords($val->buyer_name) }}</td>
                        <td>{{ $val->phone }}</td>
                        <td>{{ ucwords($val->order_tag) }}</td>
                        <td><button type="button" class="btn btn-success btn-xs">{{ ucwords($val->order_status) }} </button></td>


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


<div class="modal fade" id="bluckAssignBtn1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="heading_bank_dashboard">Order Shipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="cover-loader-modal d-none">
                <div class="loader-modal"></div>
            </div>

            <div class="modal-body">
                <form id="bulk_shipment" action="{{ url('admin/ship-bulk-action') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="order_id" name="order_id">

                            <div class="form-group">
                                <label>Select Api</label>
                                <select class="form-control form-control-sm" name="api" id="api" required>
                                    <option value=''>Select</option>
                                    <option value="Xpressbees">Xpressbees</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success btn-sm" value="Ship">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@push('custom-script')
<script>
    /*start bulk assign shipment*/

    $('#checkAll').click(function() {

        $('.table input:checkbox').prop('checked', this.checked);
        if ($(".table input[type=checkbox]:checked").length > 1) {

            $('#bluckAssignBtn').prop('disabled', false);
            $('#bluckAssignBlock').removeAttr('style');
        } else {
            $('#bluckAssignBtn').prop('disabled', true);
            $('#bluckAssignBlock').css({
                'pointer-events': 'none !important;'
            });
        }
    });
    $('.checkbox').click(function() {
        if ($(".table input[type=checkbox]:checked").length > 0) {
            $('#bluckAssignBtn').prop('disabled', false);
            $('#bluckAssignBlock').removeAttr('style');
        } else {
            $('#bluckAssignBtn').prop('disabled', true);
            $('#bluckAssignBlock').css({
                'pointer-events': 'none !important;'
            });
        }
    });

    $('#bluckAssignBtn').click(function() {
        $('#bulk_shipment')[0].reset();
        var orderID = [];
        $(".table input[type=checkbox]:checked").each(function(i) {
            if ($(this).val() != 'on')
                orderID.push($(this).val());
        });
        $('#order_id').val(orderID);
        $('#bluckAssignBtn1').modal('show');
    })
    /*end bulk assign shipment*/


    /*start form submit functionality*/
    $("form#bulk_shipment").submit(function(e) {
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
                $('.cover-loader-modal').removeClass('d-none');
                $('.modal-body').hide();
            },
            success: function(res) {
                console.log(res);
                //hide loader
                $('.cover-loader-modal').addClass('d-none');
                $('.modal-body').show();


                /*Start Validation Error Message*/
                $('span.custom-text-danger').html('');
                $.each(res.validation, (index, msg) => {
                    $(`#${index}_msg`).html(`${msg}`);
                })
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
                if (res.status == 'success' || res.status == 'error' ) {
                    $('form#bulk_shipment')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            }
        });
    });
</script>
@endpush
@endsection