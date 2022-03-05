@push('modal')
<?php
$bank_names = [
    'Bank of Baroda', 'Bank of India', 'Bank of Maharashtra', 'Canara Bank', 'Central Bank of India',
    'Indian Bank', 'Indian Overseas Bank', 'Punjab & Sind Bank', 'Punjab National Bank', 'State Bank of India', 'UCO Bank',
    'Union Bank of India', 'Axis Bank Ltd', 'Bandhan Bank Ltd', 'CSB Bank Ltd', 'City Union Bank Ltd', 'DCB Bank Ltd', 'Dhanlaxmi Bank Ltd',
    'Federal Bank Ltd', 'HDFC Bank Ltd', 'ICICI Bank Ltd', 'Induslnd Bank Ltd', 'IDFC First Bank Ltd', 'Jammu & Kashmir Bank Ltd',
    'Karnataka Bank Ltd', 'Karur Vysya Bank Ltd', 'Kotak Mahindra Bank Ltd', 'Lakshmi Vilas Bank Ltd', 'Nainital Bank Ltd', 'RBL Bank Ltd',
    'South Indian Bank Ltd', 'Tamilnad Mercantile Bank Ltd', 'YES Bank Ltd', 'IDBI Bank Ltd', 'Au Small Finance Bank Limited', 'Capital Small Finance Bank Limited',
    'Equitas Small Finance Bank Limited', 'Suryoday Small Finance Bank Limited', 'Ujjivan Small Finance Bank Limited', 'Utkarsh Small Finance Bank Limited',
    'ESAF Small Finance Bank Limited', 'Fincare Small Finance Bank Limited', 'Jana Small Finance Bank Limited', 'North East Small Finance Bank Limited', 'Shivalik Small Finance Bank Limited',
    'India Post Payments Bank Limited', 'Fino Payments Bank Limited', 'Paytm Payments Bank Limited', 'Airtel Payments Bank Limited'
];
?>
<style>
    .modal-lg-custom {
        width: 1350px !important;
        margin: 1.7rem auto !important;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="preview-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Import Csv File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- for loader -->
            <div class="cover-loader-modal d-none">
                <div class="loader-modal"></div>
            </div>

            <div class="modal-body pl-2 pr-2">
                <div id="import-file">
                    <p>Download sample Payout Transaction Import(CSV) file : <a href="{{ url('retailer/sample-csv') }}" class="text-green">Download</a></p>
                    <form id="import" action="{{ url('retailer/payout-import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input custom-file-input-sm" id="imgInp" accept=".csv">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                <span id="file_msg" class="custom-text-danger"></span>
                            </div>

                            <div class="form-group col-md-2">
                                <input type="submit" class="btn btn-success btn-sm" id="submit_bank_charges" value="Import">
                            </div>

                        </div>
                    </form>
                </div>

                <div class="d-none" id="show-pin">
                    <div id="preview-import-data">
                    </div>
                    <div class="col-md-3 ml-auto mr-auto">
                        <div class="card p-2">
                            <div class="form-group mb-3">
                                <label class="text-center">Enter PIN</label>
                                <div class="cover-otp d-flex ">
                                    <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f1p">
                                    <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f2p">
                                    <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f3p">
                                    <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f4p">
                                </div>
                                <span id="otp_verify" class="text-success"></span>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" id="verify-import" class="btn btn-success btn-sm"><i class="fas fa-compress-arrows-alt"></i>&nbsp;Verify & Import</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#import').click(function(e) {
        e.preventDefault();
        $('form#import')[0].reset();
        let url = '{{ url("retailer/payout-import") }}';
        $('form#import').attr('action', url);
        $('#importModal').modal('show');
    })

    $('#verify-import').click(function(e) {
        e.preventDefault();

        var exit_pin = '{{ Auth::user()->pin }}';

        var pin1 = $('#f1p').val().trim();
        var pin2 = $('#f2p').val().trim();
        var pin3 = $('#f3p').val().trim();
        var pin4 = $('#f4p').val().trim();
        var pin = pin1 + pin2 + pin3 + pin4;
        console.log(`${pin}+${exit_pin}`);
        if (parseInt(pin) != parseInt(exit_pin)) {
            Swal.fire(
                `Error!`,
                'Pin is not Verified!',
                `error`,
            )
        } else {
            importSequence(0);
        }
    })

    function importSequence(index) {
        var url1 = '{{ url("retailer/import-sequence")}}';
        $.ajax({
            data: {
                'index': index
            },
            type: "GET",
            url: url1,
            dataType: 'json',
            success: function(res) {

                /*Start Status message*/
                if (res.status == 'success' || res.status == 'error') {
                    Swal.fire(
                        `${res.status}!`,
                        res.msg,
                        `${res.status}`,
                    )
                }
                /*End Status message*/
                if (index == 0)
                    $('.preview-table').remove();

                $('#preview-table').append(res.data);

                if(index+1 != res.all_row){
                importSequence(res.index);
                }else{
                   $('#verify-import').attr('disabled',true);
                }
                //for reset all fields
                // if (res.status == 'success') {
                //     setTimeout(function() {
                //         location.reload();
                //     }, 1000);
                // }
            }
        });
    }

