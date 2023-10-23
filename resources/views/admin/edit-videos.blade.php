<x-header titletext="edit videos"/>

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

                <li><span>Videos Update</span></li>

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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/videos-update'}}" method="post">

                @csrf



                <section class="card">



                    <header class="card-header">

                       

                        <h2 class="card-title" style="text-align:center">Update Videos</h2>

                    </header>

                    <div class="card-body"> 

                    @foreach($videos as $vide)

                     <input type="hidden" name="id" value="{{$vide->video_id}}">

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2"> Name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="text" placeholder="Maximum limit of the characters 30" name="title" id="title" value="{{$vide->title}}"  class="form-control" >

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

                                        <option value="{{$categ->category_id}}" @if($vide->category_id == $categ->category_id) selected @endif >

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
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Gender  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="gender_id[]" multiple id="gender_id" class="form-control select"  required>  
                                        <option value="1" @if(in_array(1, explode(',', $vide->gender_id))) selected @endif >Male</option>
                                        <option value="2" @if(in_array(2, explode(',', $vide->gender_id))) selected @endif>Female</option>
                                         <option value="3" @if(in_array(3, explode(',', $vide->gender_id))) selected @endif>Other</option>
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
                                        <option value="1" @if(in_array(1, explode(',', $vide->focus_id))) selected @endif >Track menstrual cycle</option>
                                        <option value="2" @if(in_array(2, explode(',', $vide->focus_id))) selected @endif>Track energy levels</option>
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
                                
                                        <option value="1" @if(old('language_id',$vide->language_id == 1)) selected @endif >English</option>
                                        <option value="2" @if(old('language_id',$vide->language_id == 2)) selected @endif>Māori</option>
                                         
                                    </select>
                                    <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    {{--    <div class="form-group row pb-3">

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

                        </div>  --}}

                    

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <textarea type="text" placeholder="Maximum limit of the characters 250" name="description" id="description"  class="form-control" >{{$vide->description}}</textarea>

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

                                <input type="text" name="file_url" id="file_url" value="{{$vide->file_url}}"  class="form-control" accept="image/*">

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

                                <input type="file" name="thumbnails" id="thumbnails"  class="form-control" accept="image/*">

                                <span class="text-danger">

                                    @error('thumbnails')

                                    {{$message}}

                                @enderror

                                </span>

                                <img class="my-3" src="{{env('APP_URL')}}/{{$vide->thumbnails}}" alt="" style="height:58px;border-radius:6px;">

                            </div>

                        </div>

                        

                       {{-- <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Video </label>

                            <div class="col-sm-6">

                                <input type="file" name="video" id="video"  class="form-control" accept="video/*">

                                <span class="text-danger">

                                    @error('video')

                                    {{$message}}

                                @enderror

                                </span>

                                <iframe class="my-3" src="{{env('APP_URL')}}/{{$vide->video}}" alt="" style="height:58px;border-radius:6px;"></iframe>

                            </div>

                        </div> --}}

                        

                       

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span> </label>

                            <div class="col-sm-6">

                            <select name="status" id="status" class="form-control select" >  

                                <option value="" >Choose Status </option>

                                        <option value="1" @if($vide->status == 1) selected @endif >Active</option>

                                        <option value="2" @if($vide->status == 2) selected @endif>In Active</option>

                                    </select>

                                    <span class="text-danger">

                                    @error('status')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

@endforeach

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Update</button>



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

       

        var category_id  = $('#category_id').val();

    //  alert (category_id );

        if(category_id ==''){

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

             "category_id": category_id,

           

        },

         url: host+'/admin/video-sub-categories',

        }).done(function(response) {

         console.log(response.get_data);  

		 $.each(response.get_data, function(index, element){

            var data=' <option value="'+element.category_id +'">'+element.category_name+'</option>';

	       $('#subcategory_id').append(data);

		 });

        });	

    });

</script>

