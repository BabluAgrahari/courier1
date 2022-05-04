<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public $moduleName = 'Address';
    public $view = 'retailer/address';
    public $route = 'retailer/address';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moduleName = $this->moduleName;
        $addresses = Address::all();
        return view($this->view.'/index',compact('moduleName','addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $moduleName = $this->moduleName;
        return view($this->view.'/form',compact('moduleName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $address = new Address();
        $address->title = $request->title;
        $address->address = $request->address;
        $address->pincode = $request->pincode;
        $address->status = $request->status;
        $address->save();
        return response(['status' => 'success', 'msg' => 'Address Created Successfully!']);
        }catch(Exception $e) {
            return response(['status' => 'error', 'msg' => 'Address Not Created!']);
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
        return 'Hello';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::find($id);
        $moduleName = $this->moduleName;
        return view($this->view.'/_form',compact('moduleName','address'));
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
        try{
            $address = Address::find($id);
            $address->title = $request->title;
            $address->address = $request->address;
            $address->pincode = $request->pincode;
            $address->status = $request->status;
            $address->save();
            return redirect($this->route)->with('message','Address Updated Successfully.');
            }catch(Exception $e) {
            return redirect($this->route)->with('error',$e->getMessage());
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
        try{
            $address = Address::find($id)->delete();
        }catch(Exception $e){}
        return redirect($this->route)->with('message','Address Delete Succesfully.');
    }

    public function changeStatus($id) {

        try {
            $address = Address::find($id);
        if($address->status == 1) {
            $address->update(['status' => 0]);
        } else {
            $address->update(['status' => 1]);
        }
        } catch(Exception $e){}

        return redirect($this->route)->with('message','Address Status Change Succesfully.');
    }
}
