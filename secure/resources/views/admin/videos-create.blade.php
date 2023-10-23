<x-header titletext="create video"/>
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

                <li><span>Videos Create</span></li>

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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/secure/admin/videos-save'}}" method="post">

                @csrf



                <section class="card">



                    <header class="card-header">

                       

                        <h2 class="card-title" style="text-align:center">Create Videos</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="text" name="title" id="title" value="{{old('title') }}"  class="form-control" >

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

                                        @isset($category)

                                        @foreach($category as $categ)

                                        <option value="<?php if($categ->status==1){echo $categ->category_id;} else{} ?>">

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

                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="subcategory_id" name="subcategory_id">

                                    <option value="{{old('subcategory_id')}}">Choose Sub Category</option>

                            </select>

                            <span class="text-danger">

                                @error('subcategory_id')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                    

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <textarea type="text" name="description" id="description"   class="form-control" >{{old('description')}}</textarea>

                                <span class="text-danger">

                                    @error('description')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">You-Tube Url <span class="text-danger">*</span> </label>

                            <div class="col-sm-6">

                                <input type="text" name="file_url" id="file_url" value="{{old('file_url')}}"  class="form-control" accept="image/*">

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

                                <input type="file" name="thumbnails" id="thumbnails" value="{{ old('thumbnails')}}"  class="form-control" accept="image/*">

                                <span class="text-danger">

                                    @error('thumbnails')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        

                       {{--  <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Video </label>

                            <div class="col-sm-6">

                                <input type="file" name="video" id="video" value="{{ old('video')}}"  class="form-control" accept="video/*">

                                <span class="text-danger">

                                    @error('video')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div> --}}

                        

                       

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                            <select name="status" id="status" value="{{ old('status')}}"  class="form-control select" >  

                                <option value="" >Choose Status</option>

                                        <option value="1" @if(old('status')==1) selected @endif>Active</option>

                                        <option value="2" @if(old('status')==2) selected @endif>In active</option>

                                    </select>

                                    <span class="text-danger">

                                    @error('status')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>



                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Create Video</button>



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

