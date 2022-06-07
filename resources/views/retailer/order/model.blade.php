<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Access API</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('order.shipment') }}" id="shipForm" method="POST">
                    @csrf()
                    <input type="hidden" name="id" class="ship_id">

                    <div class="form-group">
                        Total Distance Kelometers  <span id="order_km" class="text-bold"></span>
                        Total Charges <span id="total_charges" class="text-bold"> 0</span>
                    </div>
                    @if (in_array(auth()->user()->id, $checkShiprocket))
                        <div class="form-group">
                            <label>
                            <input type="radio" name="api" value="Shiprocket-Order" class="api" required> Shiprocket-Order
                            </label>
                        </div>
                    @endif
                    @if (in_array(auth()->user()->id, $checkXpressbees))
                            <div class="form-group">
                                <label>
                            <input type="radio" name="api" value="Xpressbees" class="api" required> Xpressbees
                                </label>
                            </div>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Done</button>
                </form>
            </div>
        </div>
    </div>
</div>
