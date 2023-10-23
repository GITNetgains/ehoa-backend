<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function adminDashboard(){
        $data['users']=DB::table('users')->where('register_type',2)->count();
        $data['tips']=DB::table('tips')->count('tip_id');
        $data['videos']=DB::table('videos')->count('video_id');
        $data['blogs']=DB::table('blogs')->count('blog_id');
        $data['podcasts']=DB::table('podcasts')->count('podcast_id');
        // $data['yogas']=DB::table('yogas')->count('yoga_id');
        $data['categories']=DB::table('categories')->count('category_id');
        $data['groups']=DB::table('groups')->count('g_id');
        $data['settings']=DB::table('settings')->count('setting_id');
        $data['packages']=DB::table('packages')->count('package_id');
        $data['notification']=DB::table('push_notifications')->count('push_notification_id');
        $data['coupons']=DB::table('coupens')->count('coupons_id');
        $data['languages']=DB::table('languages')->count('language_id');
        $data['countries']=DB::table('countries')->count('country_id');
        $data['moonphases']=DB::table('moonphases')->count('moon_phase_id');
        $data['emotions']=DB::table('mood_disorders')->where('disorders_type',3)->count('disorders_id');
        $data['energy']=DB::table('mood_disorders')->where('disorders_type',4)->count('disorders_id');
        $data['menstrual']=DB::table('mood_disorders')->where('disorders_type',1)->count('disorders_id');
        $data['symtoms']=DB::table('mood_disorders')->where('disorders_type',2)->count('disorders_id');
        $data['orders']=DB::table('orders')->count('order_id');
        // dd($data['languages']);
    return view('admin/dashboard',$data);
    }
}
