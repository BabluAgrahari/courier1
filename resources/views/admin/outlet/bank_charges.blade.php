@extends('admin.layouts.app')

@section('content')
@section('page_heading', 'Bank Charges Link')

<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Bank Charges Link</h3>
        <div class="card-tools">
          <a href="javascript:void(0);" outlet_id='{{ $id }}' class="btn btn-sm btn-success mr-4" id="add_bank_charges"><i class="fas fa-plus-circle"></i>&nbsp;Add</a>
        </div>
      </div>

      <!-- /.card-header -->
      <div class="card-body table-responsive py-4">
        <table id="table" class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Sl No.</th>
              <th>From Amount</th>
              <th>To Amount</th>
              <th>Type</th>
              <th>Charges</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($bank_charges))
            @php
            $i =0;
            @endphp
            @foreach($bank_charges as $key=>$bank)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ (!empty($bank['from_amount']))?$bank['from_amount']:'' }}</td>
              <td>{{ (!empty($bank['from_amount']))?$bank['to_amount']:'' }}</td>
              <td>{{ (!empty($bank['from_amount']))?ucwords($bank['type']):'' }}</td>
              <td>{{ (!empty($bank['from_amount']))?$bank['charges']:'' }}</td>
              <td>
                @if (!empty($bank['status']) && $bank['status'] == 1)

                <a href="javascript:void(0);"><span class="badge badge-success activeVer" key="{{ $key }}" id="active_{{ $key }}" _id="{{ $id }}" val="0">Active</span></a>
                @else
                <a href="javascript:void(0)"><span class="badge badge-danger activeVer" key="{{ $key }}" id="active_{{ $key }}" _id="{{ $id }}" val="1">Inactive</span></a>
                @endif
              </td>
              <td>
                <a href="javascript:void(0);" class="text-info edit_bank_account" bank_account_id="{{ $id }}" key="{{ $key }}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="far fa-edit"></i></a>
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
<div class="modal fade" id="banckModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bank Charges/Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_bank_charges" action="{{ url('admin/outlet-add-bank-charges') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $id }}" name="id" id="outlet_id">
          <div id="put"></div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>From Amount</label>
                  <input type="number" name="from_amount" id="from_amount" required class="form-control form-control-sm" placeholder="Enter Amount">
                  <span id="from_amount_msg" class="custom-text-danger"></span>
                </div>
                <div class="form-group col-md-6">
                  <label>To Amount</label>
                  <input type="number" name="to_amount" id="to_amount" required class="form-control form-control-sm" placeholder="Enter Amount">
                  <span id="to_amount_msg" class="custom-text-danger"></span>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Type</label>
                  <select class="form-control form-control-sm" id="type" name="type">
                    <option value="persantage">Persantage(%)</option>
                    <option value="inr">INR</option>
                  </select>
                  <span id="type_msg" class="custom-text-danger"></span>
                </div>
                <div class="form-group col-md-6">
                  <label>Charges</label>
                  <input type="number" required name="charges" id="charges" class="form-control form-control-sm" placeholder="Enter Charges">
                  <span id="charges_msg" class="custom-text-danger"></span>
                </div>
              </div>

              <div class="form-group text-center">
                <input type="submit" class="btn btn-success btn-sm" id="submit_bank_charges" value="Submit">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#add_bank_charges').click(function(e) {
    e.preventDefault();
    $('form#add_bank_charges')[0].reset();
    let url = '{{ url("admin/outlet-add-bank-charges") }}';
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
        'key':key
      },
      success: function(res) {
        $('#from_amount').val(res.data.from_amount);
        $('#to_amount').val(res.data.to_amount);
        $('#type').val(res.data.type);
        $('#charges').val(res.data.charges);

        let urlU = '{{ url("admin/outlet-update-bank-charges") }}';
        $('#heading_bank').html('Edit Bank Account Charges');
        $('#put').html('<input type="hidden" name="key" value="'+key+'">');
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
        $('.has-loader').addClass('has-loader-active');
      },
      success: function(res) {
        //hide loader
        $('.has-loader').removeClass('has-loader-active');

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
          $('form#add-outlet')[0].reset();
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
            })
        });

</script>

@endpush


@endsection