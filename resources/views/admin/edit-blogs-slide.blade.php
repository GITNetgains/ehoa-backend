<x-header titletext="update blogs" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Blog Slide Update</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>update slide blog</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}



    <section class="card">
        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{ '/admin/edit-blog-slide' }}"
                method="post">
                @csrf

                <section class="card">
                    <header class="card-header">
                        
                        <h2 class="card-title" style="text-align:center">Update Blogs Slide</h2>
                    </header>
                    @if (session('msg'))
                        <div class="alert alert-danger">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <table class="datat" id="abc">
                        <tr>
                            <td>
                                <div class="card-body">
                                    <div class="row_r row my-2">
                                        
                                        <input type="hidden" name="slide_id" value="{{$slide->slide_id}}">
                                                <div class="form-group row pb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Slide Title
                                                   <span class="text-danger">*</span> </label>
                                                    <div class="col-sm-6"><input type="text" name="slide_title"
                                                            class="form-control" value="{{old('slide_title',$slide->slide_title)}}" required></div>
                                                </div>
                                                <div class="form-group row mb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Slide
                                                        Description <span class="text-danger">*</span></label>
                                                    <div class="col-sm-6">
                                                        <textarea name="slide_description" id="blog_additional_info" class="form-control" required>{{old('slide_description',$slide->slide_description)}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Slide Image
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-sm-6"><input onchange="get_slide_image()" type="file" name="slide_image"
                                                            id="blog_image" aria-describedby="" class="form-control"
                                                            placeholder="" accept="image/*">
                                                            <img src="{{env('APP_URL')}}/{{old('slide_image',$slide->slide_image)}}" alt="slide_image" width="200px" class="mt-3">
                                                        </div>
                                                </div>
 <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Gender  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="gender_id[]" multiple id="gender_id" class="form-control select"  required>  
                                        <option value="1" @if(in_array(1, explode(',', $slide->gender_id))) selected @endif >Male</option>
                                        <option value="2" @if(in_array(2, explode(',', $slide->gender_id))) selected @endif>Female</option>
                                         <option value="3" @if(in_array(3, explode(',', $slide->gender_id))) selected @endif>Other</option>
                                    </select>
                                    <span class="text-danger">
                                    @error('gender_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                                                <div class="form-group row mb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Product Url
                                                        (optional) 
                                                    </label>
                                                    <div class="col-sm-6"><input type="url" value="@if($slide->product_url!=null) {{Old('product_url',$slide->product_url)}} @endif" name="product_url"
                                                            class="form-control"><span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <hr>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update Blog Slide</button>
<p class="ritika">Hyy</p>
                    </footer>
                </section>
            </form>
        </div>
    </section>

    {{-- </div> --}}
    <x-footer />

    <script>
        $('#category_id').on('change', function(e) {

            e.preventDefault();
            $('#subcategory_id').html('');

            var category_id = $('#category_id').val();
            //  alert (category_id );
            if (category_id == '') {
                var data = ' <option value="">Choose sub category</option>';
                $('#subcategory_id').append(data);
            } else {

                $('#subcategory_id').html('');
            }
            var host = "{{ URL::to('/') }}";
            $.ajax({
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "category_id": category_id,

                },
                url: host + '/admin/get-blogs-sub-categories',
            }).done(function(response) {
                console.log(response.get_data);
                $.each(response.get_data, function(index, element) {
                    var data = ' <option value="' + element.category_id + '">' + element
                        .category_name + '</option>';
                    $('#subcategory_id').append(data);
                });
            });
        });


      
        
        function get_slide_image(){
            // alert('id');
            $('.ritika').html('rahul');
  //$('#title').val(this.value ? this.value.match(/([\w-_]+)(?=\.)/)[0] : '');
//   $('#title').val(this.files && this.files.length ? this.files[0].name.split('.')[0] : '');

}


        $(document).on('click', '.addrow', function() {
            var row =
                '<tr><td><div class="card-body"><div class="row_r row my-2"><div class="col-12 text-end"><button type="button" name="add" class="btn btn-success btn-sm addrow"><i class="fas fa-plus"></i></button>&nbsp;<button type="button" name="add" class="btn btn-danger btn-sm removerow"><i class="fas fa-minus"></i></button></div></div><div class="form-group row pb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Slide Title <span class="text-danger">*</span></label><div class="col-sm-6"><input type="text" name="slide_title[]" value="" class="form-control" required></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Slide Description <span class="text-danger">*</span></label><div class="col-sm-6"><textarea  name="slide_description[]" id="blog_additional_info" value=""  class="form-control" required></textarea></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Slide Image <span class="text-danger">*</span></label><div class="col-sm-6"><input type="file" name="slide_image[]" id="blog_image" value="" aria-describedby=""  class="form-control" placeholder="" accept="image/*" required></div></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Product Url (Optional)</label><div class="col-sm-6"><input type="url" name="product_url[]"  class="form-control" ><span class="text-danger"></span></div></div></td></tr>';
            $('#abc').append(row);
        });
        $(document).on('click', '.removerow', function() {
            $(this).closest('tr').remove();
        });
    </script>
