<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Http\Validation\OrderValidation;
use App\Models\Address;
use App\Models\ApiList;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\User;
use App\Libraries\Courier\Shiprocket;
use App\Libraries\Courier\Xpressbees;
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


        //$api = ApiList::where('name','Ship Rocket')->first();
        //$charges = getSlabRate('Ahmedabad','Rajkot',$api->id);

        // $slab = Outlet::where('api_id', $api->id)->first()->bank_charges;
        // foreach($slab as $key => $val) {
        //     if("13" >= $val['from_amount'] &&  "13" <= $val['to_amount']) {
        //         return $val['charges'];
        //     }
        // }


        $checkShiprocket = ApiList::first();
        //return User::first();
        $moduleName = $this->moduleName;
        $addresses = Address::get();
        $orders = Order::all();


        $checkShiprocket = ApiList::where('name', 'Ship Rocket')->pluck('retailer_ids')->toArray();
        $checkShiprocket = !empty($checkShiprocket) ? $checkShiprocket[0] : [];

        $checkXpressbees = ApiList::where('name', 'Xpressbees')->pluck('retailer_ids')->toArray();
        $checkXpressbees = !empty($checkXpressbees) ? $checkXpressbees[0] : [];

        return view($this->view . '/index', compact('moduleName', 'orders', 'checkShiprocket', 'checkXpressbees'));
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
      //  dd($request->all());

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

            $order->country = $request->country;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->package_weight            = (!empty($request->package_weight)) && floor($request->package_weight*1000) / 500 >= 1 ? $request->package_weight*1000 : 500;
            $order->package_length            = $request->package_length;
            $order->package_height            = $request->package_height;
            $order->package_breadth           = $request->package_breadth;
            $order->package_volumatic_weight  =  trim($request->package_volumatic_weight*1000);
            // $packageDetail = [];
            // foreach ($request->weight as $key => $val) {
            //     $package = [
            //         'weight' => $request->weight[$key],
            //         'length' => $request->length[$key],
            //         'width' => $request->width[$key],
            //         'height' => $request->height[$key],
            //     ];

            //     array_push($packageDetail, $package);
            // }
            $order->productDetails = $products;
          //  $order->packageDetail = $packageDetail;
            $order->ship_response = "";
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
        //https://www.codexworld.com/distance-between-two-addresses-google-maps-api-php/
        //https://www.myprogrammingtutorials.com/find-distance-between-two-addresses-google-api-php.html
        //$distance = getDistance($addressFrom, $addressTo);
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

            $order->country = $request->country;
            $order->state = $request->state;
            $order->city = $request->city;

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

            $order->payment_type              = $request->payment_type;
            $order->sub_total                 = $request->sub_total;
            $order->pickup_address            = $request->pickup_address;
            $order->pickup_address_id         = $request->pickup_address_id;
            $order->package_weight            = (!empty($request->package_weight)) && floor($request->package_weight*1000) / 500 >= 1 ? $request->package_weight*1000 : 500;
            $order->package_length            = $request->package_length;
            $order->package_height            = $request->package_height;
            $order->package_breadth           = $request->package_breadth;
            $order->package_volumatic_weight  =  trim($request->package_volumatic_weight*1000);
            // $packageDetail = [];
            // foreach ($request->weight as $key => $val) {
            //     $package = [
            //         'weight' => $request->weight[$key],
            //         'length' => $request->length[$key],
            //         'width' => $request->width[$key],
            //         'height' => $request->height[$key],
            //     ];

            //     array_push($packageDetail, $package);
            // }
            $order->productDetails = $products;
           // $order->packageDetail = $packageDetail;
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
        $request->validate([
            'api' => 'required'
        ]);

        try {
            $res = '';
            if ($request->api == 'Shiprocket-Order') {
                //  $res = shiprocket($request->id);
                $data = new Shiprocket();  /// lib to push data 
                $res =  $data->Shiprocket($request->id);

                if ($res[1] === 200) {
                    $res = $res[0];
                    Order::find($request->id)->update(['ship_response' => $res]);
                    return back()->with('message', $res);
                } else {
                    $res = $res[0];
                    return back()->with('error', $res);
                }
            } else if ($request->api == 'Xpressbees') {

                // $res = shiprocket($request->id);
                $data = new Xpressbees();  /// lib to push data 
                $res =  $data->Xpressbees($request->id);
                if ($res[1] === 200) {
                    $res = $res[0];
                    Order::find($request->id)->update(['ship_response' => $res]);
                    return back()->with('message', $res);
                } else {
                    $res = $res[0];
                    return back()->with('error', $res);
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDistance($id)
    {

        $order = Order::find($id);
        $fromCity = $order->city;
        $toCity = Address::find($order->pickup_address_id)->city;

        $charges = getSlabRate($fromCity, $toCity, 1);
    }

    public function getCharges(Request $request)
    {


        $apiId = ApiList::where('name', $request->apiId)->first()->id;
        $order = Order::find($request->orderId);
        $fromState = $order->ship_state;
        $weight = $order->package_weight;
        $vol_weight = $order->package_volumatic_weight;
        $toState = Address::find($order->pickup_address_id)->state;
        $charges = getSlabRate($fromState, $toState, $apiId,$weight,$vol_weight);
        return json_encode($charges);
    }
}
