<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
class PushNotificationController extends Controller
{
   function pushNotification(){
    $data['users']=DB::table('user_details')->get();
    return view('/notifications/push-notifications',$data);
   }
}
