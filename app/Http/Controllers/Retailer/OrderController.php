<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Http\Validation\OrderValidation;
use App\Models\Address;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public $moduleName = 'Order';
    public $view = 'retailer/order';
    public $route = 'retailer/order';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moduleName = $this->moduleName;
        $addresses = Address::get();
        $orders = Order::all();
        return view($this->view . '/index', compact('moduleName', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $moduleName = $this->moduleName;
        $addresses = Address::get();
        return view($this->view . '/form', compact('moduleName', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderValidation $request)
    {
        //Order::first();
        // dd($request->all());

        try {
            $order = new Order();

            $order->buyer_name = $request->buyer_name;
            $order->phone = $request->phone;
            $order->phone_alt = $request->phone_alt;
            $order->email = $request->email;
            $order->bill_address_1 = $request->bill_address_1;
            $order->bill_address_2 = $request->bill_address_2;
            $order->bill_pincode = $request->bill_pincode;
            $order->bill_city = $request->bill_city;
            $order->bill_country = $request->bill_country;
            $order->bill_state = $request->bill_state;

            if ($request->has('address_both_same')) {
                $order->address_both_same = 1;
                $order->ship_address_1 = $request->bill_address_1;
                $order->ship_address_2 = $request->bill_address_2;
                $order->ship_pincode = $request->bill_pincode;
                $order->ship_city = $request->bill_city;
                $order->ship_country = $request->bill_country;
                $order->ship_state = $request->bill_state;
            } else {
                $order->address_both_same = 0;
                $order->ship_address_1 = $request->ship_address_1;
                $order->ship_address_2 = $request->ship_address_2;
                $order->ship_pincode = $request->ship_pincode;
                $order->ship_city = $request->ship_city;
                $order->ship_country = $request->ship_country;
                $order->ship_state = $request->ship_state;
            }

            if ($request->has('hyperlocal_shipment')) {
                $order->hyperlocal_shipment = 1;
                $order->location = $request->location;
            } else {
                $order->hyperlocal_shipment = 0;
                $order->location = null;
            }

            $order->order_id = $request->order_id;
            $order->order_date = $request->order_date;
            $order->order_channel = $request->order_channel;
            $order->order_type = $request->order_type;
            $order->order_tag = $request->order_tag;

            $products = [];
            foreach ($request->product_name as $key => $val) {
                $product = [
                    'product_name' => $request->product_name[$key],
                    'sku' => $request->sku[$key],
                    'qty' => $request->qty[$key],
                    'unit_price' => $request->unit_price[$key],
                    'tax_rate' => $request->tax_rate[$key],
                    'hsn' => $request->hsn[$key],
                    'discount' => $request->discount[$key],
                    'category' => $request->category[$key],
                    'amount'  => $request->amount[$key]
                ];

                array_push($products, $product);
            }

            $order->payment_type = $request->payment_type;
            $order->sub_total = $request->sub_total;
            $order->pickup_address = $request->pickup_address;
            $order->pickup_address_id = $request->pickup_address_id;

            $packageDetail = [];
            foreach ($request->weight as $key => $val) {
                $package = [
                    'weight' => $request->weight[$key],
                    'length' => $request->length[$key],
                    'width' => $request->width[$key],
                    'height' => $request->height[$key],
                ];

                array_push($packageDetail, $package);
            }
            $order->productDetails = $products;
            $order->packageDetail = $packageDetail;
            $order->save();
            return response(['status' => 'success', 'msg' => 'Order Created Successfully!']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'msg' => 'Order Not Created!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addresses = Address::get();
        $order = Order::find($id);
        $moduleName = $this->moduleName;
        return view($this->view . '/_form', compact('moduleName', 'order', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $order = Order::find($id);

            $order->buyer_name = $request->buyer_name;
            $order->phone = $request->phone;
            $order->phone_alt = $request->phone_alt;
            $order->email = $request->email;
            $order->bill_address_1 = $request->bill_address_1;
            $order->bill_address_2 = $request->bill_address_2;
            $order->bill_pincode = $request->bill_pincode;
            $order->bill_city = $request->bill_city;
            $order->bill_country = $request->bill_country;
            $order->bill_state = $request->bill_state;

            if ($request->has('address_both_same')) {
                $order->address_both_same = 1;
                $order->ship_address_1 = $request->bill_address_1;
                $order->ship_address_2 = $request->bill_address_2;
                $order->ship_pincode = $request->bill_pincode;
                $order->ship_city = $request->bill_city;
                $order->ship_country = $request->bill_country;
                $order->ship_state = $request->bill_state;
            } else {
                $order->address_both_same = 0;
                $order->ship_address_1 = $request->ship_address_1;
                $order->ship_address_2 = $request->ship_address_2;
                $order->ship_pincode = $request->ship_pincode;
                $order->ship_city = $request->ship_city;
                $order->ship_country = $request->ship_country;
                $order->ship_state = $request->ship_state;
            }

            if ($request->has('hyperlocal_shipment')) {
                $order->hyperlocal_shipment = 1;
                $order->location = $request->location;
            } else {
                $order->hyperlocal_shipment = 0;
                $order->location = null;
            }

            $order->order_id = $request->order_id;
            $order->order_date = $request->order_date;
            $order->order_channel = $request->order_channel;
            $order->order_type = $request->order_type;
            $order->order_tag = $request->order_tag;

            $products = [];
            foreach ($request->product_name as $key => $val) {
                $product = [
                    'product_name' => $request->product_name[$key],
                    'sku' => $request->sku[$key],
                    'qty' => $request->qty[$key],
                    'unit_price' => $request->unit_price[$key],
                    'tax_rate' => $request->tax_rate[$key],
                    'hsn' => $request->hsn[$key],
                    'discount' => $request->discount[$key],
                    'category' => $request->category[$key],
                    'amount'  => $request->amount[$key]
                ];

                array_push($products, $product);
            }

            $order->payment_type = $request->payment_type;
            $order->sub_total = $request->sub_total;
            $order->pickup_address = $request->pickup_address;
            $order->pickup_address_id = $request->pickup_address_id;

            $packageDetail = [];
            foreach ($request->weight as $key => $val) {
                $package = [
                    'weight' => $request->weight[$key],
                    'length' => $request->length[$key],
                    'width' => $request->width[$key],
                    'height' => $request->height[$key],
                ];

                array_push($packageDetail, $package);
            }
            $order->productDetails = $products;
            $order->packageDetail = $packageDetail;
            $order->save();
            return redirect($this->route)->with('message', 'Order Updated Successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function shipment(Request $request)
    {
        $res = '';
        if($request->api == 'shiprocket') {
            $res = shiprocket($request->id);
        }

        return back()->with('message',$res);
    }
}
