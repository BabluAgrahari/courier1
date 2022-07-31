<?php

namespace App\Libraries\Courier;

use App\Models\Order;
use App\Models\Address;

class Xpressbees
{

    function authToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ship.xpressbees.com/api/users/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n    \"email\": \"surendra9835@gmail.com\",\r\n    \"password\": \"Cool@2022\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: fc2b5374-31cf-f0fa-a20f-b94658d812ec"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            return json_decode($response)->data;
        }
    }

    function xpressbees($orderId)
    {

        $order = Order::find($orderId);
        $items = [];
        $discount = 0;
        foreach ($order->productDetails as $val) {
            $item = [
                'name' => $val['product_name'],
                'sku' => $val['sku'],
                'qty' => $val['qty'],
                'price' => $val['unit_price'],
            ];

            $discount += (int)$val['discount'];

            array_push($items, $item);
        }

       // $packageDetail = $order->packageDetail;
        $length = $order->package_length;
        $width = $order->package_breadth;
        $height = $order->package_height;
        $weigth = $order->package_weight;
        $pickup_address = Address::find($order->pickup_address_id);
        $payload = array(
            "order_number" => $order->order_id,
            "order_date" => $order->order_date,
            "consignee" => [
                'name' => $order->buyer_name,
                'address' => $order->ship_address_1,
                'address_2' => $order->ship_address_1,
                'city' => $order->ship_city,
                'pincode' => $order->ship_pincode,
                'state' => $order->ship_state,
                'phone' => $order->phone
            ],
            "pickup" => [
                'warehouse_name' => $order->pickup_address,
                'name' => $pickup_address->name,
                'address' => $pickup_address->address_1,
                "address_2" => $pickup_address->address_2,
                "city" => $pickup_address->city,
                "pincode" =>  $pickup_address->pincode,
                "state" => $pickup_address->state,
                "phone" =>   $pickup_address->phone
            ],
            "order_items" => $items,
            "payment_type" => $order->payment_type,
            "shipping_charges" => (int)$order->shipping_charges,
            "cod_charges" => (int)$order->cod_charges,
            "discount" => (int)$discount,
            "order_amount" => $order->sub_total,
            "package_length" => (int)$length,
            "package_breadth" => (int)$width,
            "package_height" => (int)$height,
            "package_weight" => (int)$weigth,
            "request_auto_pickup" => "yes",
            "courier_id"    => 2,
        );


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ship.xpressbees.com/api/shipments2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->authToken(),
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return  [$response, $httpcode];
        }
    }
}
