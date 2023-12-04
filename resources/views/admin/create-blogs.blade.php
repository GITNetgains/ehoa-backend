<x-header titletext="create blogs"/>
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
                <li><span>Packages Setting</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}
     @if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
    @endif


<section class="card">
    <div class="col-lg-12">
        <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-blogs'}}" method="post">
            @csrf

            <section class="card">
                <header class="card-header">
                    <div class="card-actions">

                    </div>
                    <h2 class="card-title">Create Blogs</h2>
                </header>

                    <table class="datat" id="abc">
                        <tr>
                          <td>
                            <div class="card-body">
                    <div class="row_r row my-2">
                        <div class="col-12 text-end">
                          <button type="button" name="add" class="btn btn-success btn-sm addrow">
                            <i class="fas fa-plus"></i></button>
                        </div>
                      </div>


                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Author Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="author_name" value="{{ old('author_name') }}" class="form-control" required>
                            <span class="text-danger">
                                @error('author_name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>


                      <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Category Name </label>
                            <div class="col-sm-6">
                                <select class="form-control"  id="category_id" name="category_id">
                                        <option value="">Choose Category</option>

                                        @isset($categorys)
                                        @foreach($categorys as $category)
                                        <option value="<?php if($category->status==1){echo $category->category_id;} else{} ?>">
                                        {{$category->path}}
                                        </option>
                                        @endforeach
                                        @endisset
                                </select>
                            </div>
                        </div>

                       {{-- <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category</label>
                            <div class="col-sm-6">
                                <select class="form-control"  id="subcategory_id" name="subcategory_id">
                                    <option value="">Choose Sub-Category</option>
                            </select>
                            </div>
                        </div> --}}

                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Blog Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="{{ old('	title') }}" class="form-control" required>
                            <span class="text-danger">
                                @error('title')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Blogs Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="image" id="image" value="{{ old('image') }}" aria-describedby=""  class="form-control" placeholder="" accept="image/*">
                            <span class="text-danger">
                                @error('image ')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Blog Description</label>
                        <div class="col-sm-6">
                            <textarea  name="description" id="description" value="{{ old('description') }}"  class="form-control" placeholder=""></textarea>
                            <span class="text-danger">
                                @error('description')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                    </div>



                    <div class="form-group row pb-3">
                        <label class="col-sm-4 control-label text-sm-end pt-2">Blog Tags</label>
                        <div class="col-sm-6">
                            <input type="text" name="tags" value="{{ old('tags') }}" class="form-control" required>
                            <span class="text-danger">
                                @error('tags')
                                {{$message}}
                            @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Gender <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="gender_id[]" multiple  id="gender_id" value="{{ old('gender_id')}}" class="form-control select" >
                                    <option value="">Choose Gender</option>
                                    <option value="1" @if( old('gender_id')==1) selected @endif>Male</option>
                                    <option value="2" @if( old('gender_id')==2) selected @endif>Female</option>
                                    <option value="3" @if( old('gender_id')==3) selected @endif>Other</option>
                                </select>
                                <span class="text-danger">
                                    @error('gender_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Blogs Status</label>
                            <div class="col-sm-6">
                                <select name="status" id="status" class="form-control select" >
                                    <option value="0">Choose Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">In-Active</option>
                                </select>

                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                </td>
            </tr>
            </table>
                <footer class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Create Blog</button>

                </footer>
            </section>
        </form>
    </div>
    </section>

    {{-- </div> --}}
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
         url: host+'/admin/get-blogs-sub-categories',
        }).done(function(response) {
         console.log(response.get_data);
		 $.each(response.get_data, function(index, element){
            var data=' <option value="'+element.category_id +'">'+element.category_name+'</option>';
	       $('#subcategory_id').append(data);
		 });
        });
    });
</script>


<script type="text/javascript">
    $(document).on('click','.addrow', function(){
            var row='<tr><td><div class="card-body"><div class="row_r row my-2"><div class="col-12 text-end"><button type="button" name="add" class="btn btn-success btn-sm addrow"><i class="fas fa-plus"></i></button>&nbsp;<button type="button" name="add" class="btn btn-danger btn-sm removerow"><i class="fas fa-minus"></i></button></div></div><div class="form-group row pb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Blog Title: </label><div class="col-sm-6"><input type="text" name="slide_title[]" value="" class="form-control" required></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Blog Description: </label><div class="col-sm-6"><textarea  name="slide_description[]" id="blog_additional_info" value=""  class="form-control" placeholder=""></textarea></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Blogs Image: </label><div class="col-sm-6"><input type="file" name="slide_image[]" id="blog_image" value="" aria-describedby=""  class="form-control" placeholder="" accept="image/*"></div></div></div><div class="form-group row mb-3"><label class="col-sm-4 control-label text-sm-end pt-2">Blog Url: </label><div class="col-sm-6"><input type="url" name="slide_url" class="form-control" required><span class="text-danger"></span></div></div></td></tr>';
            $('#abc').append(row);
        });
        $(document).on('click','.removerow', function(){
            $(this).closest('tr').remove();
        });
</script>

<script type="text/javascript">
    // Attach a "change" event listener to all elements with the specified class
    function attachChangeListener(element) {
        element.addEventListener('change', function (event) {
	    var categoryData = @json($categories);
            // Your code to handle the change event goes here
            let category_id  = event.target.value;
            //console.log(category_id);
            console.log(event.target.value);
            while(document.getElementById('categories-list').querySelector('select:last-child').id != event.target.id) {
            let categoriesList = document.getElementById('categories-list');
            let lastChild = categoriesList.querySelector('select:last-child');
            console.log(lastChild.id);
            categoriesList.removeChild(lastChild);
	    }

	    if(categoryData.hasOwnProperty(category_id)) {
            let categoriesList = document.getElementById('categories-list')
	    let newCategory = document.createElement('select');
            newCategory.className = 'form-control category-item mt-2';
            newCategory.id = category_id;
            let category = categoryData[category_id];
            let initialOption = document.createElement('option');
            initialOption.value = "-1";
            initialOption.text = "None";
            newCategory.appendChild(initialOption);
            for (let key in category) {
                if(category.hasOwnProperty(key)){
                    let option = document.createElement('option');
                    option.value = category[key].category_id;
                    option.text = category[key].category_name;
                    newCategory.appendChild(option);
                }
            }
            categoriesList.appendChild(newCategory);
            attachChangeListener(newCategory);
            } else {
                event.target.name = 'parent_type';
                console.log("success");
            }
        });
    }

    document.querySelectorAll('.category-item').forEach(function (element) {
        attachChangeListener(element);
    });
</script>
