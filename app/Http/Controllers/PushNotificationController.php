<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\push_notifications;
use Illuminate\Http\Request;
use App\Models\users_send_notifications;
use Illuminate\Support\Facades\Validator;

class PushNotificationController extends Controller
{
   function pushNotification(){
    $data['users']=DB::table('users')->get();
    return view('/notifications/push-notifications',$data);
   }

   function savePushNotification(Request $req){
      if(is_array($req->gender_id)){
            $req->gender_id = implode(',',$req->gender_id);
        }else{
            $req->gender_id = $req->gender_id;
        }
        if(is_array($req->focus_id)){
            $req->focus_id = implode(',',$req->focus_id);
        }else{
            $req->focus_id = $req->focus_id;
        }
      // dd($req->all());
      $validator = Validator::make($req->all(), [
         'title' => ['required'],
         'description' => ['required'],
         'type' => ['required'],
         'user_id' => ['required'],
          'language_id' => ['required'],
           'gender_id' => ['required'],
           'focus_id' => ['required'],
         'status' => ['required'],
         'image'=>['required'],
         'date' => ['required'],
         'time' => ['required'],
         'expiry_date' => ['required'],
     ]);
     if ($validator->fails()) {

      return redirect('/notifications/push-notifications')
          ->withErrors($validator)
          ->withInput();
      } else { 
         
// dd( $data['users']);
            $file_thumb = $req->image;
            $file_name = $file_thumb->getClientOriginalName();
            $file_path_thumb = $file_thumb->getRealPath();
            $file_image_size = $file_thumb->getSize();
            $rl = $file_path_thumb;
            $sj = getimagesize($rl);
            $image_width_thumb = $sj[0];
            $image_height_thumb = $sj[1];
            $extension_image = $file_thumb->getClientOriginalExtension();
            $destinationPath = "storage/notification_image";
            $original_thub = strtolower(trim($req->image->getClientOriginalName()));
            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
            $file_thumb->move($destinationPath, $file_name_thumb);
               $user= new push_notifications;
               $user->title=$req->title;
               $user->description=$req->description;
                $user->language_id=$req->language_id;
                 $user->gender_id=$req->gender_id;
                 $user->focus_id=$req->focus_id;
               $user->type=$req->type;
               $user->user_id= count($req->user_id);
               $user->status=$req->status;
               $user->image='storage/notification_image/'.$file_name_thumb;
               $user->date=$req->date;
               $user->time=$req->time;
               $user->expiry_date=$req->expiry_date;
           
               $user->save();
               $last= DB::getPdo()->lastInsertId();
               $data['users']=DB::table('users')->where('user_notification_status',1)->where('status',1)->get();
               foreach($req->user_id as $users){
                 foreach($data['users'] as $users_data){
                      if($users_data->user_id == $users){
                        $usersend= new users_send_notifications;
                        $usersend->user_id = $users;
                        $usersend->notification =$req->title;
                        $usersend->notification_id=$last;
                        $usersend->save();
                        // $last_notification= DB::getPdo()->lastInsertId();
                        // dd($last_notification);
                      }  
                 }       
         }    
         $countusers=DB::table('users_send_notifications')->where('notification_id',$last)->count('notification_id');
         DB::table('push_notifications')->where('push_notification_id',$last)->update(array(
            'user_id'=>$countusers,
            
        ));
         return redirect('/notifications/list-all-notifications')->with('success','Your Notification Added Successfully');    
  }

   }

