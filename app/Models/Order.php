<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    use HasFactory;

    // protected $fillable = ['buyer_name','phone_number','phone_alt','email','bill_address_line_1','bill_address_line_2','bill_pincode','bill_city','bill_state','bill_country','bill_ship_same','ship_address_line_1','ship_address_line_2','ship_pincode','ship_city','ship_state','ship_country','hyperlocal_shipment','location'];
    protected $guarded = [];
}
