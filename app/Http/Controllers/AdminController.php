<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\packages;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    function createPackage(Request $req){
        try {
            $validator = Validator::make($req->all(), [
                'package_details' => 'required|string',
                'package_cost' => 'required|integer',
                'discount_id' =>'required|integer',
                'package_type' =>'required|integer',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Package validation failed '], 401);
            } else {
                $packages = new packages();
                $packages->package_details = $req->package_details;
                $packages->package_cost = $req->package_cost;
                $packages->discount_id = $req->discount_id;
                $packages->package_type = $req->package_type;
                $packages->save();
                $package_id = $packages->package_id;
            }
            return response()->json(['package_id' => $package_id], 401);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            Log::info($data);
        }
    }
}
