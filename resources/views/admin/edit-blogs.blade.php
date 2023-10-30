<x-header titletext="update blogs" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Blog Update</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>update blog</span></li>
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
            {{-- {{ '/admin/edit-blog' }} --}}
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{ '/admin/edit-blog' }}"
                method="post">
                @csrf

                <section class="card">
                    <header class="card-header">

                        <h2 class="card-title" style="text-align:center">Update Blogs</h2>
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

                                    <input type="hidden" name="id" value="{{ $blogs->blog_id }}">
                                    <div class="form-group row pb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Category Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="category_id" name="category_id" required>
                                                <option value="">Choose Category</option>

                                                @isset($categorys)
                                                    @foreach ($categorys as $category)
                                                        <option value="{{ $category->category_id }}"
                                                            @if ($category->category_id == $blogs->category_id) selected @endif>
                                                            {{ $category->path }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>


                                {{--    <div class="form-group row pb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="subcategory_id" name="subcategory_id"
                                                required>
                                                <option value="{{ $subcategory->category_id }}">
                                                    {{ $subcategory->category_name }}</option>
                                            </select>
                                        </div>
                                    </div> --}}
                         <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Gender  <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <select name="gender_id[]" multiple id="gender_id" class="form-control select"  required>
                                        <option value="1" @if(in_array(1, explode(',', $blogs->gender_id))) selected @endif >Male</option>
                                        <option value="2" @if(in_array(2, explode(',', $blogs->gender_id))) selected @endif>Female</option>
                                         <option value="3" @if(in_array(3, explode(',', $blogs->gender_id))) selected @endif>Other</option>
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
                                        <option value="1" @if(in_array(1, explode(',',$blogs->focus_id))) selected @endif >Track menstrual cycle</option>
                                        <option value="2" @if(in_array(2, explode(',',$blogs->focus_id))) selected @endif>Track energy levels</option>
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

                                        <option value="1" @if(old('language_id',$blogs->language_id == 1)) selected @endif >English</option>
                                        <option value="2" @if(old('language_id',$blogs->language_id == 2)) selected @endif>Māori</option>

                                    </select>
                                    <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                                    <div class="form-group row pb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Blog Title <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="title" value="{{old('title',$blogs->title)}}"
                                                class="form-control" required>
                                            <span class="text-danger">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Blogs Image <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="file" name="image" id="image"
                                                value="{{ old('image') }}" aria-describedby="" class="form-control"
                                                placeholder="" accept="image/*">
                                            <span class="text-danger">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <img class="mt-3" src="{{ env('APp_URL') }}/{{$blogs->image}}"
                                                alt="image" width="200px">
                                        </div>
                                    </div>


                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Blog Description <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <textarea name="description" id="description" class="form-control" required>{{ old('description',$blogs->description) }}</textarea>
                                            <span class="text-danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group row pb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Blog Tags <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="tags" value="{{old('tags',$blogs->tags) }}"
                                                class="form-control" required>
                                            <span class="text-danger">
                                                @error('tags')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Author Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="author_name" value="{{$blogs->author_name}}"
                                                class="form-control" required>
                                            <span class="text-danger">
                                                @error('author_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <select name="status" id="status" class="form-control select" required>
                                                <option value="">Choose Status</option>
                                                <option value="1"
                                                    @if(old('status',$blogs->status == 1)) selected @endif>Active</option>
                                                <option value="2"
                                                    @if(old('status',$blogs->status == 2))  selected @endif>In-Active</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                            </td>
                        </tr>
                        <?php $i = 1; ?>
                        @if (isset($slides))
                            @foreach ($slides as $slid)
                                <tr>
                                    <td>
                                        <div class="card-body">
                                            <div class="row_r row my-2">

                                                <input type="hidden" name="slide_id[]" value="{{$slid->slide_id}}">
                                                <div class="form-group row pb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Slide Title
                                                        {{ $i++ }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-6"><input type="text" name="slide_title[]"
                                                            value="{{ $slid->slide_title }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Slide
                                                        Description <span class="text-danger">*</span></label>
                                                    <div class="col-sm-6">
                                                        <textarea name="slide_description[]" id="blog_additional_info" class="form-control">{{ $slid->slide_description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Slide Image
                                                        <span class="text-danger">*</span> </label>
                                                    <div class="col-sm-6"><input onchange="get_slide_image({{$slid->slide_id}})" type="file" name="slide_image[{{$slid->slide_id}}]"
                                                            id="slide_image" value="ritika" aria-describedby=""
                                                            class="form-control blog_image " placeholder="" accept="image/*">
                                                        <img class="mt-3"
                                                            src="{{ env('APp_URL') }}/{{ $slid->slide_image }}"
                                                            alt="image" id="myimage" width="200px">
                                                    </div>
                                                    <input type="hidden" name="hidden_image[]"
                                                            id="hidden_image" value="{{ $slid->slide_image }}" aria-describedby=""
                                                            class="form-control" >
                                                </div>
                                                <div class="form-group row mb-3"><label
                                                        class="col-sm-4 control-label text-sm-end pt-2">Product Url
                                                        (optional)
                                                    </label>
                                                    <div class="col-sm-6"><input type="url" name="product_url[]"
                                                            class="form-control"
                                                            value="{{ $slid->product_url }}"><span
                                                            class="text-danger"></span></div>
                                                            <a href="/delete-slide/{{ $slid->slide_id}}" class=" btn-sm btn-del col-md-1 text-center text-white mx-1 my-1 delete-row" onclick="return confirm('Do you really want to delete this Slide?')">Delete</a>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        @endif
                        {{-- <input type="hidden" name="image_name" class="image_name" value="">
                        <input type="hidden" name="expl_id" class="ritika" id="title" value=""> --}}
                        <input type="hidden" name="data_id" id="data_id" value="{{ $i }}">

                    </table>
                    <div class="card-body col-2 text-end"><button type="button" name="add"
                            class="btn btn-success btn-sm addrow"><i class="fas fa-plus"></i></button>
                    </div>
                    <footer class="card-footer text-end">

                        <button class="btn btn-primary"  type="submit">Update </button>
                        {{-- disabled  --}}
                    </footer>
                </section>
            </form>
        </div>
    </section>

    {{-- </div> --}}
    <x-footer />

    <script>


//         function get_slide_image(id,event){
//             alert('okk');
//             $('input[type="file"]').change(function(e){
//             // var fileName = e.target.files[0].name;
//             var old = $('.ritika').val();
//             alert(old);
//             $('.ritika').val(old+','+id+'_'+fileName);
//         });


// }
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
    </script>


    <script type="text/javascript">
        $(document).on('click', '.addrow', function() {
            var sr = $('#data_id').val();

            var count = parseInt(sr);

            var row =
                '<tr><td><div class="card-body"><div class="row_r row my-2"><div class="col-12 text-end"><button type="button" name="add" class="btn btn-success btn-sm addrow"><i class="fas fa-plus"></i></button>&nbsp;<button type="button" name="add" class="btn btn-danger btn-sm removerow"><i class="fas fa-minus"></i></button></div></div><div class="form-group row pb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Slide Title' +
                count +
                ' <span class="text-danger">*</span></label><div class="col-sm-6"><input type="text" name="slide_title_new[]" value="" class="form-control" required></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Slide Description <span class="text-danger">*</span></label><div class="col-sm-6"><textarea  name="slide_description_new[]" id="blog_additional_info" value=""  class="form-control" required></textarea></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Slide Image <span class="text-danger">*</span></label><div class="col-sm-6"><input type="file" name="slide_image_new[]" id="blog_image{{ $i++ }}" data-id="{{ $i++ }}" value="" aria-describedby=""  class="form-control" placeholder="" accept="image/*" required></div></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Product Url (Optional)</label><div class="col-sm-6"><input type="url" name="product_url_new[]"  class="form-control" ><span class="text-danger"></span></div></div></td></tr>';
            $('#abc').append(row);

            var new_sr = count + 1;
            $('#data_id').val(new_sr);
        });
        $(document).on('click', '.removerow', function() {
            $(this).closest('tr').remove();
        });




    </script>
