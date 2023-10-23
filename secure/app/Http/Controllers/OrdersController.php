<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    function ordersShow(){
        $data['orders'] = DB::table('orders')->orderBy('order_id', 'DESC')
        ->paginate(25);
        $data['users'] = DB::table('users')->get();
        $data['packages'] = DB::table('packages')->get();
        $data['coupons'] = DB::table('coupens')->get();
        // dd($data['orders']);
        return view('order/orders',$data);
    }
    function Search(Request $req){
        // $data['orders'] = DB::table('orders')->orderBy('order_id', 'DESC')
        // ->paginate(10);
        $data['users'] = DB::table('users')->get();
        $data['packages'] = DB::table('packages')->get();
        $data['coupons'] = DB::table('coupens')->get();
        $to_date=$req->to_date;
        $from_date=$req->from_date;
   
       $data['orders']= orders::whereBetween('created_at',[$to_date, $from_date])->orderBy('order_id', 'DESC')->paginate(10);

    if($data['orders'])
    {
        return view('order/orders',$data); 
    }
        return redirect('/order/orders')->with('error', 'Please enter something in serach!');
       

    }
    function ordersView($order_id){
        $data['orders'] = DB::table('orders')->where('order_id',$order_id)->get();
        $data['users'] = DB::table('users')->where('register_type',2)->where('status',1)->get();
        $data['packages'] = DB::table('packages')->get();
        $data['countries'] = DB::table('countries')->get();
        // dd($data['countries']);
        $data['coupons'] = DB::table('coupens')->get();
            return view('order/views-orders',$data);
    }
    function ordersEdit($order_id){
        $data['orders'] = DB::table('orders')->where('order_id',$order_id)->get();
        $data['users'] = DB::table('users')->where('register_type',2)->where('status',1)->get();
        $data['packages'] = DB::table('packages')->get();
        $data['coupons'] = DB::table('coupens')->get();
   
        return view('order/edit-order',$data);
    }
    function UpdateOrder(Request $req){
        DB::table('orders')->where('order_id', $req->id)
        ->update(array(
        //   'payment'=>$req->payment,
        //   'package_expiry_date'=>$req->package_expiry_date,
        //   'package_start_date'=>$req->package_start_date,
          'status'=>$req->status,
        ));
        return redirect('order/orders')->with('message','Order Updated Succesfully');
    }
}
