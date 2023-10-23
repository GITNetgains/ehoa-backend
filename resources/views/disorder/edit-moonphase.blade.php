<x-header titletext="Create Moon Phase"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Moon Phase Update</span></li>
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
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <section class="card">

        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/update-moonphase'}}" method="post">
                @csrf

                <section class="card">

                    <header class="card-header">
                        
                        <h2 class="card-title" style="text-align:center">Update Moon-Phases</h2>
                    </header>
                    <div class="card-body">
                      <input type="hidden" name="id" value="{{$moonphases->moon_phase_id}}">
                    <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2"> Name <span class="text-danger">*</span> </label>
                            <div class="col-sm-6">
                                <input type="text" name="moon_phases_name" id="moon_phases_name" value="{{old('moon_phases_name',$moonphases->moon_phases_name)}}"  class="form-control" >
                                <span class="text-danger">
                                    @error('moon_phases_name')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                            
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Short Description <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <textarea type="text" name="short_description" id="short_description" value=""  class="form-control" >{{old('short_description',$moonphases->short_description)}}</textarea>
                            <span class="text-danger">
                                @error('short_description')
                                {{$message}}
                            @enderror
                            </span>
                           
                        </div>
                    </div>
                     <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2"> Long Description <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <textarea type="text" name="long_description" id="long_description" value=""  class="form-control" >{{old('long_description',$moonphases->long_description)}}</textarea>
                            <span class="text-danger">
                                @error('long_description')
                                {{$message}}
                            @enderror
                            </span>
                           
                        </div>
                    </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Focus  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="focus_id[]" multiple id="focus_id" class="form-control select"  required>  
                                        <option value="1" @if(in_array(1, explode(',', $moonphases->focus_id))) selected @endif >Track menstrual cycle</option>
                                        <option value="2" @if(in_array(2, explode(',', $moonphases->focus_id))) selected @endif>Track energy levels</option>
                                    </select>
                                    <span class="text-danger">
                                    @error('focus_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                         <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Language<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="language_id" id="language_id" class="form-control select"  required>  
                                
                                        <option value="1" @if(old('language_id',$moonphases->language_id == 1)) selected @endif >English</option>
                                        <option value="2" @if(old('language_id',$moonphases->language_id == 2)) selected @endif>Māori</option>
                                         
                                    </select>
                                    <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2"> Icon <span class="text-danger">*</span> </label>
                            <div class="col-sm-6">
                                <input class="form-control" value="{{ old('icon')}}" type="file" name="icon" >
                                <span class="text-danger">
                                    @error('icon')
                                    {{$message}}
                                @enderror
                                </span>
                                <image class="my-3" src="{{env('APP_URL')}}/{{old('icon',$moonphases->icon)}}" alt="" style="height:58px;border-radius:6px;background-color:#000;">
                            </div>
                        </div>
                       
                        <div class="form-group row mb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control" value="" id="status" name="status" required>
                                            <option value="">choose status</option>
                                            <option value="1" @if(old('status',$moonphases->status == 1)) selected @endif >Active</option>
                                            <option value="2" @if(old('status',$moonphases->status == 2)) selected @endif >In-Active</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
                            </div>

                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update</button>

                    </footer>
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>

    </div>
<x-footer/>

