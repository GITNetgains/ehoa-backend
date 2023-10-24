<x-header titletext="push notifications" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Push Notification </h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Push Notification</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
    @endif  
    <section class="card">
        <div class="col-lg-12">
            <header class="card-header">
                
                <h2 class="card-title" style="text-align:center;">Push Notifications Create</h2>
            </header>
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-push-notifications'}}" method="post">
                @csrf
                <section class="card">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                                <span class="text-danger">
                                    @error('title')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <textarea name="description" id="description" value="" class="form-control" placeholder="">{{ old('description') }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                           <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Language <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="language_id" id="language_id" value="{{ old('language_id')}}" class="form-control select" >
                                    <option value="">Choose Language</option>
                                    <option value="1" @if( old('language_id')==1) selected @endif>English</option>
                                    <option value="2" @if( old('language_id')==2) selected @endif>Māori</option>
                                </select>
                                <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                         <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Gender <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="gender_id[]" multiple  id="gender_id" value="{{ old('gender_id')}}" class="form-control select" >
                                    <option value="">Choose Gender</option>
                                    <option value="1" @if( old('gender_id')==1) selected @endif>Male</option>
                                    <option value="2" @if( old('gender_id')==2) selected @endif>Female</option>
                                    <option value="3" @if( old('gender_id')==3) selected @endif>Other</option>
                                </select>
                                <span class="text-danger">
                                    @error('gender_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Focus <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="focus_id[]" multiple  id="focus_id" value="{{ old('focus_id[]')}}" class="form-control select" >
                                    <option value="">Choose focus</option>
                                    <option value="1" @if( old('focus_id')==1) selected @endif>Track Menstrual cycle</option>
                                    <option value="2" @if( old('focus_id')==2) selected @endif>Track energy levels</option>
                                </select>
                                <span class="text-danger">
                                    @error('focus_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Type <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="type" id="type" class="form-control select">
                                    <option value="0" selected>Choose Type</option>
                                    <option value="1" @if(old('type')==1) selected @endif >Blog</option>
                                    <option value="2" @if(old('type')==2) selected @endif>Journal</option>
                                    <option value="3" @if(old('type')==3) selected @endif>Ritual</option>
                                    <option value="4" @if(old('type')==4) selected @endif>Podcast</option>
                                    <option value="5" @if(old('type')==5) selected @endif>Tip</option>
                                    <option value="6" @if(old('type')==6) selected @endif>Promotion</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">All Users <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="checkbox" name="users_id" id="users_id" value="0" class="form-control-checked checkbox" >
                                <span class="text-danger">
                                    @error('user_id')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3 ">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Users <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control " id="user_id" name="user_id[]" multiple>
                                  
                                    @isset($users)
                                    @foreach($users as $user)
                                    <option value="{{$user->user_id}}">
                                        {{$user->name}}
                                    </option>
                                    @endforeach
                                    @endisset
                                </select>
                                <span class="text-danger " style="font-size:13px;"><i>To add multiusers, press Ctrl+Alt key</i></span>
                                <span class="text-danger">
                                    @error('user_id')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-6">

                                <select name="status" id="status" class="form-control select">

                                    <option value="" >Choose Status</option>
                                    <option value="1" @if(old('status')==1) selected @endif>Active</option>
                                    <option value="2"  @if(old('status')==2) selected @endif>In-Active</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Image <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control">
                                <span class="text-danger">
                                    @error('image')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Start Date <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control">
                                <span class="text-danger">
                                    @error('date')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Time <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="time" name="time" id="time" value="{{ old('time') }}" class="form-control">
                                <span class="text-danger">
                                    @error('time')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Expiry Date <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" class="form-control">
                                <span class="text-danger">
                                    @error('expiry_date')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button class="btn btn-primary" id="btn" type="submit">Create</button>
                        </footer>
                </section>
            </form>
        </div>

        {{-- end here  --}}

    </section>

    {{----start podcast----}}



    </div>

    <x-footer />

    <script type="text/javascript">


$(".checkbox").click(function() {
    
    if($(this).is(":checked")) {
$('#user_idoption').prop('selected', true);

    } else {
        $('#user_idoption').prop('selected', false);
    }
});
        
        </script>