   function listAllNotification(){
        $data['mydata'] = DB::table('push_notifications')->orderBy('push_notification_id', 'DESC')->where('status','!=',3)
        ->paginate(25);
     
      // dd($data['users']);
      return view('/notifications/list-all-notifications',$data);
   }
function ArchivedNoti(){
   $data['mydata'] = DB::table('push_notifications')->orderBy('push_notification_id', 'DESC')->where('status',3)
   ->paginate(25);
//  $data['users']=DB::table('users')->get();
 // dd($data['users']);
 return view('/notifications/arichved-notifications',$data);
}
   function deleteNotification($push_notification_id){
      DB::table('push_notifications')->where('push_notification_id',$push_notification_id)->update(array(
         'status'=>3,  
     ));
      return redirect('/notifications/list-all-notifications')->with('success','Notification Added Archived Successfully');
   }
function Noticationundo($push_notification_id){
   DB::table('push_notifications')->where('push_notification_id',$push_notification_id)->update(array(
      'status'=>1,  
  ));
   return redirect('/notification/archived-notifi')->with('success','Notification Active Successfully');
}
   function editNotification($push_notification_id){
      $data['users']=DB::table('users')->get();
      $data['users_send_notifications']=DB::table('users_send_notifications')->where('notification_id',$push_notification_id)->get();
      $data['olddata']=DB::table('push_notifications')->where('push_notification_id',$push_notification_id)->first();
      // dd($data['users_send_notifications']);
      return view('/notifications/edit-notifications',$data);
   }

   function updateNotification(Request $req){
      if(is_array($req->gender_id)){
            $req->gender_id = implode(',',$req->gender_id);
        }else{
            $req->gender_id = $req->gender_id;
        }
        if(is_array($req->focus_id)){
            $req->focus_id = implode(',',$req->focus_id);
        }else{
            $req->focus_id = $req->focus_id;
        }
      $validator = Validator::make($req->all(), [
         'title' => ['required'],
         'description' => ['required'],
         'type' => ['required'],
         'user_id' => ['required'],
         'status' => ['required'],
         'date' => ['required'],
         'time' => ['required'],
         'expiry_date' => ['required'],
     ]);
     if ($validator->fails()) {

      return redirect('/notifications/edit-notifications/'.$req->id)
          ->withErrors($validator)
          ->withInput();
      } else { 
                  if(isset($req->image)){
                     $file_thumb = $req->image;
                     $file_name = $file_thumb->getClientOriginalName();
                     $file_path_thumb = $file_thumb->getRealPath();
                     $file_image_size = $file_thumb->getSize();
                     $rl = $file_path_thumb;
                     $sj = getimagesize($rl);
                     $image_width_thumb = $sj[0];
                     $image_height_thumb = $sj[1];
                     $extension_image = $file_thumb->getClientOriginalExtension();
                     $destinationPath = "storage/notification_image";
                     $original_thub = strtolower(trim($req->image->getClientOriginalName()));
                     $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $original_thub);
                     $file_thumb->move($destinationPath, $file_name_thumb);
                     DB::table('push_notifications')->where('push_notification_id',$req->id)->update(array(
                        'image'=>'storage/notification_image/'.$file_name_thumb,
                        
                    ));
                  }
                  DB::table('push_notifications')->where('push_notification_id',$req->id)->update(array(
                     'title'=>$req->title,
                     'description'=>$req->description,
                      'language_id'=> $req->language_id,
                     'gender_id'=> $req->gender_id,
                     'focus_id'=> $req->focus_id,
                     'type'=>$req->type,
                     'user_id'=>count($req->user_id),
                     'status'=>$req->status,
                     'date'=>$req->date,
                     'time'=>$req->time,
                     'expiry_date'=>$req->expiry_date,
                     
                 ));  
                 $data['users']=DB::table('users')->where('user_notification_status',1)->where('status',1)->get();
                 DB::table('users_send_notifications')->where('notification_id',$req->id)->delete();
                 foreach($req->user_id as $users){
                  foreach($data['users'] as $users_data){
                     if($users_data->user_id == $users){
                  $usersend= new users_send_notifications;
                  $usersend->user_id = $users;
                  $usersend->notification =$req->title;
                  $usersend->notification_id=$req->id;
                  $usersend->save(); 
                  }}
                 }
                 $countusers=DB::table('users_send_notifications')->where('notification_id',$req->id)->count('notification_id');
                 DB::table('push_notifications')->where('push_notification_id',$req->id)->update(array(
                    'user_id'=>$countusers,
                    
                ));
                 return redirect('/notifications/list-all-notifications')->with('success','Notification Updated Sucessfully');
               }
               } 
               function Resend($push_notification_id){
                 $push= DB::table('push_notifications')->where('push_notification_id',$push_notification_id)->where('status',1)->get();
                  return redirect('/notifications/list-all-notifications')->with('success','Notification Resend  Sucessfully');
               
               
                
               }
}


   