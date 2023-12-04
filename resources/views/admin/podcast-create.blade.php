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
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-podcasts'}}" method="post">
                @csrf

                <section class="card">

                    <header class="card-header">

                        <h2 class="card-title" style="text-align:center">Create Podcast</h2>
                    </header>
                    <div class="card-body">

                    <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" placeholder="Maximum limit of the characters 30" name="title" id="title" value="{{ old('title')}}"  class="form-control" >
                                <span class="text-danger">
                                    @error('title')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Choose Category path <span class="text-danger">*</span></label>
                            <div class="col-sm-6" id="categories-list">
                                <select class="form-control category-item"  id="0">
                                        <option value="">Choose Category</option>
                                        @isset($categories)

                                        @foreach($categories['0'] as $category)
                                        <option value="{{$category->category_id}}">

                                        {{$category->path}}

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

                    {{--     <div class="form-group row pb-3">
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
                        </div> --}}
                          <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Gender <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="gender_id[]" multiple  id="gender_id" value="{{ old('gender_id[]')}}" class="form-control select" >
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
                            <label class="col-sm-4 control-label text-sm-end pt-2">Focus <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="focus_id[]" multiple  id="focus_id" value="{{ old('focus_id[]')}}" class="form-control select" >
                                    <option value="">Choose focus</option>
                                    <option value="1" @if( old('focus_id')==1) selected @endif>Track Menstrual cycle</option>
                                    <option value="2" @if( old('focus_id')==2) selected @endif>Track energy levels</option>
                                </select>
                                <span class="text-danger">
                                    @error('focus_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Language <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="language_id" id="language_id" value="{{ old('language_id')}}" class="form-control select" >
                                    <option value="">Choose Language</option>
                                    <option value="1" @if( old('language_id')==1) selected @endif>English</option>
                                    <option value="2" @if( old('language_id')==2) selected @endif>Māori</option>
                                </select>
                                <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Short Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <textarea  name="description" placeholder="Maximum limit of the characters 150" id="description" value=""  class="form-control" placeholder="">{{ old('description') }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                        {{-- <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">File Url </label>
                            <div class="col-sm-6">
                                <input class="form-control" value="{{ old('file_url') }}" type="text" name="file_url" >
                                <span class="text-danger">
                                    @error('file_url')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div> --}}
                         <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Audio Url <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Enter the Source audio url" value="{{ old('audio_url') }}" type="text" name="audio_url" >
                                <span class="text-danger">
                                    @error('audio_url')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Thumbnail <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Maximum size 2MB and dimension 1024 X 1536 pixels" type="file" value="{{ old('thumbnail') }}" name="thumbnail" accept="image/*">
                                <span style="font-size: 12px;">Upload an image (1:1 ratio or 450px x 450px)</span>
                                <span class="text-danger">
                                    @error('thumbnail')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                      {{--  <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Audio <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" type="file" value="{{old('audio')}}" name="audio" accept="audio*/">
                                <span class="text-danger">
                                    @error('audio')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>  --}}

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

<script>
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
                event.target.name = 'category_id';
                console.log("success");
            }
        });
    }

    document.querySelectorAll('.category-item').forEach(function (element) {
        attachChangeListener(element);
    });

</script>
