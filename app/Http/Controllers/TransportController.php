<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Validation\TransportValidation;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class TransportController extends Controller
{
    public $moduleName = 'Transport';
    public $view = 'admin/transport';
    public $route = 'admin/transport';

    public function index()
    {

        //  set_time_limit(-1);

        // $states = simplexml_load_file("states.xml") or die("Error: Cannot create object");
        // foreach ($states as $k => $val) {
        //     State::create([
        //         'state_id' => (int) str_replace("[]", '', $val->id),
        //         'name' => str_replace("[]", '', $val->name),
        //         'state_code' => str_replace("[]", '', $val->state_code),
        //     ]);

        //     echo "State " . $val->name;
        //     echo "<br />";
        // }

        // $cities = simplexml_load_file("cities.xml") or die("Error: Cannot create object");
        // foreach ($cities as $key => $val) {
        //     City::create([
        //         'city_id' => str_replace("[]", '', $val->id),
        //         'name' => $val->name,
        //         'state_id' => str_replace("[]", '', $val->state_id),
        //     ]);
        // }

        $moduleName = $this->moduleName;
        $transports = Transport::get();
        return view($this->view . '/index', compact('moduleName', 'transports'));
    }

    public function create()
    {

        $moduleName = $this->moduleName;
        $states = (object) getState('IN');
        return view($this->view . '/form', compact('moduleName','states'));
    }

    public function store(TransportValidation $request)
    {
        try {
            if ($request->hasFile('logo')) {
                $logo = singleFile($request->file('logo'), 'transport');
            } else {
                $logo = '';
            }

            if ($request->hasFile('store_cover_photo')) {
                $store_cover_photo = singleFile($request->file('store_cover_photo'), 'transport');
            } else {
                $store_cover_photo = '';
            }

            $transport = new Transport();
            $transport->transport_from = $request->transport_from;
            $transport->owner_name = $request->owner_name;
            $transport->mobile_no = $request->mobile_no;
            $transport->business_name = $request->business_name;
            $transport->gst_no   = $request->gst_no;
            $transport->whatsapp_no = $request->whatsapp_no;
            $transport->phone = $request->phone;
            $transport->email = $request->email;
            $transport->country = $request->country;
            $transport->state = $request->state;
            $transport->city = $request->city;
            $transport->pincode = $request->pincode;
            $transport->address = $request->address;
            $transport->payment_accept = $request->payment_accept;
            $transport->service_state = $request->service_state;
            $transport->service_city = implode(',',$request->service_city);
            $transport->business_description = $request->business_description;
            $transport->status = $request->status;
            $transport->is_verify = $request->is_verify;
            $transport->logo = $logo;
            $transport->store_cover_photo = $store_cover_photo;
            $transport->save();

            return response(['status' => 'success', 'msg' => 'Transport Created Successfully!']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'msg' => 'Transport Not Created!']);
        }
    }


    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $states = (object) getState('IN');
        $transport = Transport::find($id);

        return view($this->view . '/_form', compact('moduleName','transport','states'));
    }

    public function update(TransportValidation $request, $id)
    {
        try {
            if ($request->hasFile('logo')) {
                file_exists('public/transport/'.$request->old_logo) ?? unlink('public/transport/'.$request->old_logo);
                $logo = singleFile($request->file('logo'), 'transport');
            } else {
                $logo = $request->old_logo;
            }

            if ($request->hasFile('store_cover_photo')) {
                file_exists('public/transport/'.$request->old_store_cover_photo) ?? unlink('public/transport/'.$request->old_store_cover_photo);
                $store_cover_photo = singleFile($request->file('store_cover_photo'), 'transport');
            } else {
                $store_cover_photo = $request->old_store_cover_photo;
            }

            $transport = Transport::find($id);
            $transport->transport_from = $request->transport_from;
            $transport->owner_name = $request->owner_name;
            $transport->mobile_no = $request->mobile_no;
            $transport->business_name = $request->business_name;
            $transport->gst_no   = $request->gst_no;
            $transport->whatsapp_no = $request->whatsapp_no;
            $transport->phone = $request->phone;
            $transport->email = $request->email;
            $transport->country = $request->country;
            $transport->state = $request->state;
            $transport->city = $request->city;
            $transport->pincode = $request->pincode;
            $transport->address = $request->address;
            $transport->payment_accept = $request->payment_accept;
            $transport->service_state = $request->service_state;
            $transport->service_city = implode(',',$request->service_city);
            $transport->business_description = $request->business_description;
            $transport->status = $request->status;
            $transport->is_verify = $request->is_verify;
            $transport->logo = $logo;
            $transport->store_cover_photo = $store_cover_photo;
            $transport->save();
            return response(['status' => 'success', 'msg' => 'Transport Updated Successfully.']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function changeStatus($id)
    {

        try {
            $address = Transport::find($id);
            if ($address->status == 1) {
                $address->update(['status' => 0]);
            } else {
                $address->update(['status' => 1]);
            }
        } catch (Exception $e) {
        }

        return redirect($this->route)->with('message', 'Transport Status Change Succesfully.');
    }

    public static function getState() {
        set_time_limit(-1);

        $states = simplexml_load_file("states.xml") or die("Error: Cannot create object");
        foreach ($states as $k => $val) {
            State::create([
                'state_id' => (int) str_replace("[]", '', $val->id),
                'name' => str_replace("[]", '', $val->name),
                'state_code' => str_replace("[]", '', $val->state_code),
            ]);

            echo "State " . $val->name;
            echo "<br />";
        }

        $cities = simplexml_load_file("cities.xml") or die("Error: Cannot create object");
        foreach ($cities as $key => $val) {
            City::create([
                'city_id' => str_replace("[]", '', $val->id),
                'name' => $val->name,
                'state_id' => str_replace("[]", '', $val->name, $val->state_id),
            ]);

            echo "City " . $val->name;
            echo "<br />";
        }
    }
}
