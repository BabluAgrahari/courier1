@extends('retailer.layouts.app')
@section('content')
@section('page_heading', 'Spent Amount Topup List')


<div class="row">

    <div class="col-md-6 mt-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Integrate Webhook</h3>
            </div>

            <div class="card-body">
                <div class="col-sm-12">
                    <div class="position-relative p-3 bg-teal disabled color-palette" style="height: 180px">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-fuchsia color-palette">
                                Webhook
                            </div>
                        </div>
                        Webhook URL <br>
                        <small>Integrate Your Webhook Link Here.</small>

                        <div class="form-group mr-4">
                            @if(!empty($webhook))
                            <input type="hidden" id="webhook_id" value="{{ $webhook->_id }}" />
                            @endif
                            <div class="input-group input-group-sm">
                                <input type="text" value="{{ (!empty($webhook->webhook_url))?$webhook->webhook_url:''}}" class="form-control form-control form-control-sm" placeholder="Enter Webhook URL" name="webhool_url" id="webhook_url">
                                <span class="input-group-append ">
                                    <button type="button" class="btn btn-info btn-flat" id="integrate">submit</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 mt-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Api Documents</h3>
            </div>

            <div class="card-body">

                <div id="accordion">

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                    Document of Login Api
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                            <div class="card-body">
                                <div>
                                    <table class="table table-bordered table-sm">
                                        <tr>
                                            <th>URL</th>
                                            <td>{{ url('/api/login')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Method</th>
                                            <td>POST</td>
                                        </tr>
                                        <tr>
                                            <th>Authorization</th>
                                            <td>NO</td>
                                        </tr>

                                        <tr>
                                            <th>Request</th>
                                            <td>{<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"email":"ram@gmail.com",</br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"password":"123456"</br>
                                                }</td>
                                        </tr>
                                        <tr>
                                            <th>Response</th>
                                            <td>{<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"access_token": <span class="">"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.<br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMF
                                                    &nbsp;&nbsp;&nbsp;&nbsp;1NiwiZXhwIjoxNjQ1MjcyMzU2LCJuYmYiOjE2NDUyNj<br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;dUUiLCJzdWIiOiI2MWQwOTc0ZWEzNjAwMDAwOWUwMDUx<br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;cwMWM0MDA4NzJkYjdhNTk3NmY3In0._6Id1G64UoyMy,</span><br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"token_type": "bearer",<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"expires_in": 3600,<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"user": {<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; "name": demo,<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;"email": "demo@gmail.com"<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; }<br>
                                                }</td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="card card-secondary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                    Document of Signle Payout Api
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">

                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>URL</th>
                                        <td>{{ url('/api/payout')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Method</th>
                                        <td>POST</td>
                                    </tr>
                                    <tr>
                                        <th>Authorization</th>
                                        <td>Bearer Token</td>
                                    </tr>

                                    <tr>
                                        <th>Request</th>
                                        <td>{<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"amount":"100",<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"beneficiary_name":"Demo",<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"payment_mode":"bank_account",<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"payment_channel":{<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"bank_name":"SBI Bank",<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"account_number":"9987654322",<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;"ifsc_code":"SBI434"<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                                            }</td>
                                    </tr>
                                    <tr>
                                        <th>Response</th>
                                        <td>{<br>
                                             &nbsp;&nbsp;&nbsp;&nbsp;"status": "success",
                                             &nbsp;&nbsp;&nbsp;&nbsp;"msg": "Transaction Request Created Successfully!"<br>
                                            }</td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                    Document of Bulk Payout Api
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">

                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>URL</th>
                                        <td>{{ url('/api/bulk-payout')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Method</th>
                                        <td>POST</td>
                                    </tr>
                                    <tr>
                                        <th>Authorization</th>
                                        <td>Bearer Token</td>
                                    </tr>

                                    <tr>
                                        <th>Request</th>
                                        <td>[<br>
                                &nbsp;&nbsp; {<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"amount":"100",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"beneficiary_name":"Demo",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"payment_mode":"bank_account",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"payment_channel":{<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"bank_name":"SBI Bank",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"account_number":"9987654322",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"ifsc_code":"SBI434"<br>
                                &nbsp;&nbsp;&nbsp;&nbsp; }<br>
                                },<br>
                                &nbsp;&nbsp; {<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"amount":"100",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"beneficiary_name":"Demo",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"payment_mode":"bank_account",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"payment_channel":{<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"bank_name":"SBI Bank",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"account_number":"9987654322",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;"ifsc_code":"SBI434"<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                                &nbsp;&nbsp;}<br>
                                ]</td>
                                    </tr>
                                    <tr>
                                        <th>Response</th>
                                        <td>{<br>
                                             &nbsp;&nbsp;&nbsp;&nbsp;"status": "success",
                                             &nbsp;&nbsp;&nbsp;&nbsp;"msg": "Transaction Request Created Successfully!"<br>
                                            }</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
<!-- /.row -->

@push('modal')
<script>
    $(document).ready(function() {

        $("#integrate").click(function(e) {
            e.preventDefault();
            var webhook_id = $('#webhook_id').val();
            var webhook = $('#webhook_url').val();
            var url = "<?= url('retailer/webhook-api') ?>";

            $.ajax({
                data: {
                    'webhook_id': webhook_id,
                    'webhook_url': webhook,
                    "_token": "{{ csrf_token() }}"
                },
                type: "POST",
                url: url,
                dataType: 'json',
                beforeSend: function() {
                    $('#integrate').html('Processing...');
                },
                success: function(res) {
                    //hide loader
                    $('#integrate').html('submit');

                    /*Start Status message*/
                    if (res.status == 'success' || res.status == 'error') {
                        Swal.fire(
                            `${res.status}!`,
                            res.msg,
                            `${res.status}`,
                        )
                    }
                    /*End Status message*/
                }
            });
        });

    })
</script>
@endpush

@endsection