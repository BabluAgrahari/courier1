<?php

use App\Models\ApiList;
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
    function transferHistory($retailer_id, $amount, $receiver_name, $payment_date, $status, $payment_mode, $transaction_type, $fees, $type, $remark = '', $bank_details = '')
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
        if (!empty($bank_details))
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


function getAPIName($id)
{
    return ApiList::find($id)->name;
}

//  function getDistance($addressFrom, $addressTo, $unit = ''){
//     // Google API key
//     $apiKey = 'AIzaSyBS7N6bugP8MssTKboANjmwS0XiRbPBxXo';

//     // Change address format
//     $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
//     $formattedAddrTo     = str_replace(' ', '+', $addressTo);

//     // Geocoding API request with start address
//     $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
//     $outputFrom = json_decode($geocodeFrom);
//     if(!empty($outputFrom->error_message)){
//         return $outputFrom->error_message;
//     }

//     // Geocoding API request with end address
//     $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
//     $outputTo = json_decode($geocodeTo);
//     if(!empty($outputTo->error_message)){
//         return $outputTo->error_message;
//     }

//     // Get latitude and longitude from the geodata
//     $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
//     $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
//     $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
//     $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

//     // Calculate distance between latitude and longitude
//     $theta    = $longitudeFrom - $longitudeTo;
//     $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
//     $dist    = acos($dist);
//     $dist    = rad2deg($dist);
//     $miles    = $dist * 60 * 1.1515;

//     // Convert unit and return distance
//     $unit = strtoupper($unit);
//     if($unit == "K"){
//         return round($miles * 1.609344, 2).' km';
//     }elseif($unit == "M"){
//         return round($miles * 1609.344, 2).' meters';
//     }else{
//         return round($miles, 2).' miles';
//     }
// }

function getDistance($from, $to, $unit = 'km')
{
    $curl = curl_init();
    $apiKey = 'AIzaSyBS7N6bugP8MssTKboANjmwS0XiRbPBxXo';
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://maps.googleapis.com/maps/api/distancematrix/json?units=" . $unit . "&origins=" . $from . "&destinations=" . $to . "&key=" . $apiKey . "",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: fb4c7470-70d5-372b-9561-771d1f8bd73f"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        if (isset(json_decode($response)->rows[0])) {
            return str_replace('km', '', json_decode($response)->rows[0]->elements[0]->distance->text);
        } else {
            return $response;
        }
    }
}

// function getSlabRate($km, $apiId)
// {
//     $slab = Outlet::where('api_id', $apiId)->first()->bank_charges;
//     foreach($slab as $key => $val) {
//         if($km >= $val['from_amount'] &&  $km <= $val['to_amount']) {
//             return $val['charges'];
//         }
//     }

//     return 0;
// }

function getSlabRate($from,$to,$apiId) {
    try{
        $slab = Outlet::where('api_id', $apiId)->first()->bank_charges;

    $charge = collect($slab)->where('from_city',$from)->where('to_city',$to)->first();
    if($charge) {
        return $charge['charges'];
    } else {
        return 0;
    }
    } catch(Exception $e){
        return 'No Charges Found.';
    }

}

function getState($country = "IN")
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/'.$country.'/states',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'X-CSCAPI-KEY: TjI0c3NLbVFSUmRUckZhdlY2cmROSjNsSmFQR2RjRkR0YTEyTk5KQg=='
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response);
}
