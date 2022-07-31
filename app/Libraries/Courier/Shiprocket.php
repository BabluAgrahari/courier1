<?php

namespace App\Libraries\Courier;

use App\Models\Order;
use App\Models\Address;

class Shiprocket
{
    function authToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n    \"email\": \"websiteduniya2019@gmail.com\",\r\n    \"password\": \"Trick@123\"\r\n}",
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
            return json_decode($response)->token;
        }
    }

    function shiprocket($orderId)
    {

        $order = Order::find($orderId);
        $items = [];
        foreach ($order->productDetails as $val) {
            $item = [
                'name' => $val['product_name'],
                'sku' => $val['sku'],
                'units' => '1',
                'selling_price' => $val['unit_price'],
                'discount' => $val['discount'],
                'tax' => $val['tax_rate'],
                "hsn" => $val['hsn']
            ];

            array_push($items, $item);
        }

        $packageDetail = $order->packageDetail;
        $length = $packageDetail[0]['length'];
        $width = $packageDetail[0]['width'];
        $height = $packageDetail[0]['height'];
        $weigth = $packageDetail[0]['weight'];
        $pickup_address = Address::find($order->pickup_address_id)->pickup_location;
        $bill_ship = ($order->address_both_same == 1) ? true : 0;
        $payload = '{
        "order_id": "' . $order->id . '",
        "order_date": "' . $order->order_date . '",
        "pickup_location": "' . $pickup_address . '",
        "comment": "Order",
        "billing_customer_name": "' . $order->buyer_name . '",
        "billing_last_name": "Uzumaki",
        "billing_address": "' . $order->bill_address_1 . '",
        "billing_address_2": "' . $order->bill_address_1 . '",
        "billing_city": "' . $order->bill_city . '",
        "billing_pincode": "' . $order->bill_pincode . '",
        "billing_state": "' . $order->bill_state . '",
        "billing_country": "' . $order->bill_country . '",
        "billing_email": "billemail@gmail.com",
        "billing_phone": "' . $order->phone . '",
        "shipping_is_billing": "' . $bill_ship . '",
        "shipping_customer_name": "' . $order->buyer_name . '",
        "shipping_last_name": "",
        "shipping_address": "' . $order->ship_address_1 . '",
        "shipping_address_2": "' . $order->ship_address_1 . '",
        "shipping_city": "' . $order->ship_city . '",
        "shipping_pincode": "' . $order->ship_pincode . '",
        "shipping_country": "' . $order->ship_country . '",
        "shipping_state": "' . $order->ship_state . '",
        "shipping_email": "ship@gmail.com",
        "shipping_phone": "' . $order->phone . '",
        "order_items": ' . json_encode($items) . ',
        "payment_method": "Prepaid",
        "shipping_charges": 0,
        "giftwrap_charges": 0,
        "transaction_charges": 0,
        "total_discount": 0,
        "sub_total": 9000,
        "length": "' . ($length) . '",
        "breadth": "' . ($width) . '",
        "height": "' . $height . '",
        "weight": "' . $weigth . '"
      }';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "$payload",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $this->authToken(),
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 3f6d69a0-03ad-ba67-7db2-a1e3999c5f25"
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
