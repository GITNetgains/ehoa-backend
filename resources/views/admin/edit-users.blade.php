<x-header titletext="edit users" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Update User</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Edit Status</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <style>
        
    </style>
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <div class="col-lg-12 m-auto mb-2">

        <section class="card">
            <header class="card-header">


                <h2 class="card-title" style="text-align:center"> Status Update</h2>
            </header>


            <form id="form1" class="form-horizontal" action="{{ '/update-users' }}" method="post">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="user_id" value="{{ $olddata->user_id }}">

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{old('name',$olddata->name)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Email <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="email" id="email" class="form-control"
                            value="{{old('email',$olddata->email)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">DOB <span class="required">*</span></label>
                        <div class="col-sm-6">
                            @php $date= date('Y'); @endphp
                            <input type="number" value="{{old('dob',$olddata->dob)}}" min="1900" max="{{ $date }}"
                                id="dob" class="form-control" name="dob" autocomplete="off">
                            <span class="text-danger">
                                @error('dob')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Gender</label>
                        <div class="col-sm-6 ">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="2" @if ($olddata->gender == 2) checked @endif>
                                <label class="form-check-label" for="gender">Takatapuri</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="3" @if ($olddata->gender == 3) checked @endif>
                                <label class="form-check-label" for="gender">Non-binary</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="4" @if ($olddata->gender == 4) checked @endif>
                                <label class="form-check-label" for="gender">Gender-fluid</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="5" @if ($olddata->gender == 5) checked @endif>
                                <label class="form-check-label" for="gender">Inter Sex</label>
                            </div>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="1" @if ($olddata->gender == 1) checked @endif>
                                <label class="form-check-label" for="gender"> Female</label>
                            </div>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input male" type="radio" name="gender" id="gender"
                                    value="6" @if ($olddata->gender == 6) checked @endif>
                                <label class="form-check-label" for="gender">&nbsp;Male</label>
                            </div>
                            {{-- <div class="form-check form-check-inline other">
                                <input class="form-check-input other" type="radio" name="gender" id="gender"
                                    value="other" >
                                <label class="form-check-label" for="gender"> Other</label>
                            </div> --}}


                            @error('gender')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3 custom_gender">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Custom Gender  </label>
                        <div class="col-sm-6">
                            <input type="text" name="custom_gender" id="custom_gender" class="form-control "
                            value="{{$olddata->custom_gender}}" autocomplete="off">
                            <span class="text-danger">
                                @error('custom_gender')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">User Notification <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <select name="user_notification_status" class="form-control">
                                <option value="">Choose Notification</option>
                                <option value="1" @if ($olddata->user_notification_status == 1) selected @endif>Yes</option>
                                <option value="2" @if ($olddata->user_notification_status == 2) selected @endif>No
                                </option>
                            </select>

                            <span class="text-danger">
                                @error('user_notification_status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="required">*</span></label>
                        <div class="col-sm-6 ">
                            <select name="status" class="form-control" >
                                <option value="">Choose Status</option>
                                <option value="1" @if($olddata->status == 1) selected @endif>Active
                                </option>
                                <option value="2" @if($olddata->status == 2) selected @endif>In-active
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Pronouns </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="pronoun_name" name="pronoun_name">
                                <option value="">Choose Pronoun</option>
                                @isset($pronouns)
                                    @foreach ($pronouns as $pron)
                                        <option value="{{ $pron->pronoun_id }}"
                                            @if ($olddata->pronoun_id == $pron->pronoun_id) selected @endif>
                                            {{ $pron->pronoun }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            <span class="text-danger">
                                @error('pronoun_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Create Pronoun </label>
                        <div class="col-sm-6">
                            <input type="text" name="custom_pronoun" id="custom_pronoun" class="form-control"
                            value="{{old('custom_pronoun',$olddata->custom_pronoun)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('custom_pronoun')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Weight</label>
                        <div class="col-sm-6">
                            <input type="number" name="weight" id="weight" class="form-control"
                            value="{{old('weight',$olddata->weight)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Height</label>
                        <div class="col-sm-6">
                            <input type="number" name="height" id="height" value="{{old('height',$olddata->height)}}"
                                class="form-control" autocomplete="off">
                            <span class="text-danger">
                                @error('height')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Profile</label>
                        <div class="col-sm-6">
                            <input type="file" name="image" id="image" value="{{old('image',$olddata->image)}}"
                                class="form-control" accept="image/*">
                            <span class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                            <img class="my-3" src="{{ $olddata->image }}" alt=""
                                style="height:58px;border-radius:6px;">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <textarea type="text" name="description"  id="description" class="form-control">{{old('description',$olddata->description)}}</textarea>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Country Name <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" id="country_id" name="country_id">
                                <option value="">Choose Country</option>
                                @isset($country)
                                    @foreach ($country as $country)
                                        <option value="{{old('country_id',$country->country_id)}}"
                                            @if ($olddata->country_id == $country->country_id) selected @endif>
                                            {{ $country->country_name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            <span class="text-danger">
                                @error('country_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Select Group </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="group_id" name="group_id">
                                <option value="">Choose Groups</option>
                                @isset($groups)
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->g_id }}"
                                            @if ($olddata->group_id == $group->g_id) selected @endif>
                                            {{ $group->group_name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            <span class="text-danger">
                                @error('group_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Create Group </label>
                        <div class="col-sm-6">
                            <input type="text" name="custom_group" id="custom_group"
                            value="{{old('custom_group',$olddata->custom_group)}}" class="form-control" autocomplete="off">
                            <span class="text-danger">
                                @error('custom_group')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end ">I Agree to the terms of Services <span class="required">*</span></label>
                        <div class="col-sm-2">
                            <input type="checkbox" name="is_term" id="is_term" value="1"
                                @if ($olddata->is_term == 1) checked @endif autocomplete="off">
                            <span class="text-danger">
                                @error('is_term')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                    <label class="col-sm-4 control-label text-sm-end ">I Understand that my data will not be sold    <span class="required">*</span></label>
                        <div class="col-sm-2">
                            <input type="checkbox" name="is_understand" id="is_understand" value="1"
                                @if ($olddata->is_understand == 1) checked @endif autocomplete="off">
                            <span class="text-danger">
                                @error('is_understand')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end ">Data Security Accepted <span class="required">*</span></label>
                        <div class="col-sm-2">
                            <input type="checkbox" name="data_security_accepted" value="1"
                                @if ($olddata->data_security_accepted == 1) checked @endif id="data_security_accepted"
                                autocomplete="off">
                            <span class="text-danger">
                                @error('data_security_accepted')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end ">Social <span class="required">*</span></label>
                        <div class="col-sm-2">
                            <input type="checkbox" name="is_social" id="is_social" value="1"
                                @if ($olddata->is_social == 1) checked @endif autocomplete="off">
                            <span class="text-danger">
                                @error('is_social')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Google Synced Status <span class="required">*</span></label>
                        <div class="col-sm-6 smart">
                            <input type="radio"  class="yes" name="google_cal_synced_status" id="google_cal_synced_status"
                                value="1" @if ($olddata->google_cal_synced_status == 1) checked @endif>
                            <label for="yes">Yes</label>&nbsp&nbsp&nbsp
                            <input type="radio" class="no" name="google_cal_synced_status" id="google_cal_synced_status"
                                value="0" @if ($olddata->google_cal_synced_status == 0) checked @endif>
                            <label for="no">No</label><br>
                            <span class="text-danger">
                                @error('google_cal_synced_status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Focus<span class="required">* </span></label>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="focus_id" id="focus_id"
                                    value="0" @if ($olddata->focus_id == 0) checked @endif>
                                <label class="form-check-label" for="focus_id">Tracking my menstrual cycle with
                                    maramataka(the mauri lunar
                                    calender)</label>
                            </div>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input " type="radio" name="focus_id" id="focus_id"
                                    value="1" @if ($olddata->focus_id == 1) checked @endif>
                                <label class="form-check-label" for="focus_id">Tracking my energy levels with
                                    maramataka</label>
                            </div><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="focus_id" id="focus_id"
                                    value="2" @if ($olddata->focus_id == 2) checked @endif>
                                <label class="form-check-label" for="focus_id">Both</label>
                            </div>
                            @error('focus_id')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>
                    </div>
                   
                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Language <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" id="language_id" name="language_id">
                                <option value="">Choose Language</option>
                                @isset($language)
                                    @foreach ($language as $lang)
                                        <option value="{{ $lang->language_id }}"
                                            @if ($olddata->language_id == $lang->language_id) selected @endif>
                                            {{ $lang->langauge_name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            <span class="text-danger">
                                @error('language_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Period Day <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="date" name="period_day" id="period_day"
                                class="form-control" value="{{old('period_day',$olddata->period_day)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('period_day')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Average Cycle Length <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" name="average_cycle_length" class="form-control"
                                id="average_cycle_length" min="1" max="30"
                                value="{{old('average_cycle_length',$olddata->average_cycle_length)}}">

                            <span class="text-danger">
                                @error('average_cycle_length')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Average Cycle Days <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" min="1" max="7" class="form-control"
                                name="average_cycle_days" value="{{old('average_cycle_days',$olddata->average_cycle_days)}}"
                                autocomplete="off">

                            <span class="text-danger">
                                @error('average_cycle_days')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Package Expiry Date <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="date" name="package_expiry_date" id="package_expiry_date"
                                class="form-control" value="{{old('package_expiry_date',$olddata->package_expiry_date)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('package_expiry_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Package Start Date <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="date" name="package_start_date" id="package_start_date"
                                class="form-control" value="{{old('package_start_date',$olddata->package_start_date)}}" autocomplete="off">
                            <span class="text-danger">
                                @error('package_start_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
            </form>
            <footer class="card-footer text-end">
                <button class="btn btn-primary" type="submit">Update</button>

            </footer>

        </section>
    </div>
</section>
</div>
<x-footer />
{{-- <script type="text/javascript">

$(".custom_gender").hide();
    
    $(document).ready(function(){
        $("input[type='radio']").click(function(){
            var radioValue = $("input[name='gender']:checked").val();
            if(radioValue == 'other'){
               
                $(".custom_gender").show();
            }
            else{
                $(".custom_gender").hide();
            }
        });
    });
  
            
            </script> --}}