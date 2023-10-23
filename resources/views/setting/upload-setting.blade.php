<x-header titletext="Uploads Settings"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<style>
.myDiv{
	display:none;
    padding:10px;
    margin-top:20px;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>File Setting</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Setting</span></li>
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
    <div class="col-lg-12">

            <section class="card">
                <header class="card-header">
                    <h2 class="card-title" style="text-align:center;">Image Upload Setting</h2>
                </header>
               
<form id="form" class="form-horizontal" action="{{'/admin/save-upload-setting'}}" method="post">
           @csrf
              <div class="form-group row mt-3 pb-3">
            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Set Any One Setting Update: </label>
            <div class="col-sm-6">
                <select name="setting" id="setting" class="form-control select" >
                <option value="0" id="s1" >Choose Setting </option>
                <option value="podcast" id="s1" >Podcast </option>
                <option value="blogs" id="s1" >Blogs</option>
                <option value="videos" id="s1" >Videos </option>
                <option value="tips" id="s1" >Tips</option>
                {{-- <option value="yogas" id="s1" >Yogas</option> --}}
            </select>
                    <span class="text-danger">
                    @error('setting')
                    {{$message}}
                @enderror
                </span>
            </div>
        </div>
                <div id="showpodcast" class="myDiv">

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2"> Upload Image Size : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_image_size]" value="{{$bind_settings['podcast_image_size']}}" class="form-control" autocomplete="off" required>

                            </div>
                            <label class="col-sm-2 control-label text-sm-end pt-2">Upload Image Extension : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_image_extension]" value="{{$bind_settings['podcast_image_extension']}}"class="form-control" autocomplete="off" required>

                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2">Image Width : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_image_width]" value="{{$bind_settings['podcast_image_width']}}" class="form-control" autocomplete="off" required>

                            </div>
                            <label class="col-sm-2 control-label text-sm-end pt-2">Image Height : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_image_height]" value="{{$bind_settings['podcast_image_height']}}"class="form-control" autocomplete="off" required>

                            </div>
                        </div>
                        {{-- <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2"> Upload video Size : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_video_size]" value="{{$bind_settings['podcast_video_size']}}"class="form-control" autocomplete="off" required>
                            </div>
                            <label class="col-sm-2 control-label text-sm-end pt-2">Upload Video Extension : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_video_extension]" value="{{$bind_settings['podcast_video_extension']}}"class="form-control" autocomplete="off" required>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2">Video Width : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_video_width]" value="{{$bind_settings['podcast_video_width']}}"class="form-control" autocomplete="off" required>
                            </div>
                            <label class="col-sm-2 control-label text-sm-end pt-2">Video Height : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_video_height]" value="{{$bind_settings['podcast_video_height']}}"class="form-control" autocomplete="off" required>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2">Video Length : </label>
                            <div class="col-sm-4">
                                <input type="text" name="setting[podcast_video_length]" value="{{$bind_settings['podcast_video_length']}}"class="form-control" autocomplete="off" required>
                            </div>

                        </div> --}}
                    </div>

                <div id="showblogs" class="myDiv">
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload Image Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_image_size]" value="{{$bind_settings['blogs_image_size']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Image Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_image_extension]" value="{{$bind_settings['blogs_image_extension']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_image_width]" value="{{$bind_settings['blogs_image_width']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_image_height]" value="{{$bind_settings['blogs_image_height']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    {{-- <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload video Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_video_size]" value="{{$bind_settings['blogs_video_size']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Video Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_video_extension]" value="{{$bind_settings['blogs_video_extension']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_video_width]" value="{{$bind_settings['blogs_video_width']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_video_height]" value="{{$bind_settings['blogs_video_height']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Length : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[blogs_video_lenght]" value="{{$bind_settings['blogs_video_lenght']}}"class="form-control" autocomplete="off" required>
                        </div>

                    </div> --}}
                </div>
                {{-- -----3------video--- --}}
                <div id="showvideos" class="myDiv">
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload Image Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[video_image_size]" value="{{$bind_settings['video_image_size']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Image Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[video_image_extension]" value="{{$bind_settings['video_image_extension']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[vedio_image_width]" value="{{$bind_settings['vedio_image_width']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[video_image_height]" value="{{$bind_settings['video_image_height']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload video Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[vedio_vedio_size]" value="{{$bind_settings['vedio_vedio_size']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Video Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[vedio_vedio_extension]" value="{{$bind_settings['vedio_vedio_extension']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[vedio_vedio_width]" value="{{$bind_settings['vedio_vedio_width']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[vedio_vedio_height]" value="{{$bind_settings['vedio_vedio_height']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Length : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[vedio_vedio_length]" value="{{$bind_settings['vedio_vedio_length']}}"class="form-control" autocomplete="off" required>
                        </div>

                    </div>
                </div>
                {{-- -----4 tips--- --}}
                <div id="showtips" class="myDiv">
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload Image Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_image_size]" value="{{$bind_settings['tips_image_size']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Image Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_image_extension]" value="{{$bind_settings['tips_image_extension']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_image_width]" value="{{$bind_settings['tips_image_width']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_image_height]" value="{{$bind_settings['tips_image_height']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    {{-- <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload video Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_vedio_size]" value="{{$bind_settings['tips_vedio_size']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Video Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_video_extension]" value="{{$bind_settings['tips_video_extension']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_video_width]" value="{{$bind_settings['tips_video_width']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_video_height]" value="{{$bind_settings['tips_video_height']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Length : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[tips_vedio_length]" value="{{$bind_settings['tips_vedio_length']}}"class="form-control" autocomplete="off" required>
                        </div>

                    </div> --}}
                </div>
                 {{-- -----3-Yogas--- --}}
                 {{-- <div id="showyogas" class="myDiv">
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload Image Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_image_size]" value="{{$bind_settings['yogas_image_size']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Image Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_image_extension]" value="{{$bind_settings['yogas_image_extension']}}" class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_image_width]" value="{{$bind_settings['yogas_image_width']}}" class="form-control" autocomplete="off" required>

                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Image Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_image_height]" value="{{$bind_settings['yogas_image_height']}}"class="form-control" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2"> Upload video Size : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_video_size]" value="{{$bind_settings['yogas_video_size']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Upload Video Extension : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_video_extension]" value="{{$bind_settings['yogas_video_extension']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Width : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_video_width]" value="{{$bind_settings['yogas_video_width']}}"class="form-control" autocomplete="off" required>
                        </div>
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Height : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_video_height]" value="{{$bind_settings['yogas_video_height']}}"class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-2 control-label text-sm-end pt-2">Video Length : </label>
                        <div class="col-sm-4">
                            <input type="text" name="setting[yogas_video_length]" value="{{$bind_settings['yogas_video_length']}}"class="form-control" autocomplete="off" required>
                        </div>

                    </div>
                </div> --}}
                <footer class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </footer>
            </form>
            </section>

    </div>

    {{-- end here  --}}
</section>
</div>
<script>
$(document).ready(function(){
    $('#setting').on('change', function(){
    	var demovalue = $(this).val();
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
</script>
<x-footer />



