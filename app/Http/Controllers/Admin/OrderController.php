<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\ApiList;
use App\Models\Order;

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

}
