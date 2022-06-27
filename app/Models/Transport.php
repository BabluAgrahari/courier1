<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'transporter_form', 'owner_name', 'mobile_no', 'business_name', 'gst_no', 'whatsapp_no', 'phone', 'email', 'country', 'state', 'city', 'pincode', 'address', 'payment_accept', 'service_area', 'logo', 'store_cover_photo', 'business_description', 'verify', 'status'
    ];
}
