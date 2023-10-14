<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Models\Zone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    public function get_zones(Request $request)
    {

        //$data=[{"latitude":'30.5744821',"longitude":'31.0146668'}];
      $data=  Helpers::address_data_formatting($request->all());

        print_r($data);
        echo"kfj"; exit;
       $data= Zone::where('status',1)->get();
        return response()->json($data, 200);
    }
}
