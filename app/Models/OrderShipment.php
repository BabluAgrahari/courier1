<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipment extends BaseModel
{
    use HasFactory;

    protected $fillable = ['order_id','awb_number','courier_id','courier_name','ship_status','additional_info','payment_type','label','manifest','created'];
}
