<x-header titletext="create podcast"/>
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
                <li><span>Podcast Create</span></li>
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
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/secure/save-podcasts'}}" method="post">
                @csrf

                <section class="card">

                    <header class="card-header">
                        
                        <h2 class="card-title" style="text-align:center">Create Podcast</h2>
                    </header>
                    <div class="card-body">

                    <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="title" value="{{ old('title')}}"  class="form-control" >
                                <span class="text-danger">
                                    @error('title')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"  id="category_id" name="category_id">
                                        <option value="">Choose Category</option>
                                        @isset($categorys)
                                        @foreach($categorys as $category)
                                        <option value="{{$category->category_id}}">
                                        {{$category->category_name}}
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
                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" value="{{ old('subcategory_id') }}" id="subcategory_id" name="subcategory_id">
                                    <option value="">Choose sub Category</option>
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
                                <textarea  name="description" id="description" value=""  class="form-control" placeholder="">{{ old('description') }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Url </label>
                            <div class="col-sm-6">
                                <input class="form-control" value="{{ old('file_url') }}" type="text" name="file_url" >
                                <span class="text-danger">
                                    @error('file_url')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Thumbnail <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" type="file" value="{{ old('thumbnail') }}" name="thumbnail" accept="image/*">
                                <span class="text-danger">
                                    @error('thumbnail')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Audio <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" type="file" value="{{old('audio')}}" name="audio" accept="audio*/">
                                <span class="text-danger">
                                    @error('audio')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control" value="{{ old('status') }}" id="status" name="status">
                                            <option value="">choose status</option>
                                            <option value="1" @if(old('status')==1) selected @endif>Active</option>
                                            <option value="2"  @if(old('status')==2) selected @endif>In-Active</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
                            </div>

                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Create Podcast</button>

                    </footer>
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

