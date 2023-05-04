<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    // public function getProvince()
    // {
    //     $province = RajaOngkir::provinsi()->all();
    //     // dd($province);
    //     // return response()->json($province);
    //     return $province;
    // }

    // public function getCity()
    // {
    //     // $city = RajaOngkir::kota()->search('ind')->get();
    //     $city = RajaOngkir::kota()->all();
    //    // $response = [];
    //     return $city;
    // }
    public function getProvince()
    {
        $province = RajaOngkir::provinsi()->all();
        //dd($province);
        // return response()->json($province);
        return $province;
    }

    public function getCities($id)
    {
        // $city = RajaOngkir::kota()->search('ind')->get();
        //$city = RajaOngkir::where('province_id', $id)->get();
        // $city= RajaOngkir::kota()->find($id);
        $city = RajaOngkir::kota()->dariProvinsi($id)->get();
       // $response = [];
        return json_encode($city);
    }

    // public function getCost(Request $request)
    // {
    //     $city= RajaOngkir::kota()->find(149);
    //     dd($city);
    //     $origin = $request->origin;
    //     $destination = $request->destination;
    //     $weight = $request->weight;
    //     $courier = $request->courier;

    //     $cost = RajaOngkir::cost([
    //         'origin' => $origin,
    //         'destination' => $destination,
    //         'weight' => $weight,
    //         'courier' => $courier,
    //     ])->get();

    //     return response()->json($cost);
    // }

    // public function getCost(Request $request)
    // {
    //     $origin = RajaOngkir::kota()->find(149);

    //     $destination = $request->city_origin;
    //     $weight = 10000;
    //     $courier = 'jne';

    //     $cost = RajaOngkir::ongkosKirim([
    //         'origin' => $origin['city_id'],
    //         'destination' => $destination,
    //         'weight' => $weight,
    //         'courier' => $courier,
    //     ])->get();

    //     //dd($cost);
    //     return response()->json($cost);

    // }

    public function getCost(Request $request, $cityOriginId)
    {
        $des = RajaOngkir::kota()->find($request->cityOriginId);
        $weight = 10000;
        $courier = 'jne';

        $response = RajaOngkir::ongkosKirim([
            // 'origin' => $origin,
            'origin' => 149,
            'destination' => $des['city_id'],
            'weight' => $weight,
            'courier' => 'jne',
        ])->get();

        $costOptions = [];
        foreach ($response[0]["costs"] as $cost) {
            $costOptions[] = $cost;
        }

        return response()->json($costOptions);
    }

    public function cost(Request $request)
    {
        return $request->all();
    }

}
