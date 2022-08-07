<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderShipment;
use App\Http\Validation\ShipmentValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;

class ShipmentController extends Controller
{

    public $moduleName = 'Shipments';
    public $view = 'admin/shipments';
    public $route = 'admin/shipments';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $moduleName = $this->moduleName;
        $shipments = OrderShipment::all();

        return view($this->view . '/index', compact('moduleName', 'shipments'));
    }
    
}
