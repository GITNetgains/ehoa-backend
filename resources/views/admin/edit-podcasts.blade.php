<x-header titletext="Update podcast"/>
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
                <li><span>Podcast Update</span></li>
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
            <form id="form" class="form-horizontal" enctype="multipart/form-data" action="{{'/update-podcasts'}}" method="post">
                @csrf

                <section class="card">
                    <header class="card-header">
                        
                        <h2 class="card-title" style="text-align:center">Update Podcast</h2>
                    </header>
                    <div class="card-body">
                        @foreach($podcasts as $podc)

                        <input type="hidden" name="id" value="{{$podc->podcast_id}}">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2"> Name <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" placeholder="Maximum limit of the characters 30" name="title" id="title" value="{{old('title',$podc->title)}}"  class="form-control" >
                                <span class="text-danger">
                                    @error('title')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"  id="category_id" name="category_id">
                                        @isset($category)
                                        @foreach($category as $categ)
                                        <option value="{{$categ->category_id}}" @if($podc->category_id == $categ->category_id) selected @endif >
                                        {{$categ->category_name}}
                                        </option>
                                        @endforeach
                                        @endisset
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                      {{--  <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"  id="subcategory_id" name="subcategory_id">
                                    <option value="{{$sub_category->category_id}}">{{$sub_category->category_name}}</option>
                            </select>
                            <span class="text-danger">
                                @error('subcategory_id')
                                {{$message}}
                            @enderror
                            </span>
                            </div>
                        </div> --}}
                    
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Short Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <textarea type="text" placeholder="Maximum limit of the characters 250" name="description" id="description"  class="form-control" >{{old('description',$podc->description)}}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                      {{--  <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">File Url </label>
                            <div class="col-sm-6">
                                <input type="text" name="file_url" id="file_url" value="{{old('file_url',$podc->file_url)}}"  class="form-control" accept="image/*">
                                <span class="text-danger">
                                    @error('file_url')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div> --}}
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Audio Url </label>
                            <div class="col-sm-6">
                                <input type="text" name="audio_url" id="audio_url" value="{{old('audio_url',$podc->audio_url)}}"  class="form-control" accept="image/*">
                                <span class="text-danger">
                                    @error('audio_url')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Gender  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="gender_id[]" multiple id="gender_id" class="form-control select"  required>  
                                        <option value="1" @if(in_array(1, explode(',', $podc->gender_id))) selected @endif >Male</option>
                                        <option value="2" @if(in_array(2, explode(',', $podc->gender_id))) selected @endif>Female</option>
                                         <option value="3" @if(in_array(3, explode(',', $podc->gender_id))) selected @endif>Other</option>
                                    </select>
                                    <span class="text-danger">
                                    @error('gender_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Focus  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="focus_id[]" multiple id="focus_id" class="form-control select"  required>  
                                        <option value="1" @if(in_array(1, explode(',', $podc->focus_id))) selected @endif >Track menstrual cycle</option>
                                        <option value="2" @if(in_array(2, explode(',', $podc->focus_id))) selected @endif>Track energy levels</option>
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
                                
                                        <option value="1" @if(old('language_id',$podc->language_id == 1)) selected @endif >English</option>
                                        <option value="2" @if(old('language_id',$podc->language_id == 2)) selected @endif>Māori</option>
                                         
                                    </select>
                                    <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Thumbnails <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="file" name="thumbnail" id="thumbnail"  class="form-control" accept="image/*">
                                <span class="text-danger">
                                    @error('thumbnail')
                                    {{$message}}
                                @enderror
                                </span>
                                <img class="my-3" src="{{env('APP_URL')}}/{{$podc->thumbnail}}" alt="" style="height:58px;border-radius:6px;">
                            </div>
                        </div>
                        
                         {{-- <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Audio <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
                                <span class="text-danger">
                                    @error('audio')
                                    {{$message}}
                                @enderror
                                </span>
                                <audio controls>
                                    <source src="{{env('APP_URL')}}/{{$podc->audio}}" type="audio/ogg/mp3" style="height:58px;border-radius:6px;">
                                    <source src="{{env('APP_URL')}}/{{$podc->audio}}" type="audio/mpeg" style="height:58px;border-radius:6px;">
                                  </audio>
                            </div>
                           
                        </div> --}}
                        
                       
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="status" id="status" class="form-control select"  required>  
                                
                                        <option value="1" @if(old('status',$podc->status == 1)) selected @endif >Active</option>
                                        <option value="2" @if(old('status',$podc->status == 2)) selected @endif>In Active</option>
                                    </select>
                                    <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update Podcast</button>

                    </footer>
                    @endforeach
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>
{{----start podcast----}}



    </div>
<x-footer/>
<script>
    $('#category_id').on('change',function(e){
    e.preventDefault();
    $('#subcategory_id').html('');
    var category_id = $('#category_id').val();
    if(category_id==''){
        var data=' <option value="">Choose sub category</option>';
       $('#subcategory_id').append(data);
    } else{
        $('#subcategory_id').html('');
    }
    var host = "{{URL::to('/')}}";
    $.ajax({
        type: "POST", 
        data: {
        "_token": "{{ csrf_token() }}",
         "category_id":category_id
   },
    url: host+'/admin/get-podcast-sub-categories',
}).done(function(response) {
     console.log(response.get_data);  
     $.each(response.get_data, function(index, element){
        var data=' <option value="'+element.category_id +'">'+element.category_name+'</option>';
       $('#subcategory_id').append(data);
     });
    });	
});
</script>
