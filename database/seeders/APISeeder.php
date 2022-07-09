<?php

namespace Database\Seeders;

use App\Models\ApiList;
use Illuminate\Database\Seeder;

class APISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $apis = [
            ['api' => 'https://ship.xpressbees.com/api/shipments2','name' => 'Xpressbees','sort' => 1,'status' => 1],
            ['api' => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc','name' => 'Ship Rocket','sort' => 1,'status' => 1]
        ];


        foreach($apis as $api){
            ApiList::updateOrCreate($api);
        }
    }
}
