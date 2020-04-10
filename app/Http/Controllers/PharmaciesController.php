<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Pharmacy;

class PharmaciesController extends Controller
{
    /**
     * @OA\GET(
     *      path="/api/pharmacies",
     *      operationId="getPharmaciesByAddressOrName",
     *      tags={"Pharmacies"},
     *      summary="Get pharmacies by addresses or name",
     *      description="Returns pharmacies data",
     *      @OA\Parameter(
     *          name="address",
     *          in="query",
     *          description="Address you search",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="name you search",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:pharmacies", "read:pharmacies"}
     *         }
     *     }
     * )
     */
    public function searchPharmacies(Request $request){
        // $this->updateMasks();
        if(count($request->query()) == 1){
            if($request->query('address')){
                return $this->searchByAddress($request);
            }elseif($request->query('name')){
                return $this->searchByPharmacyName($request);
            }
            return JsonResponse::create([ 'error' => 'not a valid query']);
        }elseif(count($request->query()) == 2){
            if($request->query('address') && $request->query('name')){
                return $this->searchByNameAndAddress($request);
            }
            return JsonResponse::create([ 'error' => 'not a valid query']);
        }
        return JsonResponse::create([ 'error' => 'not a valid query']);
    }

    /**
     * @OA\GET(
     *      path="/api/pharmacies/all",
     *      operationId="getPharmacies",
     *      tags={"Pharmacies"},
     *      summary="Get all pharmacies",
     *      description="Returns pharmacies data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:pharmacies", "read:pharmacies"}
     *         }
     *     }
     * )
     */
    public function getAll(){
        return Pharmacy::all();
    }

    private function searchByAddress(Request $request) {
        $input = $request->query('address');
        $addresses = explode(' ', $input);
        
        $pharmacies = Pharmacy::where(function($query)use($addresses){
            foreach($addresses as $address){
                $query->where('address', 'like', '%'.$address.'%');
            }
        })->orderBy('mask_adult', 'DESC')->get();
        foreach($pharmacies as $key => &$pharmacy){
            $pharmacy['id'] = $key + 1;
        }
        return $pharmacies;
        // return view('pages.index')->with('pharmacies', $pharmacies);
    }
    
    private function searchByPharmacyName(Request $request) {
        $input = $request->query('name');
        $names = explode(' ', $input);

        $pharmacies = Pharmacy::where(function($query)use($names){
            foreach($names as $name){
                $query->where('name', 'like', '%'.$name.'%');
            }
        })->orderBy('mask_adult', 'DESC')->get();
        foreach($pharmacies as $key => &$pharmacy){
            $pharmacy['id'] = $key + 1;
        }
        return $pharmacies;
    }
    
    private function searchByNameAndAddress(Request $request) {
        $inputName = $request->query('name');
        $inputAddress = $request->query('address');
        $names = explode(' ', $inputName);
        $addresses = explode(' ', $inputAddress);
        $pharmacies = Pharmacy::where(function($query)use($addresses, $names){
            foreach($names as $name){
                $query->where('name', 'like', '%'.$name.'%');
            }
            foreach($addresses as $address){
                $query->where('address', 'like', '%'.$address.'%');
            }
        })->orderBy('mask_adult', 'DESC')->get();
        foreach($pharmacies as $key => &$pharmacy){
            $pharmacy['id'] = $key + 1;
        }
        return $pharmacies;
    }

    public function updateMasks() {
        $updatedAt = Pharmacy::find(1)->updated_at;
        if(time() - strtotime($updatedAt) > 300){
            header("Content-Type:text/html; charset=utf-8");
            $raw_data = file_get_contents('https://raw.githubusercontent.com/kiang/pharmacies/master/json/points.json');
            $datas = json_decode($raw_data, true)['features'];
            // $datas = array_map(function($val) {
            //     $properties = $val['properties'];
            //     return [
            //         'phone' => $properties['phone'],
            //         'mask_adult' => $properties['mask_adult'],
            //         'mask_child' => $properties['mask_child'],
            //     ];
            // }, $datas);
            foreach($datas as $data) {
                Pharmacy::where('phone', $data['properties']['phone'])->update([
                    'mask_adult' => $data['properties']['mask_adult'],
                    'mask_child' => $data['properties']['mask_child'],
                ]);
            }
        }
    }

}
