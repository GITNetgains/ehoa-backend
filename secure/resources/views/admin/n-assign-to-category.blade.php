<x-header/><x-header titletext="assign category"/>
{{-- <style>

    .tip { display:none }

    .video { display:none }

    .blog { display:none }

    .podcast { display:none }

    .yoga { display:none }

</style> --}}

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

                <li><span>Category Create</span></li>

            </ol>

            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>

    {{-- start here  --}}



    <section class="card">



        <div class="col-lg-12">

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/n-save-assign-to-category'}}" method="POST">

                @csrf



                <section class="card">



                    <header class="card-header">

                        

                        <h2 class="card-title">Create Category</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Category name: </label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="category" name="category">

                                        <option value="">Choose Category</option>

                                        @isset($categorys)

                                        @foreach($categorys as $category)

                                        <option value="{{$category->c_id}}">

                                        {{$category->category_name}}

                                        </option>

                                        @endforeach

                                        @endisset

                                </select>

                            </div>

                        </div>



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category name: </label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="sub_category" name="sub_category">

                                    <option value="">Choose sub Category</option>

                            </select>

                            </div>

                        </div>

                    

                        {{-- <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status : </label>

                            <div class="col-sm-6">

                                <input type="checkbox" id="tip" name="tip" class="checkChecked"  value="tip">

                                <label for="tip">tips</label>

                                <input type="checkbox" id="video" name="video" class="checkvideo" value="video">

                                <label for="video"> Videos</label>

                                <input type="checkbox" id="blog" name="blog" class="checkblog" value="blog" >

                                <label for="blog">blogs</label> 

                                <input type="checkbox" id="podcast" name="podcast" class="checkpodcast"  value="podcast">

                                <label for="blog">podcasts</label> 

                                <input type="checkbox" id="yoga" name="yoga" class="checkyoga"  value="yoga">

                                <label for="blog">yogas</label> 

                            </div>

                        </div>

                     --}}



                        <div class="tip form-group row pb-3 " >

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Tips : </label>

                            <div class="col-sm-6">

                               <select class="form-control" name="tip" id="tip">

                                <option value="">choose tip</option>

                                @isset($tips)

                                @foreach($tips as $tip)

                                <option value="{{$tip->t_id}}">

                                {{$tip->tips_description}}

                                </option>

                                @endforeach

                                @endisset

                               </select>

                            </div>

                        </div>

                        <div class="form-group row pb-3 video">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Videos : </label>

                            <div class="col-sm-6">

                                <select class="form-control" name="video" id="video">

                                    <option value="">choose video</option>

                                    @isset($videos)

                                    @foreach($videos as $video)

                                    <option value="{{$video->v_id}}">

                                    {{$video->video_name}}

                                    </option>

                                    @endforeach

                                    @endisset

                                   </select>

                            </div>

                        </div>

                        <div class="form-group row pb-3 blog">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Blogs : </label>

                            <div class="col-sm-6">

                                <select class="form-control" name="blog" id="blog">

                                    <option value="">choose blog</option>

                                    @isset($blogs)

                                    @foreach($blogs as $blog)

                                    <option value="{{$blog->b_id}}">

                                    {{$blog->blog_description}}

                                    </option>

                                    @endforeach

                                    @endisset

                                   </select>

                            </div>

                        </div>

                        <div class="form-group row pb-3 podcast">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Podcasts : </label>

                            <div class="col-sm-6">

                                <select class="form-control" name="podcast" id="podcast">

                                    <option value="">choose podcast</option>

                                    @isset($podcasts)

                                    @foreach($podcasts as $podcast)

                                    <option value="{{$podcast->p_id}}">

                                    {{$podcast->podcast_description}}

                                    </option>

                                    @endforeach

                                    @endisset

                                   </select>

                            </div>

                        </div>

                        

                        <div class="form-group row pb-3 yoga">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Yogas : </label>

                            <div class="col-sm-6">

                                <select class="form-control" name="yoga" id="yoga">

                                    <option value="">choose yoga</option>

                                    @isset($yogas)

                                    @foreach($yogas as $yoga)

                                    <option value="{{$yoga->y_id}}">

                                    {{$yoga->yoga_description}}

                                    </option>

                                    @endforeach

                                    @endisset

                                   </select>

                            </div>

                        </div>

                   

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Create Sub-Category</button>



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

$( document ).ready(function(){

    $(".tip , .yoga, .podcast, .video, .blog").hide();

})



  $(".checkChecked").on("click",function() {

    $(".tip").toggle(this.checked);

  });

  $(".checkyoga").on("click",function() {

    $(".yoga").toggle(this.checked);

  });

  $(".checkpodcast").on("click",function() {

    $(".podcast").toggle(this.checked);

  });

  $(".checkvideo").on("click",function() {

    $(".video").toggle(this.checked);

  });

  $(".checkblog").on("click",function() {

    $(".blog").toggle(this.checked);

  });

    

    $('#category').on('change',function(e){

        e.preventDefault();

        $('#sub_category').html('');

        var c_id = $('#category').val();

        if(c_id==''){

            var data=' <option value="">Choose sub category</option>';

	       $('#sub_category').append(data);

        } else{

            

            $('#sub_category').html('');

        }

        var host = "{{URL::to('/')}}";

        $.ajax({

            type: "POST", 

            data: {

            "_token": "{{ csrf_token() }}",

             "c_id": c_id

       },

        url: host+'/admin/get-sub-categories',

    }).done(function(response) {

         console.log(response.get_data);  

		 $.each(response.get_data, function(index, element){

            var data=' <option value="'+element.sub_cat_id +'">'+element.sub_cat_name+'</option>';

	       $('#sub_category').append(data);

		 });

        });	

    });

</script>

