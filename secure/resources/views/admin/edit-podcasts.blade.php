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
                                <input type="text" name="title" id="title" value="{{old('title',$podc->title)}}"  class="form-control" >
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

                        <div class="form-group row pb-3">
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
                        </div>
                    
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Short Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <textarea type="text" name="description" id="description"  class="form-control" >{{old('description',$podc->description)}}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">File Url </label>
                            <div class="col-sm-6">
                                <input type="text" name="file_url" id="file_url" value="{{old('file_url',$podc->file_url)}}"  class="form-control" accept="image/*">
                                <span class="text-danger">
                                    @error('file_url')
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
                        
                        <div class="form-group row mb-3">
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
                           
                        </div>
                        
                       
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
