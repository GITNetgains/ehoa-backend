<?php

namespace App\Http\Controllers;
use App\Models\groups;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    function groupsCreate(){

        return view('groups/group-create');
    }
  function groupsSave(Request $req){
    try {
        $validator = Validator::make($req->all(), [
            'group_name' => ['required', 'string'],
            'status' => ['required'],

        ]);

        if ($validator->fails()) {

            return redirect('/groups/group-create')
                ->withErrors($validator)
                ->withInput();
        } else {


                $group = new groups;
                $group->group_name = $req->group_name;
                $group->status = $req->status;
                $group->save();
            return redirect('/groups/list-all-groups')->with('success', 'New Groups added successfully');
        }
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
  }
  function groupsList(){
    // dd('okk');
    $data['groups'] = DB::table('groups')
            ->orderBy('g_id', 'DESC')->where('status','!=',3)
            ->latest()->paginate(25);
    return view('groups/list-all-groups',$data);
  }
  function groupsDelete($g_id){
    DB::table('groups')->where('g_id',$g_id)->update(array(
        
        'status'=>3,
));
    return redirect('groups/list-all-groups')->with('success','Group Archived Successfully!');
  }
  function groupsEdit($g_id){
    try {
        $data['groups'] = DB::table('groups')
            ->where('g_id', $g_id)
            ->get();
            // dd( $data['groups']);
        return view('groups/edit-group', $data);
    } catch (\Exception $exception) {
        $data['error'] = $exception->getMessage();
        return view('error', $data);
    }
  }
  function groupsUpdate(Request $req){
    // dd($req->all());
    try {

        DB::table('groups')->where('g_id', $req->id)->update(array(
            'group_name' => $req->group_name,
            'status'=>$req->status,
    ));

              return redirect('/groups/list-all-groups')->with('success','Groups Updated Successfully!');
          } catch (\Exception $exception) {
              $data['error'] = $exception->getMessage();
              return view('error', $data);
          }
  }
  function Archivedgroups(){
    $data['groups'] = DB::table('groups')
    ->orderBy('g_id', 'DESC')->where('status',3)
    ->latest()->paginate(25);
return view('/groups/archived-groups',$data);
  }
  function Undogroups($g_id){
    DB::table('groups')->where('g_id',$g_id)->update(array(
        
        'status'=>1,
));
    return redirect('/groups/archived-groups')->with('success','Group Active Successfully!');
  }
}
