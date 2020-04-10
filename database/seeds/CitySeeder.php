<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => '臺北市'],
            ['name' => '新北市'],
            ['name' => '桃園市'],
            ['name' => '臺中市'],
            ['name' => '臺南市'],
            ['name' => '高雄市'],
            ['name' => '苗栗縣'],
            ['name' => '彰化縣'],
            ['name' => '南投縣'],
            ['name' => '雲林縣'],
            ['name' => '嘉義縣'],
            ['name' => '屏東縣'],
            ['name' => '宜蘭縣'],
            ['name' => '花蓮縣'],
            ['name' => '臺東縣'],
            ['name' => '澎湖縣'],
            ['name' => '金門縣'],
            ['name' => '連江縣'],
            ['name' => '基隆市'],
            ['name' => '新竹市'],
            ['name' => '嘉義市']
        ];
        City::insert($cities);
    }
}
