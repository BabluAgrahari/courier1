@extends('admin.layouts.app')

@section('content')
@section('page_heading', 'Bank Charges List')

<div class="row">
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bank Charges List</h3>
                <div class="card-tools">
                    <a href="javascript:void(0);" outlet_id='{{ $id }}' class="btn btn-sm btn-success mr-2"
                        id="add_bank_charges"><i class="fas fa-plus-circle"></i>&nbsp;Add</a>
                    <a href="{{ url('admin/outlets') }}" class="btn btn-sm btn-warning"><i
                            class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back</a>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive py-4">
                <table id="table" class="table table-hover table-sm text-nowrap">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>API Name</th>
                            <th>From State</th>
                            <!-- <th>From City</th> -->
                            <th>To State</th>
                            <!-- <th>To City</th> -->
                            <th>Charges</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($bank_charges))
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($bank_charges as $key => $bank)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{!! !empty($bank['api_id']) ? getAPIName($bank['api_id']) : ''  !!}</td>
                                    <td>{!! !empty($bank['from_state']) ? ($bank['from_state']) : mSign(0) !!}</td>
                                    <!-- <td>{!! !empty($bank['from_city']) ? ($bank['from_city']) : mSign(0) !!}</td> -->
                                    <td>{!! !empty($bank['to_state']) ? ($bank['to_state']) : mSign(0) !!}</td>
                                    <!-- <td>{!! !empty($bank['to_city']) ? ($bank['to_city']) : mSign(0) !!}</td> -->

                                    <td>{{ !empty($bank['charges']) ? $bank['charges'] : 0 }}</td>
                                    <td>
                                        @if (!empty($bank['status']) && $bank['status'] == 1)
                                            <a href="javascript:void(0);"><span class="badge badge-success activeVer"
                                                    key="{{ $key }}" id="active_{{ $key }}"
                                                    _id="{{ $id }}" val="0">Active</span></a>
                                        @else
                                            <a href="javascript:void(0)"><span class="badge badge-danger activeVer"
                                                    key="{{ $key }}" id="active_{{ $key }}"
                                                    _id="{{ $id }}" val="1">Inactive</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="text-info edit_bank_account"
                                            bank_account_id="{{ $id }}" key="{{ $key }}"
                                            data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

@push('modal')
    <!-- Modal -->
    @include('admin.outlet.model')

    <script>
        // $('body').on('change', '.to_state', function() {
        //     var state = $('#to_state').find(':selected').val();
        //     $('body').find("#to_city").val('').trigger('change');
        //     $('body').find("#to_city").prop('disabled', true);
        //     var settings = {
        //         "url": `https://api.countrystatecity.in/v1/countries/IN/states/${state}/cities`,
        //         "method": "GET",
        //         "headers": {
        //             "X-CSCAPI-KEY": "TjI0c3NLbVFSUmRUckZhdlY2cmROSjNsSmFQR2RjRkR0YTEyTk5KQg=="
        //         },
        //     };
        //     $('body').find("#to_city").prop('disabled', false);
        //     $.ajax(settings).done(function(res) {
        //         $('body').find("#to_city").val('').trigger('change');
        //         $("#to_city").html('<option value=""></option>');
        //         $.each(res, (index, value) => {
        //             $('body').find('#to_city').append(
        //                 `<option value=${value.name}>${value.name}</option>`)
        //         });
        //     });
        // });

        // $('body').on('change', '.from_state', function() {
        //     var state = $('#from_state').find(':selected').val();
        //     $('body').find("#from_city").val('').trigger('change');
        //     $('body').find("#from_city").prop('disabled', true);
        //     var settings = {
        //         "url": `https://api.countrystatecity.in/v1/countries/IN/states/${state}/cities`,
        //         "method": "GET",
        //         "headers": {
        //             "X-CSCAPI-KEY": "TjI0c3NLbVFSUmRUckZhdlY2cmROSjNsSmFQR2RjRkR0YTEyTk5KQg=="
        //         },
        //     };
        //     $('body').find("#from_city").prop('disabled', false);
        //     $.ajax(settings).done(function(res) {
        //         $('body').find("#from_city").val('').trigger('change');
        //         $("#from_city").html('<option value=""></option>');
        //         $.each(res, (index, value) => {
        //             $('body').find('#from_city').append(
        //                 `<option value=${value.name}>${value.name}</option>`)
        //         });
        //     });
        // })

        $('#add_bank_charges').click(function(e) {
            e.preventDefault();
            $('form#add_bank_charges')[0].reset();
            let url = "{{ url('admin/outlet-add-bank-charges') }}";
            $('#heading_bank').html('Add Bank Charges');
            $('#put').html('');
            $('form#add_bank_charges').attr('action', url);
            $('#submit_bank_charges').val('Submit');
            $('#banckModal').modal('show');
        })


        $(document).on('click', '.edit_bank_account', function(e) {
            e.preventDefault();
            var id = $(this).attr('bank_account_id');
            var key = $(this).attr('key');
            var url = "{{ url('admin/outlet-edit-bank-charges') }}/" + id;
            $.ajax({
                url: url,
                method: 'GET',
                dataType: "JSON",
                data: {
                    'key': key
                },
                success: function(res) {
                    $('#api_id').val(res.data.api_id);
                    $('#from_state').val(res.data.from_state);
                    $('#to_state').val(res.data.to_state);
                    // $('#from_city').val(res.data.from_city);
                    // $('#to_city').val(res.data.to_city);
                    $('#min_weight').val(res.data.min_weight);
                    $('#max_weight').val(res.data.max_weight);
                    $('#charges').val(res.data.charges);

                    let urlU = "{{ url('admin/outlet-update-bank-charges') }}";
                    $('#heading_bank').html('Edit Bank Account Charges');
                    $('#put').html('<input type="hidden" name="key" value="' + key + '">');
                    $('form#add_bank_charges').attr('action', urlU);
                    $('#submit_bank_charges').val('Update');
                    $('#banckModal').modal('show');
                },

                error: function(error) {
                    console.log(error)
                }
            });
        });


        /*start form submit functionality*/
        $("form#add_bank_charges").submit(function(e) {
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
                    $('#bank_charges').hide();
                },
                success: function(res) {
                    //hide loader
                    $('.cover-loader-modal').addClass('d-none');
                    $('#bank_charges').show();

                    /*Start Validation Error Message*/
                    $('span.custom-text-danger').html('');
                    $.each(res.validation, (index, msg) => {
                        $(`#${index}_msg`).html(`${msg}`);
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
                        $('form#add_bank_charges')[0].reset();
                        setTimeout(function() {
                            location.reload();
                        }, 2000)

                    }
                }
            });
        });

        /*end form submit functionality*/

        $(document).on('click', '.activeVer', function() {
            var id = $(this).attr('_id');
            var val = $(this).attr('val');
            var key = $(this).attr('key');

            $.ajax({
                'url': "{{ url('admin/outlet-charges-status') }}/" + id + "/" + key + "/" + val,
                data: {},
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.val == 1) {
                        $('#active_' + key).text('Active');
                        $('#active_' + key).attr('val', '0');
                        $('#active_' + key).removeClass('badge-danger');
                        $('#active_' + key).addClass('badge-success');
                    } else {
                        $('#active_' + key).text('Inactive');
                        $('#active_' + key).attr('val', '1');
                        $('#active_' + key).removeClass('badge-success');
                        $('#active_' + key).addClass('badge-danger');
                    }
                    Swal.fire(
                        `${res.status}!`,
                        res.msg,
                        `${res.status}`,
                    )
                }
            });


        });
    </script>
@endpush


@endsection
