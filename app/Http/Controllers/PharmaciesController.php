<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PharmaciesController extends Controller
{
    public function searchPharmacies(Request $request){
        if(count($request->query()) == 1){
            if($request->query('address')){
                return $this->searchByAddress($request);
            }elseif($request->query('name')){
                return $this->searchByPharmacyName($request);
            }
        }
        throw new \Exception('not a valid query.');
    }

    private function searchByAddress(Request $request) {
        $input = $request->query('address');
        $addresses = explode(' ', $input);
        $pharmacies = $this->pharmaciesDataParse();
        foreach($addresses as $address){
            $pharmacies = array_filter($pharmacies, function($val) use($address) {
                return is_int(strpos($val['address'], $address));
            });
        }
        usort($pharmacies, function($a, $b) {
            if ($a['mask_adult'] == $b['mask_adult']) {
                return 0;
            }
            return ($a['mask_adult'] > $b['mask_adult'])? -1 : 1;
        });
        foreach($pharmacies as $id => &$pharmacy){
            $pharmacy['id'] = $id + 1;
        }
        // return $pharmacies;
        return view('pages.index')->with('pharmacies', $pharmacies);
    }
    
    private function searchByPharmacyName(Request $request) {
        $input = $request->query('name');
        $names = explode(' ', $input);
        $pharmacies = $this->pharmaciesDataParse();
        foreach($names as $name){
            $pharmacies = array_filter($pharmacies, function($val) use($name) {
                return is_int(strpos($val['name'], $name));
            });
        }
        usort($pharmacies, function($a, $b) {
            if ($a['mask_adult'] == $b['mask_adult']) {
                return 0;
            }
            return ($a['mask_adult'] > $b['mask_adult'])? -1 : 1;
        });
        foreach($pharmacies as $id => &$pharmacy){
            $pharmacy['id'] = $id + 1;
        }
        // return $pharmacies;
        return view('pages.index')->with('pharmacies', $pharmacies);
    }

    private function pharmaciesDataParse() {
        header("Content-Type:text/html; charset=utf-8");
        $raw_data = file_get_contents('https://raw.githubusercontent.com/kiang/pharmacies/master/json/points.json');
        $data = json_decode($raw_data, true)['features'];
        $data = array_map(function($val) {
            return $val['properties'];
        }, $data);
        return $data;
    }
}