//     $('#importModal').on('hidden', function () {
//   document.location.reload();
// })
$('#importModal').on('hidden.bs.modal', function () {
    location.reload();
});

</script>

<!-- Modal -->
<div class="modal fade" id="payout_trans_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="heading_bank">Customer Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="cover-loader-modal d-none">
                <div class="loader-modal"></div>
            </div>

            <div class="modal-body">
                <form id="payout_trans" action="{{ url('retailer/dmt-trans') }}" method="post">
                    @csrf
                    <div id="put"></div>
                    <div class="row">
                        <div class="col-md-12 p-dmt-form">
                            <div id="p-preview-input"><input type="hidden" id="p-preview-filed" value="preview" name="preview"></div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" placeholder="Enter Amount" id="payout_amount" required name="amount" class="form-control form-control-sm">
                                <span id="payout_amount_msg" class="custom-text-danger"></span>
                            </div>

                            <div id="payout_charges"></div>
                            <div id="payput_upload_docs"></div>

                            <div class="form-group">
                                <label>Beneficiary Name</label>
                                <input type="text" placeholder="Enter Beneficiary Name" id="receiver" required name="receiver_name" class="form-control form-control-sm">
                                <span id="receiver_msg" class="custom-text-danger"></span>
                            </div>

                            <!-- <div class="form-group">
                                <label>Select Payment Channel</label>
                                <select name="payment_mode" class="form-control form-control-sm" id="payout_payment_channel">
                                    <option value="">Select</option>
                                    <option value="bank_account">Bank Account</option>
                                  <option value="upi">UPI</option> -->
                            <!--  </select>
                            <span id="receiver_msg" class="custom-text-danger"></span>
                        </div> -->

                            <div class="form-group">
                                <label>Bank Name</label>
                                <select name="payment_channel[bank_name]" class="form-control form-control-sm" required>
                                    <option value=''>Select Bank Name</option>
                                    <?php foreach ($bank_names as $name) {
                                        echo '<option value="' . $name . '">' . $name . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="number" name="payment_channel[account_number]" class="form-control form-control-sm" placeholder="Enter Account Number">
                            </div>
                            <div class="form-group">
                                <label>IFSC Code</label>
                                <input type="text" name="payment_channel[ifsc_code]" class="form-control form-control-sm" placeholder="Enter IFSC Code">
                            </div>

                            <div id="payput_payment_channel">

                            </div>
                        </div>

                        <div class="com-md-12 bordered-1 d-none" id="p-preview">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm">

                                        <tr>
                                            <td>Amount</td>
                                            <td id="p-amount1"></td>
                                        </tr>
                                        <tr>
                                            <td>Fess</td>
                                            <td id="p-fees"></td>
                                        </tr>
                                        <tr>
                                            <td>Receiver Name</td>
                                            <td id="p-receiver_name"></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td id="p-bank_name"></td>
                                        </tr>
                                        <tr>
                                            <td>Account Number</td>
                                            <td id="p-account_number"></td>
                                        </tr>
                                        <tr>
                                            <td>IFSC Code</td>
                                            <td id="p-ifsc_code"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="card p-4 pl-5 pr-5">
                                        <div class="form-group mb-3">
                                            <label class="text-center">Enter PIN</label>
                                            <div class="cover-otp d-flex ">
                                                <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f1p">
                                                <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f2p">
                                                <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f3p">
                                                <input type="number" name="pin[]" type=" number" maxlength="1" class="otp form-control rounded-0 border-top-0 border-right-0 border-left-0 m-2" placeholder="0" id="f4p">
                                            </div>
                                            <span id="otp_verify" class="text-success"></span>
                                        </div>
                                        <div class="form-group text-center">
                                            <!-- <input type="submit" class="btn btn-success btn-sm" value="Verify"> -->
                                            <a href="javascript:void(0);" class="btn btn-sm btn-warning" id="p-back"><i class="far fa-arrow-alt-circle-left"></i>&nbsp;Back</a>
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-compress-arrows-alt"></i>&nbsp;Verify & Send</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group text-center" id="p-submit-btn">
                                <input type="submit" class="btn btn-success btn-sm" id="submit_payout" value="Submit">
                                <!-- <input type="submit" class="btn btn-info btn-sm" value="Send"> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#payout_payment_channel').change(function() {
        var payment_channel = $(this).val();
        if (payment_channel == 'bank_account') {
            $('#payput_payment_channel').html(`<div class="form-group">
            <label>Bank Name</label>
            <select name="payment_channel[bank_name]" class="form-control form-control-sm" required>
            <option value=''>Select Bank Name</option>
            <?php foreach ($bank_names as $name) {
                echo '<option value=' . $name . '>' . $name . '</option>';
            } ?>
            </select>
            </div>
            <div class="form-group">
            <label>Account Number</label>
            <input type="number" name="payment_channel[account_number]" class="form-control form-control-sm" placeholder="Enter Account Number">
            </div>
            <div class="form-group">
            <label>IFSC Code</label>
            <input type="text" name="payment_channel[ifsc_code]" class="form-control form-control-sm" placeholder="Enter IFSC Code">
            </div>`);
        } else if (payment_channel == 'upi') {
            $('#payput_payment_channel').html(`<div class="form-group">
            <label>UPI Id</label>
            <input type="text" name="payment_channel[upi_id]" class="form-control form-control-sm" placeholder="Enter UPI ID">
            </div>`);
        } else {
            $('#payput_payment_channel').html(``);
        }
    })


    $('#payout_amount').keyup(function(e) {
        e.preventDefault();

        var amount = $(this).val();
        payout_transction(amount);

        if (amount >= 25000 && amount < 200000) {
            // $('#payput_upload_docs').html(`<div class="form-group">
            // <label>Pancard Number</label>
            // <input type="text" name="pancard_no" class=" form-control form-control-sm" placeholder="Enter Pancard Number" required>
            // </div>
            // <div class="form-group">
            // <label>Uploade Pancard</label>
            // <div class="input-group">
            // <div class="custom-file">
            // <input type="file" name="pancard" class=" custom-file-input custom-file-input-sm" id="attachment" required>
            // <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            // </div>
            // </div>
            // <span id="attachment_msg" class="custom-text-danger"></span>
            // </div>`);
        } else if (amount > 200000) {
            $('#payout_trans input,select').attr('disabled', 'disabled');
            $('#payout_amount_msg').html('Alowed only 2 lakh Per Month.');
            $('#payout_amount').removeAttr('disabled');
        } else {
            $('#payput_upload_docs').html(``);
            $('#payout_amount_msg').html(``);
            $('#payout_trans input,select').removeAttr('disabled');
        }
    })


    //for check retailer fee detials
    function payout_transction(amount) {

        var amount = (amount) ? amount : 0;
        $.ajax({
            url: "<?= url('retailer/fee-details') ?>",
            data: {
                'amount': amount
            },
            dataType: "JSON",
            type: "GET",
            success: function(res) {

                if (res.status == 'success') {

                    $('#payout_charges').html(`Rs. ${res.charges} Transaction Fees
                        <div class="form-group">
                        <label>Transaction Amount</label>
                        <input type="text" readonly name="" value="${parseInt(amount)+ parseInt(res.charges)}" class="form-control form-control-sm">
                        </div>`);

                } else if (res.status == 'error') {
                    $('#payout_charges').html(res.msg);
                }
            }
        })
    }


    $('#create_payout').click(function(e) {
        e.preventDefault();
        $('form#payout_trans')[0].reset();
        let url = '{{ url("retailer/payout-trans") }}';
        $('#heading_bank').html('Transaction Details');
        $('#put').html('');
        $('form#payout_trans').attr('action', url);
        $('#submit_payout').val('Preview');
        // openPinPopupp();
        $('#payout_trans_modal').modal('show');
    })


    //back to dmt form
    $('#p-back').click(function(e) {
        e.preventDefault();
        $('.p-dmt-form').removeClass('d-none');
        $('#p-preview').addClass('d-none');
        $('#p-submit-btn').removeClass('d-none');
        $('#p-preview-input').html('<input type="hidden" id="p-preview-filed" value="preview" name="preview">');
    })

    /*start form submit functionality*/
    $("form#payout_trans").submit(function(e) {
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
                //hide loader
                $('.cover-loader-modal').addClass('d-none');
                $('.modal-body').show();

                /*Start Validation Error Message*/
                $('span.custom-text-danger').html('');
                $.each(res.validation, (index, msg) => {
                    $(`#${index}_msg`).html(`${msg}`);
                })
                /*Start Validation Error Message*/


                //for preview page
                console.log(res);
                if (res.status === 'preview') {
                    $('.p-dmt-form').addClass('d-none');
                    $('#p-preview').removeClass('d-none');
                    $('#p-submit-btn').addClass('d-none');
                    $('#p-preview-filed').remove();
                    $('#p-amount1').html(res.response.amount);
                    $('#p-fees').html(res.response.fees);
                    $('#p-bank_name').html(res.response.payment_channel.bank_name);
                    $('#p-account_number').html(res.response.payment_channel.account_number);
                    $('#p-ifsc_code').html(res.response.payment_channel.ifsc_code);
                    $('#p-receiver_name').html(res.response.receiver_name);
                }


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
                    $('form#payout_trans')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            }
        });
    });

    /*end form submit functionality*/


    /*start import functionality*/
    $("form#import").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var url = $(this).attr('action');

        $.ajax({
            data: formData,
            type: "post",
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
                //hide loader
                $('.cover-loader-modal').addClass('d-none');
                $('.modal-body').show();
                /*Start Validation Error Message*/
                if (res.file) {
                    $('#fileMsg').html(res.file);
                } else {
                    $('#fileMsg').html('');
                }
                /*Start Validation Error Message*/

                if (res.status == 'preview') {
                    $('#import-file').addClass('d-none');
                    $('#preview-modal').addClass('modal-lg-custom');
                    $('#preview-modal').removeClass('modal-dialog modal-dialog-centered');
                    $('#show-pin').removeClass('d-none');
                    $('#preview-import-data').html(res.data);
                }
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
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            }
        });
    });
    /*end import functionality*/
</script>

<script>
    /*start focus pointer to new field (functionality)*/
    $('#f1p').keyup(function() {
        if ($('#f1p').val().length == 1) {
            $('#f2p').focus();
        }
    });
    $('#f2p').keyup(function() {
        if ($('#f2p').val().length == 1) {
            $('#f3p').focus();
        }
    });
    $('#f3p').keyup(function() {
        if ($('#f3p').val().length == 1) {
            $('#f4p').focus();
        }
    });
    $('#f4p').keyup(function() {
        if ($('#f4p').val().length == 1) {
            $('#verifyin').focus();
        }
    });
    /*end focus pointer to new field (functionality)*/
</script>
@endpush