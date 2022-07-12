<div class="modal fade" id="banckModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bank Charges/Commission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="cover-loader-modal d-none">
                    <div class="loader-modal"></div>
                </div>

                <div class="modal-body" id="bank_charges">

                    <form id="add_bank_charges" action="{{ url('admin/outlet-add-bank-charges') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $id }}" name="id" id="outlet_id">
                        <div id="put"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select name="api_id" id="api_id" class="form-control form-control-sm" required>
                                            <option value="">Select API</option>
                                            @foreach ($apis as $api)
                                                <option value="{{ $api->id }}">{{ $api->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>From State</label>
                                        <select class="select2 from_state" id="from_state" required name="from_state" style="width: 100%">
                                            <option value=""></option>
                                            @foreach ($states as $key => $val)
                                                <option value="{{ $val->iso2 }}">{{ $val->name}}</option>
                                            @endforeach
                                        </select>

                                        <span id="from_state_msg" class="custom-text-danger"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>To State</label>
                                        <select class="select2 to_state" id="to_state" required name="to_state" style="width: 100%">
                                            <option value=""></option>
                                            @foreach ($states as $key => $val)
                                                <option value="{{ $val->iso2 }}">{{ $val->name}}</option>
                                            @endforeach
                                        </select>

                                        <span id="to_state_msg" class="custom-text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="from_city">From City</label>
                                        <select class="select2" id="from_city" required name="from_city" style="width: 100%">
                                        </select>

                                        <span id="from_city_msg" class="custom-text-danger"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="to_city">To City</label>
                                        <select class="select2" id="to_city" required name="to_city" style="width: 100%">

                                        </select>

                                        <span id="to_city_msg" class="custom-text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Charges</label>
                                        <input type="number" step="any" required name="charges" id="charges"
                                            class="form-control form-control-sm" placeholder="Enter Charges">
                                        <span id="charges_msg" class="custom-text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-success btn-sm" id="submit_bank_charges"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
