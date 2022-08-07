<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Address;
use Exception;
use App\Models\OrderShipment;
use App\Libraries\Courier\Xpressbees;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public $moduleName = 'Orders';
    public $view = 'admin/orders';
    public $route = 'admin/orders';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $moduleName = $this->moduleName;
        $orders = Order::all();

        return view($this->view . '/index', compact('moduleName', 'orders'));
    }

    public function bulkAction(Request $request)
    {
        if (empty($request->order_id))
            return response(['status' => 'error', 'msg' => 'Please select any order Id!']);
        try {
            $api = $request->api;
            $res = '';
            if ($api == 'Xpressbees') {
                foreach (explode(',', $request->order_id) as $orderId) {
                    $data = new Xpressbees();  /// lib to push data 
                    $res =  $data->Xpressbees($orderId);

                    if ($res[1] === 200) {
                        $res = $res[0];
                        $response1 = json_decode($res);

                        $shipment = OrderShipment::where('order_id', $orderId)->first();
                        if (empty($shipment)) {
                            $shipment = new OrderShipment();
                            $shipment->ship_status      = strtolower($response1->data->status);
                            $shipment->order_id         = $orderId;
                            $shipment->awb_number       = $response1->data->awb_number;
                            $shipment->courier_name     = $response1->data->courier_name;
                            $shipment->label            = $response1->data->label;
                            $shipment->manifest         = $response1->data->manifest;
                            $shipment->additional_info  = $response1->data->additional_info;
                            $shipment->save();
                        } else {
                            $shipment->ship_status      = strtolower($response1->data->status);
                            $shipment->awb_number       = $response1->data->awb_number;
                            $shipment->courier_name     = $response1->data->courier_name;
                            $shipment->label            = $response1->data->label;
                            $shipment->manifest         = $response1->data->manifest;
                            $shipment->additional_info  = $response1->data->additional_info;
                            $shipment->save(); 
                        }
                        Order::find($orderId)->update(['order_status' => strtolower($response1->data->status)]);
                        // return back()->with('message', $res);
                    } else {
                        $res = $res[0];
                        $response1 = json_decode($res);
                    }
                }
                return response(['status' => 'error', 'msg' => $response1->message]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
