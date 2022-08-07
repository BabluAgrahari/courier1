<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderShipment;
use App\Http\Validation\ShipmentValidation;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;


class ShipmentController extends Controller
{

    public $moduleName = 'Shipments';
    public $view = 'retailer/shipments';
    public $route = 'retailer/shipments';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $moduleName = $this->moduleName;
        $shipments = OrderShipment::all();

        return view($this->view . '/index', compact('moduleName', 'shipments'));
    }

    public function store(Request $request)
    {

        try {

            $order = Order::find($request->orderId);
            
            $shipment = new OrderShipment();

            $shipment->ship_status  = 'new';
            $shipment->order_id     = $order->_id;
            $shipment->user_id      = Auth::user()->_id;
            $shipment->payment_type = $order->payment_type;
            if ($shipment->save()){
                $order->order_status = 'processing';
                $order->save();
            }
            return response(['status' => 'success', 'msg' => 'Shipment Created Successfully!']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'msg' => 'Shipment Not Created!']);
        }
    }
}
