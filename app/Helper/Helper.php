<?php

use App\Models\Address;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\TransferHistory;
use App\Models\User;
use App\Models\Webhook;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;

if (!function_exists('uniqCode')) {
    function uniqCode($lenght)
    {
        // uniqCode
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return strtoupper(substr(bin2hex($bytes), 0, $lenght));
    }
}

if (!function_exists('singleFile')) {

    function singleFile($file, $folder)
    {
        if ($file) {
            if (!file_exists($folder))
                mkdir($folder, 0777, true);

            $destinationPath = public_path() . '/' . $folder;
            $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage);
            $fileName = "$profileImage";
            return $fileName;
        }
        return false;
    }
}


if (!function_exists('pr')) {
    function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo '</pre>';
        die;
    }
}


if (!function_exists('profileImage')) {

    function profileImage()
    {
        $outlet_id = Auth::user()->outlet_id;
        $outlet = Outlet::select('profile_image')->find($outlet_id);
        return (!empty($outlet->profile_image)) ? asset('attachment') . '/' . $outlet->profile_image : asset('assets/profile/37.jpg');
    }
}


if (!function_exists('employeeImage')) {

    function employeeImage()
    {
        $user_id = Auth::user()->_id;
        $user = User::select('employee_img')->find($user_id);
        return (!empty($user->employee_img)) ? asset('attachment') . '/' . $user->employee_img : asset('assets/profile/37.jpg');
    }
}

if (!function_exists('transferHistory')) {
    function transferHistory($retailer_id, $amount, $receiver_name, $payment_date, $status, $payment_mode, $transaction_type, $fees, $type, $remark = '',$bank_details='')
    {

        $closing_amount = 0;
        $A_amount = User::select('available_amount', 'outlet_id')->find($retailer_id);
        if (!empty($A_amount))
            $closing_amount = $A_amount->available_amount;

        $transferHistory = new TransferHistory();
        $transferHistory->retailer_id   = $retailer_id;
        $transferHistory->outlet_id     = $A_amount->outlet_id;
        $transferHistory->amount        = $amount;
        $transferHistory->receiver_name = $receiver_name;
        $transferHistory->payment_date  = $payment_date;
        $transferHistory->status        = $status;
        $transferHistory->payment_mode  = $payment_mode;
        $transferHistory->fees          = $fees;
        $transferHistory->type          = $type;
        $transferHistory->transaction_type = $transaction_type;
        $transferHistory->closing_amount = $closing_amount;
        $transferHistory->remark        = $remark;
        if(!empty($bank_details))
        $transferHistory->bank_details  = $bank_details;
        $transferHistory->save();
    }
}




if (!function_exists('mSign')) {
    function mSign($val)
    {

        $val = ($val) ? number_format($val, 2, '.', '') : 0;

        return '<i class="fas fa-rupee-sign" style="font-size: 13px;
    color: #696b74;"></i>&nbsp;' . $val;
    }
}

if (!function_exists('spentTopupAmount')) {
    function spentTopupAmount($user_id, $amount)
    {
        try {
            $user = User::find($user_id);
            $avaliable_amount = ($user->available_amount) - ($amount);

            $spent_amount = ($user->spent_amount) + ($amount);

            $user->available_amount = $avaliable_amount;
            $user->spent_amount = $spent_amount;

            if ($user->save())
                return true;

            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}


if (!function_exists('addTopupAmount')) {
    function addTopupAmount($user_id, $amount, $transaction_fees = 0, $reject = 0)
    {

        try {
            $user = User::find($user_id);

            $avaliable_amount = ($user->available_amount) + ($amount);

            $total_amount = ($user->total_amount) + ($amount);
            $spent_amount = $user->spent_amount;

            if ($reject && !empty($spent_amount)) {
                $t_amount = ($amount) + ($transaction_fees);
                $user->spent_amount = ($spent_amount) - ($t_amount);
                $avaliable_amount = ($avaliable_amount) + ($transaction_fees);
            } else {
                $user->total_amount     = $total_amount;
            }
            $user->available_amount = $avaliable_amount;

            if ($user->save())
                return true;

            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}


if (!function_exists('MoneyPartnerOption')) {

    function MoneyPartnerOption()
    {

        $outlet = Outlet::select('money_transfer_option')->find(Auth::user()->outlet_id);
        if (!empty($outlet))
            return (object)$outlet->money_transfer_option;

        return false;
    }
}


//for push data to using webhook url
function webhook($data)
{
    //get webhook url
    $webhook = Webhook::select('webhook_url')->where('retailer_id', $data->retailer_id)->first();

    $url = '';
    if (!empty($webhook))
        $url = $webhook->webhook_url;
    if (!empty($url)) {
        $response = Curl::to($url)
            ->withData(json_encode($data))
            ->post();
        return true;
    }
}

function verify_url($base_url)
{
    $url = Webhook::where('retailer_id', Auth::user()->_id)->where('type', 'base_url')->first();
    if (!empty($url->base_url) && $url->base_url == $base_url)
        return false;

    return true;
}

function shiprocket($orderId) {

    $order = Order::find($orderId);
    $orderItems = json_encode($orderItems = $order->productDetails);
    $packageDetail = $order->packageDetail;
    $length = $packageDetail[0]['length'];
    $width = $packageDetail[0]['width'];
    $height = $packageDetail[0]['height'];
    $weigth = $packageDetail[0]['weight'];
    $pickup_address = Address::find($order->pickup_address_id)->address;

    $payload = '{
        "order_id": "'.$order->id.'",
        "order_date": "'.$order->order_date.'",
        "pickup_location": "W.Duniya",
        "comment": "Reseller: M/s Goku",
        "billing_customer_name": "Naruto",
        "billing_last_name": "Uzumaki",
        "billing_address": "House 221B, Leaf Village",
        "billing_address_2": "Near Hokage House",
        "billing_city": "New Delhi",
        "billing_pincode": "110002",
        "billing_state": "Delhi",
        "billing_country": "India",
        "billing_email": "naruto@uzumaki.com",
        "billing_phone": "9876543210",
        "shipping_is_billing": true,
        "shipping_customer_name": "",
        "shipping_last_name": "",
        "shipping_address": "",
        "shipping_address_2": "",
        "shipping_city": "",
        "shipping_pincode": "",
        "shipping_country": "",
        "shipping_state": "",
        "shipping_email": "",
        "shipping_phone": "",
        "order_items": [
          {
            "name": "Kunai",
            "sku": "chakra123",
            "units": 10,
            "selling_price": "900",
            "discount": "",
            "tax": "",
            "hsn": 441122
          }
        ],
        "payment_method": "Prepaid",
        "shipping_charges": 0,
        "giftwrap_charges": 0,
        "transaction_charges": 0,
        "total_discount": 0,
        "sub_total": 9000,
        "length": "'.$length.'",
        "breadth": "'.$width.'",
        "height": "'.$height.'",
        "weight": "'.$weigth.'"
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
            "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2MDM5MDksImlzcyI6Imh0dHBzOi8vYXBpdjIuc2hpcHJvY2tldC5pbi92MS9leHRlcm5hbC9hdXRoL2xvZ2luIiwiaWF0IjoxNjUxMzg0NzcyLCJleHAiOjE2NTIyNDg3NzIsIm5iZiI6MTY1MTM4NDc3MiwianRpIjoiZVNpWHNwVXd6aTZxSEdwVSJ9.nEuAbh9Ph-ovVfKhoDCbqRdlMKTMHT5-nnzFF-Clmuw",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 3f6d69a0-03ad-ba67-7db2-a1e3999c5f25"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
