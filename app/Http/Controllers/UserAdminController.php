<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Session;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\cycles;
use App\Models\user_symptoms;
use App\Models\reminders;
use App\Models\user_symptom_details;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UserAdminController extends Controller
{
    function createUser(Request $req)
    {
        // dd($req->all());
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|max:200|string|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|min:8|max:15|regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                // dd($req->all());
                trim($req->password);
                $password = Hash::make($req->password);
                $token = Str::random(64);
                $user = new User();
                $user->email = $req->email;
                $user->password = $password;
                $user->register_type = 2;
                $user->status = 1;
                $user->remember_token = $token;
                $user->save();
                $user_id= $user->id;
                $get_token = DB::table('users')->where('user_id', $user_id)->first();
            }
            // email verify request
            // Mail::send('emails.notify-user', ['user_id' => $user_id, 'token' => $get_token->remember_token], function ($message) use ($req) {
            //     $message->to($req->email);
            //     $message->subject('Verify email');
            // });
            // dd('okk');
            return response()->json(['user_id' => $user_id, 'token' => $token], 401);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
    function addAdmin(){
            return view('admin/add-admin-user');
    }
    function createAdmin(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|max:200|string|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|min:8|max:15|regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                trim($req->password);
                $password = Hash::make($req->password);
                $token = Str::random(64);
                $user = new User();
                $user->name = $req->name;
                $user->email = $req->email;
                $user->password = $password;
                $user->register_type = 1;
                $user->status = 1;
                $user->remember_token = $token;
                $user->save();
                $user_id= $user->id;
                $get_token = DB::table('users')->where('user_id', $user_id)->first();
            }
            return redirect('/admin/admin-user')->with('message', 'User added successfully!');
            /*return response()->json(['user_id' => $user_id, 'token' => $token], 401);*/
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function verifiedUserEmail($token, $id)
    {
        $get_status = DB::table('users')
            ->where('user_id', $id)
            ->where('remember_token', $token)
            ->first();
        // dd($get_status);
        if ($get_status->status == 2) {
            DB::table('users')
                ->where('user_id', $id)
                ->where('remember_token', $token)
                ->update(array(
                    'status' => 1
                ));
            return view('emails/email-verify-msg', ['success' => 'You Are Verified Now Please Log In To Enjoy']);
        }
        if ($get_status->status == 1) {
            return view('emails/email-verify-msg', ['success' => 'You Are Already Verified']);
        }
    }
    function logIn(Request $req)
    {
        // dd($req->all());
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|max:200|string|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|min:8|max:15',
            ]);

            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                $credentials = $req->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    $status = auth()->user()->status;
                    $user_id= auth()->user()->user_id;
                    $token = Str::random(64);
                    DB::table('users')->where('user_id', $user_id)->update(
                        array(
                            'remember_token' => $token
                        )
                    );
                    // login based on status
                    if ($status == 1) {
                        return response()->json(['user_id' => $user_id, 'token' => $token, 'success' => 'Sucessfully Login'], 401);
                    }
                    if ($status == 2) {
                        return response()->json(['error' => 'Your account is de-active,please activate your account']);
                    }
                    if ($status == 3) {
                        return response()->json(['error' => 'Your Account has been deleted.']);
                    }
                } else {
                    Session::flush();
                    return response()->json(['error' => 'Invalid Email or Password']);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
    // Updated existingUserSocialLogIn function
    function existingUserSocialLogIn(Request $req)
    {
        // dd($req->all());
        // SOCIAL LOGIN API, FOR EG. IF USER LOGIN THROUGH GOOGLE, FACEBOOK OR ANY OTHER SOACIAL PLATFORM.
        $validator = Validator::make($req->all(), [
            'email' => 'required|max:200|string|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|min:8|max:15',
        ]);
        if ($validator->fails()) {
            $error = $validator->messages()->get('*');
            return response()->json(['error' => $error]);
        } else {

            $token = Str::random(64);
            //  $CHECK variable will check that if the email exists and count in database
            $check = DB::table('users')
                ->where('email', $req->email)
                ->where('is_social', 1)
                ->count();
            // if email exists with social status 1 then it will return a token to the user
            if ($check > 0) {
                DB::table('users')->where('email', $req->email)->update(
                    array(
                        'remember_token' => $token
                    )
                );
                DB::table('users')->where('email',  $req->email)->get();
               $data = DB::table('users')->where('email',  $req->email)->first();
                return response()->json(['email' => $req->email, 'user_id' => $data -> user_id,'token' => $token, 'success' => 'Sucessfully Login'], 401);
            } else {
                // dd($token);
                Session::flush();
                return response()->json(['error' => 'You email id does not exist in your social account, Please register through valid email']);
            }
        }
    }

    function newUserSocialLogIn(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required|max:200|string|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|min:8|max:15|regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {

                if (isset($req->is_social) && $req->is_social == 1) {
                    $social = 1;
                } else {
                    $social = null;
                }
                trim($req->password);
                $password = Hash::make($req->password);
                $token = Str::random(64);
                $user = new User();
                $user->email = $req->email;
                $user->password = $password;
                $user->register_type = 2;
                $user->status = 1;
                $user->is_social = $social;
                $user->remember_token = $token;
                $user->save();
                $user_id= $user->id;
                // $get_token = DB::table('users')->where('user_id', $user_id)->first();
            }
            // dd('okk');
            return response()->json(['user_id' => $user_id, 'token' => $token], 401);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function logOut()
    {
        Session::flush();
        Auth::logout();
        return response()->json(['success' => 'Sucessfully Logout'], 401);
    }
    public function findCoupon(Request $req)
    {
        $coupens = DB::table('coupens')
            ->where('name', $req->coupon_name)
            ->first();

        if ($coupens) {
            return response()->json(['Coupon Data' => $coupens], 200);
        } else {
            return response()->json(['message' => 'Coupon not found'], 200);
        }

    }
    function deleteUser(Request $req)
    {
        try {
            // dd($req->all());
            $validator = Validator::make($req->all(), [
                'user_id' => 'required',
                'remember_token' => 'required',
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                $get_status = DB::table('users')
                    ->where('user_id', $req->user_id)
                    ->where('remember_token', $req->remember_token)->first();
                // dd($get_status);
                if ($get_status->status == 1) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->remember_token)
                        ->update(array(
                            'status' => 3
                        ));
                    return response()->json(['success' => 'Account deleted sucessfully'], 401);
                } else {
                    return response()->json(['error' => 'Your Account has already been deleted.'], 401);
                }

                // dd('ok');
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }


    function userTermConditions(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'is_term' => ['required'],
                    'is_understand' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    // to count the user id and token, means if these both exists
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    // if both exists the on that user id and token the update query will execute
                    // user terms and data conditions
                    if ($get_results > 0) {
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->where('remember_token', $req->token)
                            ->update(
                                array(
                                    'is_term' => 1,
                                    'is_understand' => 1
                                )
                            );
                    }
                    // this condition will execute if the user id and token will expire or does not match
                    else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }
                }
            }
            return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

public function addFriend(Request $req)
    {
        try {
            if (!isset($req->user_id) || !isset($req->token) || !isset($req->friend_email) || !isset($req->friend_name)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'friend_email' => ['required'],
                ]);

                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $friend = DB::table('users')
                        ->where('email', $req->friend_email)
                        ->first();
                    $friend_count = DB::table('users')
                        ->where('email', $req->friend_email)
                        ->count();
                    $user_name = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->first();

                    if ($friend_count > 0) {
                        $get_results = DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->where('remember_token', $req->token)
                            ->first();

                        if ($get_results) {
                            $user = DB::table('users')
                                ->where('email', $req->friend_email)
                                ->select('friend_requests_list')
                                ->first();

                            $friendList = json_decode($user->friend_requests_list, true) ?? [];

                            // Check if a friend request from this user already exists for the given email
                            $existingFriendRequest = array_filter($friendList, function ($request) use ($req, $get_results) {
                                return $request['email'] === $req->friend_email && $request['sender'] === $get_results->email;
                            });

                            if (empty($existingFriendRequest)) {
                                $newFriend = [
                                    'user_id' => $req->user_id,
                                    'name' => $req->friend_name,
                                    'sender_name' => $get_results->name,
                                    'email' => $req->friend_email,
                                    'sender' => $get_results->email,
                                ];

                                $friendList[] = $newFriend;

                                $friendListJson = json_encode($friendList);
                                Mail::send('emails.friend-request', ['RecipentName' => $friend->name, 'SenderName' => $get_results->name], function ($message) use ($req) {
                                    $message->to($req->friend_email);
                                    $message->subject('Friend Request Notification');
                                });

                                DB::table('users')
                                    ->where('email', $req->friend_email)
                                    ->update([
                                        'friend_requests_list' => $friendListJson,
                                    ]);
                            } else {
                                return response()->json(['error' => 'Friend request already sent to this email'], 400);

                            }
                        } else {
                            return response()->json(['error' => 'Your token is expired, please check your token and user id'], 401);
                        }
                    } else {

                        Mail::send('emails.friend-invitation', ['RecipentName' => $req->friend_name, 'SenderName' => $user_name->name], function ($message) use ($req) {
                            $message->to($req->friend_email);
                            $message->subject('Invitation to Join EHOA App');
                        });

                        return response()->json(['message' => 'Friend Invitation mail is sent successfully'], 200);

                    }

                    return response()->json([
                        'message' => 'Friend Invitation mail is sent successfully',
                        // 'user_id' => $req->user_id,
                        // 'token' => $req->token,
                        'friend_requests_list of friend' => $friendListJson,
                    ], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
    public function getFriendRequests($user_id)
    {
        $user = DB::table('users')
            ->where('user_id', $user_id)
            ->select('friend_requests_list')
            ->first();

        if ($user) {
            $friendList = json_decode($user->friend_requests_list, true);
            return response()->json(['Friend request List' => $friendList], 200);
        } else {
            return response()->json(['message' => 'User not found'], 200);
        }

    }
    public function getFriends($user_id)
    {
        $user = DB::table('users')
            ->where('user_id', $user_id)
            ->select('friend_list')
            ->first();

        if ($user) {
            $friendList = json_decode($user->friend_list, true);
            return response()->json(['Friend List' => $friendList], 200);
        } else {
            return response()->json(['message' => 'User not found'], 200);
        }

    }
    public function acceptRequest(Request $req)
    {
        try {
            if (!isset($req->user_id) || !isset($req->token) || !isset($req->friend_email) || !isset($req->accept)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'friend_email' => ['required'],
                ]);

                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $user = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)
                        ->first();

                    $sender_obj = DB::table('users')
                        ->where('email', $req->friend_email)
                        ->first();

                    if (!$user) {
                        return response()->json(['error' => 'Your token is expired, please check your token and user id'], 401);
                    }

                    $friendRequests = json_decode($user->friend_requests_list, true) ?? [];
                    $friendList = json_decode($user->friend_list, true) ?? [];

                    $friendIndex = null;
                    foreach ($friendRequests as $index => $request) {
                        if ($request['sender'] === $req->friend_email) {
                            $friendIndex = $index;
                            break;
                        }
                    }

                    if ($friendIndex !== null) {
                        if ($req->accept === true) {
                            // Check if the new friend is already in the sender's friend_list
                            $newFriend = [
                                'user_id' => $friendRequests[$friendIndex]['user_id'],
                                'name' => $friendRequests[$friendIndex]['sender_name'],
                                'email' => $friendRequests[$friendIndex]['sender'],
                            ];

                            $isFriendInList = false;
                            foreach ($friendList as $friend) {
                                if ($friend['user_id'] === $newFriend['user_id']) {
                                    $isFriendInList = true;
                                    break;
                                }
                            }

                            if (!$isFriendInList) {
                                // Accept friend request by adding to sender_email's friend_list
                                $senderFriendList[] = $newFriend;

                                // Update the sender's friend_list in the database
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update([
                                        'friend_list' => json_encode($senderFriendList),
                                    ]);

                                // Remove the friend request from friend_requests_list of the current user
                                unset($friendRequests[$friendIndex]);

                                // Update the current user's friend_requests_list in the database
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update([
                                        'friend_requests_list' => json_encode(array_values($friendRequests)),
                                    ]);

                                return response()->json([
                                    'user_id' => $req->user_id,
                                    'token' => $req->token,
                                    // 'friend' => $newFriend,
                                    'friend_list of sender' => json_encode($friendList),
                                    'friend_requests_list' => json_encode(array_values($friendRequests)),
                                ], 200);
                            } else {
                                unset($friendRequests[$friendIndex]);
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update([
                                        'friend_requests_list' => json_encode(array_values($friendRequests)),
                                    ]);

                                return response()->json(['message' => 'Friend is already added'], 200);
                            }
                        } else {
                            unset($friendRequests[$friendIndex]);
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update([
                                    'friend_requests_list' => json_encode(array_values($friendRequests)),
                                ]);

                            return response()->json(['message' => 'Friend is already added'], 200);
                        }
                    } else {
                        return response()->json(['error' => 'Friend request not found'], 404);
                    }
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }


    // newly created function
    public function saveDetails(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->country_id) && !isset($req->group_id) && !isset($req->name) && !isset($req->dob) && !isset($req->gender) && !isset($req->custom_gender) && !isset($req->pronoun_id) && !isset($req->custom_pronoun) && !isset($req->language_id) && !isset($req->average_cycle_length) && isset($req->dont_know_cycle_length) && !isset($req->average_cycle_days) && isset($req->dont_know_cycle_days) && !isset($req->focus_id) && !isset($req->period_day)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'country_id' => ['required'],
                    'name' => ['required'],
                    'dob' => ['required'],
                    'language_id' => ['required'],
                    'is_term' => ['required'],
                    'is_understand' => ['required'],
                    'focus_id' => ['required'],
                    'period_day' => ['required'],
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    // For group
                    // if (isset($req->group_id) && isset($req->custom_group)) {
                    //         return response()->json(['message' => 'Please choose only one field for Group'], 401);
                    //     }
                    // For cycle Days
                    if (isset($req->average_cycle_days)) {
                        $average_cycle_days = $req->average_cycle_days;
                    } else {
                        $average_cycle_days = null;
                    }
                    // For gender
                    // if (isset($req->gender) && isset($req->custom_gender)) {
                    //     return response()->json(['message' => 'Please choose only one field for gender'], 401);
                    // } else
                    if (!isset($req->gender) && !isset($req->custom_gender)) {
                        return response()->json(['message' => 'Please choose atleast one gender'], 401);
                    }
                    // for Pronoun
                    // if (isset($req->pronoun_id) && isset($req->custom_pronoun)) {
                    //     return response()->json(['message' => 'Please choose only one field for Pronoun'], 401);
                    // } else
                    if (!isset($req->pronoun_id) && !isset($req->custom_pronoun)) {
                        return response()->json(['message' => 'Please choose atleast one pronoun'], 401);
                    }
                    // for average_cycle_length
                    if (isset($req->average_cycle_length)) {
                        $average_cycle_length = $req->average_cycle_length;
                    } else {
                        $average_cycle_length = null;
                    }
                    // end
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    // country selection
                    if ($get_results > 0) {
                        // updating name -->
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'name' => $req->name,
                                )
                            );
                        // updating dob -->
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'dob' => $req->dob,
                                )
                            );
                        // updating language -->
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'language_id' => $req->language_id,
                                )
                            );
                        // Updating terms and conditions
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->where('remember_token', $req->token)
                            ->update(
                                array(
                                    'is_term' => 1,
                                    'is_understand' => 1,
                                )
                            );
                        // Updating average_cycle_length -->
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'average_cycle_length' => $average_cycle_length,
                                )
                            );
                        // Updating focus_id -->
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'focus_id' => $req->focus_id,
                                )
                            );
                        // Updating average_cycle_length -->
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'average_cycle_days' => $average_cycle_days,
                                )
                            );
                        // Updating average_cycle_length -->
                        // $echo period_day;
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'period_day' => $req->period_day,
                                )
                            );

                        // updating countries -->
                        if (isset($req->country_id)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'country_id' => $req->country_id,
                                    )
                                );
                            if (isset($req->group_id) && !isset($req->custom_group)) {
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update(
                                        array(
                                            'group_id' => $req->group_id,
                                        )
                                    );
                            }
                            if (isset($req->custom_group) && !isset($req->group_id)) {
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update(
                                        array(
                                            'custom_group' => $req->custom_group,
                                        )
                                    );
                            }
                            if (isset($req->custom_group) && isset($req->group_id)) {
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update(
                                        array(
                                            'custom_group' => $req->custom_group,
                                            'group_id' => $req->group_id,
                                        )
                                    );
                            }
                        }
                        // updating gender -->
                        if (isset($req->gender) && !isset($req->custom_gender)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'gender' => $req->gender,
                                    )
                                );
                        }
                        if (isset($req->custom_gender) && !isset($req->gender)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'custom_gender' => $req->custom_gender,
                                    )
                                );
                        }
                        if (isset($req->custom_gender) && isset($req->gender)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'custom_gender' => $req->custom_gender,
                                        'gender' => $req->gender,
                                    )
                                );
                        }
                        // Adding 3 entries in cycles table
                        // try {
                        //     // echo $req->user_id;
                        //     $symp1 = new cycles;
                        //     $symp1->user_id= $req->user_id;
                        //     $symp1->month_id = 1;
                        //     $symp1->cycle_start_date = $req->period_day;
                        //     $symp1->save();

                            // $symp2 = new cycles;
                            // $symp2->user_id= $req->user_id;
                            // $symp2->month_id = 2;
                            // $symp2->save();

                            // $symp3 = new cycles;
                            // $symp3->user_id= $req->user_id;
                            // $symp3->month_id = 3;
                            // $symp3->save();
                        // } catch (\Exception $exception) {
                        //     // $data['error'] = $exception->getMessage();
                        // }

                        // Updating pronoun
                        if (isset($req->pronoun_id) && !isset($req->custom_pronoun)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'pronoun_id' => $req->pronoun_id,
                                    )
                                );
                        }
                        if (isset($req->custom_pronoun) && !isset($req->pronoun_id)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'custom_pronoun' => $req->custom_pronoun,
                                    )
                                );
                        }
                        if (isset($req->pronoun_id) && isset($req->custom_pronoun)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'pronoun_id' => $req->pronoun_id,
                                        'custom_pronoun' => $req->custom_pronoun,
                                    )
                                );
                        }
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
// end of function


     // newly created
     function saveEnergy(Request $req)
    {

        try {

            $validator = Validator::make($req->all(), [

                'energy' => 'required',

                'date' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                // $symptoms_id = implode(",", $req->symptoms);
                $check = DB::table('user_symptoms')
                    ->where('user_id', $req->user_id)
                    ->where('date', $req->date)
                    ->count();

                if ($check > 0) {

                    DB::table('user_symptoms')
                        ->where('user_id', $req->user_id)
                        ->where('date', $req->date)
                        ->update(
                            array(
                                'emotions' => $req->emotions,
                                'energy' => $req->energy,
                                'date' => $req->date,
                            )
                        );
                } else {

                    $symp = new user_symptoms;
                    $symp->user_id= $req->user_id;

                    $symp->energy = $req->energy;

                    $symp->date = $req->date;
                    $symp->save();
                }
            }

            return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
    // end
     // newly created
    function getEnergy(Request $request)
    {
        $get_results = DB::table('user_symptoms')
            ->where('user_id', $request->user_id)
            ->where('date', $request->date)->count();
        if ($get_results > 0) {
            $where_data = array('user_id' => $request->user_id, 'date' => $request->date);
            $data = DB::table('user_symptoms')
                ->where($where_data)
                ->first();
            // dd($data->user_symptom_id);
            $new_data = array(

                'user_id' => $data->user_id,

                'energy' => $data->energy,

                'date' => $data->date
            );
        } else {
            return response()->json(['message' => 'No data found'], 200);
        }
        return response()->json(array('show_energy' => $new_data), 200);
    }
    // end
     // newly created function
    function showIs_pro(Request $req)
    {
        $data = DB::table('users')->where('user_id', $req->user_id)
            ->first();;
             $new_data = array(
                'is_pro' => $data->is_pro,
            );
        return response()->json(array('showIs_pro' => $new_data), 200);
    }
    // end
    // newly created
    function getTips(Request $req)
{
    $focus_ids = $req->input('focus_id');
    $energy_id = $req->input('energy_id');
    $sub_energy_id = $req->input('sub_energy_id');
    $category_id = $req->input('category_id');
    $language_id = $req->input('language_id');

    // Check if $focus_ids is an array
    if (is_array($focus_ids)) {
        $focus_ids = implode(',', $focus_ids);
    }

    // Check if $focus_ids is equal to 3
    if ($focus_ids === '3') {
        // Use a specific condition for focus_id equal to 3
        $data['tips'] = DB::table('tips')
            ->where('energy_id', $energy_id)
            ->where('sub_energy_id', $sub_energy_id)
            ->where('category_id', $category_id)
            ->where('language_id', $language_id)
            ->where('focus_id', "1,2")
            ->get();
    } else {
        // Use the original condition for other values of focus_id
        $focus_id = [$focus_ids];
        $data['tips'] = DB::table('tips')
            ->where('energy_id', $energy_id)
            ->where('sub_energy_id', $sub_energy_id)
            ->where('category_id', $category_id)
            ->where('language_id', $language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', [$focus_id])
            ->get();
    }

    return response()->json($data, 200);
}

    function showTips(Request $req)
{
    $focus_ids = $req->input('focus_id');
    $tip_id = $req->input('tip_id');
    $language_id = $req->input('language_id');

    // Check if $focus_ids is an array
    if (is_array($focus_ids)) {
        $focus_ids = implode(',', $focus_ids);
    }

    // Check if $focus_ids is equal to 3
    if ($focus_ids === '3') {
        // Use a specific condition for focus_id equal to 3
        $data = DB::table('tips')
            ->where('tip_id', $tip_id)
            ->where('language_id', $language_id)
            ->where('focus_id', "1,2")
            ->where('status', 1)
            ->get();
    } else {
        // Use the original condition for other values of focus_id
        $focus_id = [$focus_ids];
        $data = DB::table('tips')
            ->where('tip_id', $tip_id)
            ->where('language_id', $language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', [$focus_id])
            ->where('status', 1)
            ->get();
    }

    return response()->json(array('show_tips_detail' => $data), 200);
}





    // end
  // newly created
    public function getReminders($scheduled)
    {
        $data = DB::table('reminders')
            ->where('scheduled', $scheduled)
            ->where('status', 1)
            ->get();
        // echo $data;
        $data1 = [];
        $i = 0;
        for ($i = 0; $i < count($data); $i++) {
            $result = DB::table('users')
                ->where('user_id', $data[$i]->user_id)
                ->get();
            $result_count = DB::table('users')
                ->where('user_id', $data[$i]->user_id)
                ->count();

            if ($result_count > 0) {
                $new_data = array(
                    'r_type' => $data[$i]->r_type,
                    'user_id' => $data[$i]->user_id,
                    'period_day' => $result[0]->period_day,
                    'period_length' => $result[0]->average_cycle_length,
                    'fcm_token' => $data[$i]->fcm_token,
                );
                $data1[] = $new_data;
            }
        }
        return response()->json($data1, 200);

    }
    // end
    // newly created
    public function showReminders($user_id)
    {
        $data['reminders'] = DB::table('reminders')
            ->where('user_id', $user_id)
            ->get();
        // dd($data['tips']);
        return response()->json($data, 200);
    }
    // end
    // newly created
    public function saveReminders($status, $user_id, $r_type, $scheduled, $fcm_token)
    {
        try {
            $check = DB::table('reminders')
                ->where('user_id', $user_id)
                ->where('r_type', $r_type)
                ->count();
            if ($check > 0) {
                DB::table('reminders')
                    ->where('user_id', $user_id)
                    ->where('r_type', $r_type)
                    ->update(
                        array(
                            'user_id' => $user_id,
                            'scheduled' => $scheduled,
                            'status' => $status,
                            'r_type' => $r_type,
                            'fcm_token' => $fcm_token,
                        )
                    );
            } else {
                $symp = new reminders;
                $symp->user_id= $user_id;
                $symp->scheduled = $scheduled;
                $symp->status = $status;
                $symp->fcm_token = $fcm_token;
                $symp->r_type = $r_type;
                $symp->save();
                // echo $user_id;
            }
            return response()->json(['user_id' => $user_id, 'r_type' => $r_type], 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
    // end
    // newly created
    public function saveStatus($status, $user_id, $r_type)
    {
        try {
            $check = DB::table('reminders')
                ->where('user_id', $user_id)
                ->where('r_type', $r_type)
                ->count();
            if ($check > 0) {
                DB::table('reminders')
                    ->where('user_id', $user_id)
                    ->where('r_type', $r_type)
                    ->update(
                        array(
                            'status' => $status,
                        )
                    );
            } else {
                return response()->json(['message' => 'No reminder is Present'], 401);
            }
            // echo $user_id;

            return response()->json(['user_id' => $user_id, 'r_type' => $r_type], 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }
    // end
  // newly created function
    public function saveIs_pro(Request $req)
    {
        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'Is_pro' => $req->Is_pro,
                                )
                            );
        $data = DB::table('users')->where('user_id', $req->user_id)
            ->first();
        $new_data = array(
            'is_pro' => $data->is_pro,
        );
        return response()->json(array('ShowIs_pro' => $new_data), 200);
    }
    // end
     // newly created
    public function updatePeriod_day(Request $req)
    {

        try {
            $check = DB::table('cycles')
                ->where('user_id', $req->user_id)
                ->count();
            if ($check == 3) {
                $data = DB::table('cycles')
                    ->where('user_id', $req->user_id)
                    ->orderBy('month_id', 'asc')
                    ->get();
                // foreach ($data as $entry) {
                if ($data[1]->month_id == 2 && $data[1]->cycle_start_date === null) {

                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', $data[1]->month_id)
                        ->update(
                            array(
                                'cycle_start_date' => $req->period_day,
                            )
                        );
                    // echo "hello";

                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', $data[1]->month_id - 1)
                        ->update(
                            array(
                                'cycle_end_date' => $req->period_day,
                            )
                        );

                    // break;
                } else if ($data[2]->month_id == 3 && $data[2]->cycle_start_date === null) {
                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', $data[2]->month_id)
                        ->update(
                            array(
                                'cycle_start_date' => $req->period_day,
                            )
                        );
                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', $data[2]->month_id - 1)
                        ->update(
                            array(
                                'cycle_end_date' => $req->period_day,
                            )
                        );

                    // break;
                } else {
                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', 1)
                        ->update(
                            array(
                                'month_id' => -1,
                            )
                        );
                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', 2)
                        ->update(
                            array(
                                'month_id' => 1,
                            )
                        );
                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', 3)
                        ->update(
                            array(
                                'month_id' => 2,
                                'cycle_end_date' => $req->period_day,
                            )
                        );
                    DB::table('cycles')
                        ->where('user_id', $req->user_id)
                        ->where('month_id', -1)
                        ->update(
                            array(
                                'month_id' => 3,
                                'cycle_start_date' => $req->period_day,
                                'cycle_end_date' => null,
                            )
                        );
                }

                // }
                return response()->json(['Succuss' => 'updated Period date Successfully'], 200);
            } else {
                return response()->json(['error' => 'Something went wrong'], 401);
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }

    }
    // end
    // newly created
    public function getCycles($user_id)
    {
        $data = DB::table('cycles')
            ->where('user_id', $user_id)
            ->get();

        if(count($data) == 0) {
            $symp1 = new cycles;
            $symp1->user_id = $user_id;
            $symp1->month_id = 1;

            $user_data = DB::table('users')->where('user_id', $user_id)->first();
            
            if($user_data) {
                $symp1->cycle_start_date = $user_data->period_day;
                $symp1->cycle_end_date = date('Y-m-d', strtotime($user_data->period_day . ' + ' . $user_data->average_cycle_days . ' days'));
            }
            $symp1->save();
        }

        $newdata = DB::table('cycles')
            ->where('user_id', $user_id)
            ->get();

        return response()->json(array('cycles' => $newdata), 200);
    }
    // end

    function saveCountries(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->country_id) && !isset($req->group_id)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'country_id' => ['required'],
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    // country selection
                    if ($get_results > 0) {
                        if (isset($req->group_id) && isset($req->custom_group)) {
                            return response()->json(['message' => 'Please choose only one field'], 401);
                        } else {
                            if (isset($req->country_id)) {
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update(
                                        array(
                                            'country_id' => $req->country_id,
                                        )
                                    );
                            }

                            if (isset($req->group_id) && !isset($req->custom_group)) {
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update(
                                        array(
                                            'group_id' => $req->group_id,
                                        )
                                    );
                            }
                            if (isset($req->custom_group) && !isset($req->group_id)) {
                                DB::table('users')
                                    ->where('user_id', $req->user_id)
                                    ->update(
                                        array(
                                            'custom_group' => $req->custom_group,
                                        )
                                    );
                            }
                        }
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function saveName(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->name)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'name' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    if ($get_results > 0) {
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'name' => $req->name,
                                )
                            );
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function saveProfileImage(Request $req)
    {
        // dd($req->all());
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->image)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'image' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();

                    if ($get_results > 0) {
                        if (isset($req->image)) {
                            $profile = $req->image;
                            $file_name = $profile->getClientOriginalName();
                            $destinationPath = "storage/profiles";
                            $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $file_name);
                            $profile->move($destinationPath, $file_name_thumb);
                            $filename = $destinationPath . '/' . $file_name_thumb;
                        }
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'image' => $filename,
                                )
                            );
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function saveDob(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->dob)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'dob' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    if ($get_results > 0) {
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'dob' => $req->dob,
                                )
                            );
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function saveGender(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->gender) && !isset($req->custom_gender) && !isset($req->pronoun_id) && !isset($req->custom_pronoun)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $get_results = DB::table('users')
                    ->where('user_id', $req->user_id)
                    ->where('remember_token', $req->token)->count();
                if ($get_results > 0) {
                    if (isset($req->gender) && isset($req->custom_gender)) {
                        return response()->json(['message' => 'Please choose only one field'], 401);
                    } else if (!isset($req->gender) && !isset($req->custom_gender)) {
                        return response()->json(['message' => 'Please choose atleast one gender'], 401);
                    } else {
                        if (isset($req->gender) && !isset($req->custom_gender)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'gender' => $req->gender,
                                    )
                                );
                        }
                        if (isset($req->custom_gender) && !isset($req->gender)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'custom_gender' => $req->custom_gender,
                                    )
                                );
                        }
                    }
                    if (isset($req->pronoun_id) && isset($req->custom_pronoun)) {
                        return response()->json(['message' => 'Please choose only one field'], 401);
                    } else if (!isset($req->pronoun_id) && !isset($req->custom_pronoun)) {
                        return response()->json(['message' => 'Please choose atleast one pronoun'], 401);
                    } else {
                        if (isset($req->pronoun_id) && !isset($req->custom_pronoun)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'pronoun_id' => $req->pronoun_id,
                                    )
                                );
                        }
                        if (isset($req->custom_pronoun) && !isset($req->pronoun_id)) {
                            DB::table('users')
                                ->where('user_id', $req->user_id)
                                ->update(
                                    array(
                                        'custom_pronoun' => $req->custom_pronoun,
                                    )
                                );
                        }
                    }
                } else {
                    return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                }

                return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function saveLanguage(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->language_id)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'language_id' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    if ($get_results > 0) {
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'language_id' => $req->language_id,
                                )
                            );
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function saveCycleLength(Request $req)
    {
        if (!isset($req->user_id) && !isset($req->token) && !isset($req->average_cycle_length) && isset($req->dont_know_cycle_length)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        } else {
            if (isset($req->average_cycle_length)) {
                $average_cycle_length = $req->average_cycle_length;
            } else {
                $average_cycle_length = null;
            }
            $get_results = DB::table('users')
                ->where('user_id', $req->user_id)
                ->where('remember_token', $req->token)->count();
            if ($get_results > 0) {
                DB::table('users')
                    ->where('user_id', $req->user_id)
                    ->update(
                        array(
                            'average_cycle_length' => $average_cycle_length,
                        )
                    );
            } else {
                return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
            }
        }
        return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
    }

    function saveCycleDays(Request $req)
    {
        if (!isset($req->user_id) && !isset($req->token) && !isset($req->average_cycle_days) && isset($req->dont_know_cycle_days)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        } else {
            if (isset($req->average_cycle_days)) {
                $average_cycle_days = $req->average_cycle_days;
            } else {
                $average_cycle_days = null;
            }
            $get_results = DB::table('users')
                ->where('user_id', $req->user_id)
                ->where('remember_token', $req->token)->count();
            if ($get_results > 0) {
                DB::table('users')
                    ->where('user_id', $req->user_id)
                    ->update(
                        array(
                            'average_cycle_days' => $average_cycle_days,
                        )
                    );
            } else {
                return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
            }
        }
        return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
    }

    function saveFocus(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->focus_id)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'focus_id' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    if ($get_results > 0) {
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'focus_id' => $req->focus_id,
                                )
                            );
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function showLanguages()
    {

        $data['language'] = DB::table('languages')->get();
        // dd($data['language']);
        return response()->json(array('show_language' => $data), 200);
    }
    function showGroups()
    {

        $data = DB::table('groups')->where('status', 1)->get();
        return response()->json(array('show_groups' => $data), 200);
    }

    function showCountries()
    {

        $data['country'] = DB::table('countries')->get();
        // dd($data['country']);
        return response()->json(array('show_country' => $data), 200);
    }

    public function getAllCategories()
    {
        $data = DB::table('categories')
            ->where('status', 1)
            ->get();

        $myArray = array();
        foreach ($data as $value) {
            if (!isset($myArray[$value->parent_type])) {
                $myArray[$value->parent_type] = array();
            }
            $myArray[$value->parent_type][$value->category_name] = $value;
        }
        return response()->json($myArray, 200);
    }

    function showCategories()
    {
        $data['category'] = DB::table('categories')
            ->where('parent_type', 0)
            ->where('status', 1)
            ->get();
        return response()->json(array('show_category' => $data), 200);
    }

    function showAllCategories()
    {
        $data = DB::table('categories')
            ->where('status', 1)
            ->get();
        return response()->json(array('show_all_category' => $data), 200);
    }

    function showSubCategories($category_id)
    {
        // dd($category_id);
        $data = DB::table('categories')

            ->where('parent_type', $category_id)
            ->where('status', 1)
            ->get();
        return response()->json(array('show_sub_category' => $data), 200);
    }

    function showWisdomBlogs(Request $req)
    {
        $focus_ids = $req->input('focus_id');
        $category_id = $req->input('category_id');
        $language_id = $req->input('language_id');
        // if(is_array($req->focus_id)){
        //     $focus_id = implode(',',$req->focus_id);
        // }
        // $focus_id = [$focus_id];
        if ($focus_ids === 3) {
            // Use a specific condition for focus_id equal to 3
            $data = DB::table('blogs')
                ->where('category_id', $category_id)
                ->where('language_id', $language_id)
                ->where('focus_id', '1,2')
                ->get();
        } else {
            // Use the original condition for other values of focus_id
            // $focus_id = [$focus_ids];
            $data = DB::table('blogs')
                ->where('category_id', $category_id)
                ->where('language_id', $language_id)
                ->whereRaw('FIND_IN_SET(?, focus_id)', $focus_ids)
                ->get();
        }

        $newdata = array('show_wisdom_blogs' => $data);

        // for ($i = 0; $i < count($newdata); $i++) {
        //     $newdata[$i]['map'] = DB::table('blog_slides')
        //             ->where('blog_id', $newdata[$i]['blog_id'])
        //             ->get();
        // }

        // $result = DB::table('blogs')
        // ->join('blog_slides', 'blogs.blog_id', '=', 'blog_slides.blog_id')
        // ->select('blogs.*', 'blog_slides.*')
        // ->get();

        foreach ($newdata['show_wisdom_blogs'] as $blog) {
            $blog->map = DB::table('blog_slides')
                        ->where('blog_id', $blog->blog_id)
                        ->get();
        }

        // print_r($newdata['show_wisdom_blogs'][0]);

        return response()->json($newdata, 200);
    }

    function showWisdomPodcasts(Request $req)
{
    $focus_ids = $req->input('focus_id');
    $category_id = $req->input('category_id');
    $language_id = $req->input('language_id');

    // Check if $focus_ids is an array
    // if (is_array($focus_ids)) {
    //     $focus_ids = implode(',', $focus_ids);
    // }

    // Check if $focus_ids is equal to 3
    if ($focus_ids === 3) {
        // Use a specific condition for focus_id equal to 3
        $data = DB::table('podcasts')
            ->where('category_id', $category_id)
            ->where('language_id', $language_id)
            ->where('focus_id', '1,2')
            ->get();
    } else {
        // Use the original condition for other values of focus_id
        // $focus_id = [$focus_ids];
        $data = DB::table('podcasts')
            ->where('category_id', $category_id)
            ->where('language_id', $language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', $focus_ids)
            ->get();
    }

    return response()->json(array('show_wisdom_podcasts' => $data), 200);
}


    function showWisdomVideos(Request $req)
{
    $focus_ids = $req->input('focus_id');
    $category_id = $req->input('category_id');
    $language_id = $req->input('language_id');

    // Check if $focus_ids is an array
    // if (is_array($focus_ids)) {
    //     $focus_ids = implode(',', $focus_ids);
    // }

    // Check if $focus_ids is equal to 3
    if ($focus_ids === 3) {
        // Use a specific condition for focus_id equal to 3
        $data = DB::table('videos')
            ->where('category_id', $category_id)
            ->where('language_id', $language_id)
            ->where('focus_id', '1,2')
            ->get();
    } else {
        // Use the original condition for other values of focus_id
        // $focus_id = [$focus_ids];
        $data = DB::table('videos')
            ->where('category_id', $category_id)
            ->where('language_id', $language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', $focus_ids)
            ->get();
    }

    return response()->json(array('show_wisdom_videos' => $data), 200);
}


    function showUsers($user_id)
    {
        $data = DB::table('users')->where('user_id', $user_id)->get();
        return response()->json(array('show_user' => $data), 200);
    }

    function showAllTips()
    {
        $data = DB::table('tips')->where('status', 1)
            ->orderBy('tip_id', 'DESC')
            ->limit(5)
            ->get();
        return response()->json(array('show_latest_tips' => $data), 200);
    }



    function showTipsCategory($tip_id)
    {
        $data['tips'] = DB::table('tips')
            ->leftJoin('categories', 'tips.category_id', '=', 'categories.category_id')
            ->where('tips.tip_id', $tip_id)

            ->get();
        // dd($data['tips']);
        return response()->json(array('show_tips' => $data), 200);
    }

    function showTipsSubcategory($tip_id)
    {
        $data['tips'] = DB::table('tips')
            ->leftJoin('categories', 'tips.subcategory', '=', 'categories.category_id')
            ->where('tips.tip_id', $tip_id)
            ->where('categories.status', 1)
            ->where('tips.status', 1)
            ->get();
        // dd($data['tips']);
        return response()->json(array('show_tips_sub_categories' => $data), 200);
    }

    function showPodcast(Request $req)
{
    $focus_ids = $req->input('focus_id');
    $language_id = $req->input('language_id');

    // Check if $focus_ids is an array
    if (is_array($focus_ids)) {
        $focus_ids = implode(',', $focus_ids);
    }

    // Check if $focus_ids is equal to 3
    if ($focus_ids === '3') {
        // Use a specific condition for focus_id equal to 3
        $data = DB::table('podcasts')
            ->where('status', 1)
            ->where('language_id', $language_id)
            ->where('focus_id', '1,2')
            ->latest('podcast_id')
            ->limit(5)
            ->get();
    } else {
        // Use the original condition for other values of focus_id
        $focus_id = [$focus_ids];
        $data = DB::table('podcasts')
            ->where('status', 1)
            ->where('language_id', $language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', $focus_id)
            ->latest('podcast_id')
            ->limit(5)
            ->get();
    }

    return response()->json(array('show_latest_podcast' => $data), 200);
}

    function showPodcastSubcategory($podcast_id)
    {

        $data = DB::table('podcasts')
            ->leftJoin('categories', 'podcasts.subcategory_id', '=', 'categories.category_id')
            ->where('podcasts.podcast_id', $podcast_id)
            ->get();
        // dd($data);
        return response()->json(array('show_podcasts_sub_categories' => $data), 200);
    }

    function showVideosSubcategory($video_id)
    {

        $data = DB::table('videos')
            ->leftJoin('categories', 'videos.subcategory_id', '=', 'categories.category_id')
            ->where('videos.video_id', $video_id)
            ->where('categories.status', 1)
            ->where('videos.status', 1)
            ->get();
        // dd($data);
        return response()->json(array('show_videos_sub_categories' => $data), 200);
    }

    function showWisdomTips($category_id)
    {

        $data = DB::table('categories')
            ->leftJoin('tips', 'categories.category_id', '=', 'tips.category_id')
            ->where('categories.category_id', $category_id)
            ->where('categories.status', 1)
            ->where('tips.status', 1)
            ->get();
        // dd($data);
        return response()->json(array('show_videos_sub_categories' => $data), 200);
    }

    function showPrimaryEmotions()
    {
        $data = DB::table('mood_disorders')
            ->where('primary', 'primary')
            ->get();
        return response()->json(array('show_primary_emotions' => $data), 200);
    }

    function currentCycle($user_id)
    {
        $data['mood_disorders'] = DB::table('mood_disorders')
            ->where('primary', 'primary')
            ->where('status', 1)
            ->get();
        $records = array();
        foreach ($data['mood_disorders'] as $mood_disorder) {
            $user_symptoms_counts = DB::table('user_symptoms')
                ->where('user_id', $user_id)
                ->where('emotions', $mood_disorder->disorders_id)
                ->count();
            $records[$mood_disorder->name]['count'] = $user_symptoms_counts;
            // $records[$mood_disorder->disorders_id]['name'] = $mood_disorder->name;
        }

        return response()->json(array('show_current_cycle_emotions' => $records), 200);
    }

    function showTipsEnergy(Request $req)
    {
        if(is_array($req->focus_id)){
            $focus_id = implode(',',$req->focus_id);
        }else{
            $focus_id = $req->focus_id;
        }
        $focus_id = [$focus_id];
        $data['tips'] = DB::table('tips')
            ->where('energy_id', $req->energy_id)
            ->where('sub_energy_id', $req->sub_energy_id)
            ->where('language_id', $req->language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', [$focus_id])
            ->where('status', 1)
            ->get();
        return response()->json(array('show_tips_energy' => $data), 200);
    }

    function showcms()
    {
        $data['cms'] = DB::table('cms')->get();
        return response()->json(array('show_cms' => $data), 200);
    }
    function showSubEnergy()
    {
        $data = DB::table('sub_energies')->get();
        return response()->json(array('show_sub_energies' => $data), 200);
    }

    function aboutUs($id)
    {
        $data = DB::table('cms')->where('id', $id)->get();
        return response()->json(array('show_about_us' => $data), 200);
    }

    function privacySettings($id)
    {
        $data = DB::table('cms')->where('id', $id)->get();
        return response()->json(array('show_privacy_settings' => $data), 200);
    }

    function showSettings()
    {
        $data['settings'] = DB::table('settings')->get();
        return response()->json(array('show_settings' => $data), 200);
    }

    function showDisorders($disorders_type)
    {
        $data = DB::table('mood_disorders')->where('disorders_type', $disorders_type)
            ->where('status', 1)
            ->get();
        return response()->json(array('show_disorders' => $data), 200);
    }

    function showEnergy()
    {
        $data = DB::table('mood_disorders')->where('disorders_type', 4)
            ->where('status', 1)
            ->get();
        return response()->json(array('show_disorders' => $data), 200);
    }

    function showAllDisorders()
    {
        $data = DB::table('mood_disorders')->where('status', 1)
            ->get();
        return response()->json(array('show_all_disorders' => $data), 200);
    }

    function showRituals(Request $req)
    {
        // if(is_array($req->focus_id)){
        //     $focus_id = implode(',',$req->focus_id);
        // }else{
        //     $focus_id = $req->focus_id;
        // }
        //   $focus_id = [$focus_id];
        $data = DB::table('categories')
            ->where('parent_type', 33)
            ->where('status', 1)
            // ->where('language_id', $req->language_id)
            // ->whereRaw('FIND_IN_SET(?, focus_id)', [$focus_id])
            ->orderBy('category_id', 'DESC')
            ->limit(5)
            ->get();
        return response()->json(array('show_rituals' => $data), 200);
    }

    function showMoonPhases(Request $req)
    {
    $focus_ids = $req->input('focus_id');
    $language_id = $req->input('language_id');
    if (is_array($focus_ids)) {
        $focus_ids = implode(',', $focus_ids);
    }
    if ($focus_ids === '3') {
        $data = DB::table('moonphases')
            ->where('status', 1)
            ->where('language_id', $language_id)
            ->where('focus_id', "1,2")
            ->get();
    } else {
        $data = DB::table('moonphases')
            ->where('status', 1)
            ->where('language_id', $language_id)
            ->whereRaw('FIND_IN_SET(?, focus_id)', [$focus_ids])
            ->get();
    }

    return response()->json(array('show_moon_phases' => $data), 200);
}



    function updateUsers(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'name' => ['required'],
                'dob' => ['required'],
                'weight' => ['required'],
                'height' => ['required'],
                'description' => ['required'],
                'country_id' => ['required'],
                'focus_id' => ['required'],
                'language_id' => ['required'],
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                DB::table('users')->where('user_id', $req->user_id)->update(array(
                    'name' => $req->name,
                    'dob' => $req->dob,
                    'gender' => $req->gender,
                    'custom_gender' => $req->custom_gender,
                    'pronoun_id' => $req->pronoun_id,
                    'weight' => $req->weight,
                    'height' => $req->height,
                    'description' => $req->description,
                    'country_id' => $req->country_id,
                    'group_id' => $req->group_id,
                    'custom_group' => $req->custom_group,
                    'language_id' => $req->language_id,
                    'focus_id' => $req->focus_id,
                    'average_cycle_length' => $req->average_cycle_length,
                    'average_cycle_days' => $req->average_cycle_days,
                    'period_day' => $req->period_day,
                    'status' => 2,
                ));
            }
            return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 401);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function resetPassword($token)
    {
        return view('admin/forgetPasswordLink', ['token' => $token]);
    }

    function forgetPassword(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'email' => 'required',
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                $check = DB::table('users')
                    ->where('email', $req->email)
                    ->where('register_type', 2)
                    ->count();
                if ($check > 0) {
                    $token = Str::random(64);
                    DB::table('password_resets')->where('email', $req->email)->delete();
                    DB::table('password_resets')->insert([
                        'email' => $req->email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);
                    echo "passed 1";
                    Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($req) {

                        $message->to($req->email, "Rest Password");

                        $message->subject('Reset Password');

                    });
                } else {
                    return response()->json(['error' => ' We are unable to find any user linked with this email address. Please try again with registered email address.'], 401);
                }
                return response()->json(['success' => 'Forget password link has been sent to your email'], 200);
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

   function submitResetPasswordForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required'
    ]);
    $updatePassword = DB::table('password_resets')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])
        ->first();
    if (!$updatePassword) {
        return back()->withInput()->with('error', 'Invalid token!');
    }
    $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);
    DB::table('password_resets')->where(['email' => $request->email])->delete();


    echo '<script>alert("Your password has been changed!");</script>';

    // return redirect('/your-original-page')->with('message', 'Your password has been changed!');
}


    function updateUsersProfile(Request $req)
    {
        try {
            $get_results = DB::table('users')
                ->where('user_id', $req->user_id)
                ->where('remember_token', $req->token)->count();
            if ($get_results > 0) {
                if (isset($req->name)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'name' => $req->name,
                            )
                        );
                }
                if (isset($req->dob)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'dob' => $req->dob,
                            )
                        );
                }
                if (isset($req->gender)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'gender' => $req->gender,
                            )
                        );
                }
                if (isset($req->custom_gender)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'custom_gender' => $req->custom_gender,
                            )
                        );
                }
                if (isset($req->pronoun_id)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'pronoun_id' => $req->pronoun_id,
                            )
                        );
                }
                if (isset($req->custom_pronoun)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'custom_pronoun' => $req->custom_pronoun,
                            )
                        );
                }
                if (isset($req->weight)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'weight' => $req->weight,
                            )
                        );
                }
                if (isset($req->height)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'height' => $req->height,
                            )
                        );
                }
                if (isset($req->image)) {
                    $profile = $req->image;
                    $file_name = $profile->getClientOriginalName();
                    $destinationPath = "storage/profiles";
                    $file_name_thumb = time() . rand(100, 999) . str_replace(' ', '-', $file_name);
                    $profile->move($destinationPath, $file_name_thumb);
                    $filename = $destinationPath . '/' . $file_name_thumb;
                }
                if (isset($req->image)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'image' => $file_name,
                            )
                        );
                }
                if (isset($req->description)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'description' => $req->description,
                            )
                        );
                }
                if (isset($req->country_id)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'country_id' => $req->country_id,
                            )
                        );
                }
                if (isset($req->group_id)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'group_id' => $req->group_id,
                            )
                        );
                }
                if (isset($req->custom_group)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'custom_group' => $req->custom_group,
                            )
                        );
                }

                if (isset($req->focus_id)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'focus_id' => $req->focus_id,
                            )
                        );
                }
                if (isset($req->language_id)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'language_id' => $req->language_id,
                            )
                        );
                }
                if (isset($req->average_cycle_length)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'average_cycle_length' => $req->average_cycle_length,
                            )
                        );
                }
                if (isset($req->average_cycle_days)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'average_cycle_days' => $req->average_cycle_days,
                            )
                        );
                }
                if (isset($req->period_day)) {
                    DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->update(
                            array(
                                'period_day' => $req->period_day,
                            )
                        );
                }
            } else {
                return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
            }

            return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function changePassword(Request $req)
    {
        $old_pass = DB::table('users')->where('user_id', $req->user_id)->where('remember_token', $req->token)->first();
        if (!(Hash::check($req->get('currentpassword'), $old_pass->password))) {
            // The passwords matches
            return response()->json(['error' => 'Your current Password does not matches with the password!']);
        }
        if (strcmp($req->get('currentpassword'), $req->get('password')) == 0) {
            // Current password and new password same
            return response()->json(['error' => 'New Password cannot be same as your current password!']);
        }
        if (!isset($req->user_id) && !isset($req->token) && !isset($req->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        } else {
            $validator = Validator::make($req->all(), [
                'currentpassword' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {

                $updt = DB::table('users')->where('user_id', $req->user_id)->update(['password' => Hash::make($req->password)]);
            }
            return response()->json(['success' => 'Your password is changed successfully'], 200);
        }
    }

    function saveSymptoms(Request $req)
    {
        // echo "<pre>";
        // print_r($_POST);
        try {
            // $date = date('Y-m-d');
            // dd($date);
            $validator = Validator::make($req->all(), [
                'menstrual_flow' => 'required',
                'symptoms' => 'required',
                'emotions' => 'required',
                'energy' => 'required',
                'journal' => 'required',
                'date' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                $symptoms_id = implode(",", $req->symptoms);
                $check = DB::table('user_symptoms')
                    ->where('user_id', $req->user_id)
                    ->where('date', $req->date)
                    ->count();
                // dd($check);
                if ($check > 0) {
                    // dd($check);
                    DB::table('user_symptoms')
                        ->where('user_id', $req->user_id)
                        ->where('date', $req->date)
                        ->update(
                            array(
                                'menstrual_flow' => $req->menstrual_flow,
                                'symptoms' => $symptoms_id,
                                'emotions' => $req->emotions,
                                'energy' => $req->energy,
                                'journal' => $req->journal,
                                'date' => $req->date,
                            )
                        );
                } else {
                    // dd($req->all());
                    // dd($symptoms_id);
                    $symp = new user_symptoms;
                    $symp->user_id= $req->user_id;
                    $symp->menstrual_flow= $req->menstrual_flow;
                    $symp->symptoms = $symptoms_id;
                    $symp->emotions = $req->emotions;
                    $symp->energy = $req->energy;
                    $symp->journal = $req->journal;
                    $symp->date = $req->date;
                    $symp->save();
                }
            }

            return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function showSymptoms(Request $request)
    {
        $get_results = DB::table('user_symptoms')
            ->where('user_id', $request->user_id)
            ->where('date', $request->date)->count();
        if ($get_results > 0) {
            $where_data = array('user_id' => $request->user_id, 'date' => $request->date);
            $data = DB::table('user_symptoms')
                ->where($where_data)
                ->first();
            // dd($data->user_symptom_id);
            $new_data = array(
                'user_symptom_id' => $data->user_symptom_id,
                'user_id' => $data->user_id,
                'symptoms' => explode(",", $data->symptoms),
                'menstrual_flow' => $data->menstrual_flow,
                'emotions' => $data->emotions,
                'energy' => $data->energy,
                'journal' => $data->journal,
                'date' => $data->date
            );
        } else {
            return response()->json(['success' => 'No data found'], 200);
        }
        return response()->json(array('show_symptoms' => $new_data), 200);
    }

    function savePeriodDay(Request $req)
    {
        try {
            if (!isset($req->user_id) && !isset($req->token) && !isset($req->period_day)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            } else {
                $validator = Validator::make($req->all(), [
                    'period_day' => ['required']
                ]);
                if ($validator->fails()) {
                    $error = $validator->messages()->get('*');
                    return response()->json(['error' => $error]);
                } else {
                    $get_results = DB::table('users')
                        ->where('user_id', $req->user_id)
                        ->where('remember_token', $req->token)->count();
                    if ($get_results > 0) {
                        DB::table('users')
                            ->where('user_id', $req->user_id)
                            ->update(
                                array(
                                    'period_day' => $req->period_day,
                                )
                            );
                    } else {
                        return response()->json(['error' => 'Your token is expired ,Please check your token and user id'], 401);
                    }

                    return response()->json(['user_id' => $req->user_id, 'token' => $req->token], 200);
                }
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
        }
    }

    function showSymptomsBetweenDates(Request $req)
    {
        // dd($req->all());
        // if (!isset($req->user_id) && !isset($req->token)) {
        //     return response()->json(['message' => 'Invalid Credentials'], 401);
        // } else {
            $validator = Validator::make($req->all(), [
                'start_date' => 'required',
                'end_date' => 'required'
            ]);
            if ($validator->fails()) {
                $error = $validator->messages()->get('*');
                return response()->json(['error' => $error]);
            } else {
                // dd($req->start_date,$req->end_date);

                if ($req->start_date < $req->end_date) {
                    $data = DB::table('user_symptoms')
                        ->where('user_id', $req->user_id)
                        ->whereBetween('date', [$req->start_date, $req->end_date])
                        ->get();
                    // dd($data);
                } elseif ($req->start_date == $req->end_date) {
                    $data = DB::table('user_symptoms')
                        ->where('user_id', $req->user_id)
                        ->where('date', $req->start_date)
                        ->get();
                }
                return response()->json(array('show_symptoms' => $data), 200);
            }
        // }
    }


    function pushNotification(Request $req)
    {
        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';

        /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
        $api_key = 'AAAAnDbbGSs:APA91bETzd1DwTeNrOxXraWcfHUspim2GdcwQIECX-7fQQWzVAUexQPjYXgoBFWAsdRZfXY7zFsMYqgN1jwM1MK0np-MsaxZ7KY9HFm2vnidUCZ8ayFDO2NDJqihekejeXGEdHQ-1HGU ';

        $fields = array(
            'registration_ids' => array(
                $req->token
            ),
            'data' => array(
                "message" => $req->message
            )
        );

        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}
