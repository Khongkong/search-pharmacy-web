<?php

use Illuminate\Database\Seeder;
use App\Pharmacy;
use App\City;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        header("Content-Type:text/html; charset=utf-8");
        $raw_data = file_get_contents('https://raw.githubusercontent.com/kiang/pharmacies/master/json/points.json');
        $datas = json_decode($raw_data, true)['features'];
        $datas = array_map(function($val) {
            $properties = $val['properties']; 
            return [
                        'name' => $properties['name'],
                        'phone' => $properties['phone'],
                        'address' => $properties['address'],
                        'mask_adult' => $properties['mask_adult'],
                        'mask_child' => $properties['mask_child'],
                        'city_id' => $properties['county'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
        }, $datas);
        foreach($datas as &$data) {
            $city = City::select('id')->where('name', $data['city_id'])->firstOr(function(){
                return new class { public $id = 0; };
            });
            $data['city_id'] = $city->id;
        }
        Pharmacy::insert($datas);
    }
}
