
<x-header titletext="edit package"/>
<style>
    .checkbox-size {
        width: 20px;
       height: 17px;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Package</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Update Packages</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
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
            <form id="form1" class="form-horizontal" action="{{ '/update-package' }}" method="post">
                @csrf
                <input type="hidden" name="package_id" value="{{$packages->package_id}}">
                <section class="card">
                    <header class="card-header">
                        

                        <h2 class="card-title" style="text-align:center">Update Package</h2>
                    </header>
                    <div class="card-body">
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="package_title" value="{{old('package_title', $packages->package_title)}}"
                                    class="form-control" >
                                <span class="text-danger">
                                    @error('package_title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <textarea name="package_description" id="package_description"
                                    class="form-control" maxlength="255">{{old('package_description',$packages->package_description)}}</textarea>
                                <span class="text-danger">
                                    @error('package_description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Cost <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="number" value="{{old('price', $packages->price)}}" name="price" id="price"
                                    class="form-control" >
                                <span class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label"> Type
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="package_type" id="package_type" class="form-control select">
                                    <option value="">Choose Type</option>
                                    <option value="1" @if (old('package_type',$packages->type == 1)) selected @endif>Free
                                    </option>
                                    <option value="2" @if(old('package_type',$packages->type == 2)) selected @endif>Priemum
                                    </option>
                                </select>
                                <span class="text-danger">
                                    @error('package_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end mb-0 form-label select-label">Options <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="tip_enabled" name="tip_enabled" class="mx-2 checkbox-size"
                                value="1" @if(old('tip_enabled',$packages->tip_enabled==1)) checked @endif>
                            <label for="tip_enabled">Tips</label>
                            </div>
                            <div class=" col-sm-3 ">
                                <input type="checkbox" id="video" name="video_enabled" class="mx-2 checkbox-size"
                                value="1"  @if(old('video_enabled',$packages->video_enabled==1)) checked @endif>
                            <label for="video_enabled">Videos</label>
                            </div>

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label"></label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="blog_enabled" name="blog_enabled" value="1" class="mx-2 checkbox-size" @if(old('blog_enabled',$packages->blog_enabled==1)) checked @endif>
                                <label for="blog_enabled">Blogs</label>
                            </div>
                            <div class=" col-sm-3 ">
                                <input type="checkbox" id="podcast_enabled" name="podcast_enabled" value="1" class="mx-2 checkbox-size"  @if(old('podcast_enabled',$packages->podcast_enabled==1)) checked @endif>
                                <label for="podcast_enabled">Podcasts</label>
                            </div>
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label"></label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="movements_enabled" name="movements_enabled" value="1" class="mx-2 checkbox-size" @if(old('movements_enabled',$packages->movements_enabled==1)) checked @endif>
                                <label for="movements_enabled">Movements</label>
                            </div>
                            <div class=" col-sm-3 ">
                                <input type="checkbox" id="log_sharing_enabled" name="log_sharing_enabled"
                                value="1" class="mx-2 checkbox-size" @if(old('log_sharing_enabled',$packages->log_sharing_enabled==1)) checked @endif>
                            <label for="log_sharing_enabled">Log Sharing</label>
                            </div>
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label"></label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="cycle_length_report_enabled"
                                name="cycle_length_report_enabled" value="1" class="mx-2 checkbox-size" @if(old('cycle_length_report_enabled',$packages->cycle_length_report_enabled==1)) checked @endif>
                            <label for="cycle_length_report_enabled">Cycle Length Report</label>
                            </div>
                            <div class=" col-sm-3 ">
                                <input type="checkbox" id="mood_report_enabled" name="mood_report_enabled"
                                value="1" class="mx-2 checkbox-size"  @if(old('mood_report_enabled',$packages->mood_report_enabled==1)) checked @endif>
                            <label for="mood_report_enabled">Mood Report</label>
                            </div>
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label"></label>
                            <div class="col-sm-3">
                               
                                <input type="checkbox" id="energy_report_enabled" name="energy_report_enabled"
                                    value="1" class="mx-2 checkbox-size" @if(old('energy_report_enabled',$packages->energy_report_enabled==1)) checked @endif>
                                <label for="energy_report_enabled">Energy Report</label>
                            </div>
                            <div class=" col-sm-3 ">
                                <input type="checkbox" id="general_report_enabled" name="general_report_enabled"
                                value="1" class="mx-2 checkbox-size" @if(old('general_report_enabled',$packages->general_report_enabled==1)) checked @endif>
                            <label for="general_report_enabled">General Report</label>
                            </div>
                            @if(session('msg'))
                            <span class="text-danger text-center col-12">
                             {{session('msg')}}
                            </span>
                            @endif
                        </div>



                        {{-- <div class="form-group row my-2">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Package Validity (in days)   </label>
                            <div class="col-sm-6">
                                <select name="package_expiry" id="package_expiry" class="form-control">
                                  <option value="">Choose Days</option>
                                  @for($i=1;$i<=365;$i++)
                                  <option value="{{$i}}"  @if ($packages->package_expiry == $i) selected @endif>{{$i}} Days</option>
                                  @endfor
                                </select>
                                <span class="text-danger">
                                    @error('package_expiry')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div> --}}
                        <div class="form-group row my-2">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Validity (in days)  <span class="text-danger">*</span> </label>
                            <div class="col-sm-6">
                                <input type="number" name="package_expiry" id="package_expiry"  min="1" max="365"  value="{{old('package_expiry',$packages->package_expiry)}}" class="form-control">
                                 
                                <span class="text-danger">
                                    @error('package_expiry')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control" >
                                    <option value="">Choose Status</option>
                                    <option value="1" @if (old('status',$packages->status == 1)) selected @endif>Active
                                    </option>
                                    <option value="2" @if (old('status',$packages->status == 1)) selected @endif>In-Active
                                    </option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update</button>
                        {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                    </footer>
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>
    </div>
    <x-footer />
