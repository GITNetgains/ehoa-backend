<x-header titletext="create category"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Category</h2>



        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Category-Create</span></li>

            </ol>

            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>

    {{-- start here  --}}



    <section class="card">



        <div class="col-lg-12">

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/n-save-category'}}" method="POST">

                @csrf



                <section class="card">



                    <header class="card-header">



                        <h2 class="card-title" style="text-align:center;">Create Category</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="text" name="category_name"  value="{{ old('category_name') }}"  class="form-control" >

                                <span class="text-danger">

                                    @error('category_name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Choose Category Path <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="parent_type" name="parent_type" class="category-item">

                                        <option value="0">None</option>

                                        @isset($categorys)

                                        @foreach($categorys as $category)

                                        <option value="{{$category->category_id}}">

                                        {{$category->path}}

                                        </option>

                                        @endforeach

                                        @endisset

                                </select>

                            </div>

                        </div>



                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <textarea  name="category_info" value="{{ old('category_info') }}" class="form-control"></textarea>

                                <span class="text-danger">

                                    @error('category_info')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Image <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="file" name="category_image"  value="{{ old('category_image') }}" class="form-control" >

                                <span class="text-danger">

                                    @error('category_image')

                                    {{$message}}

                                @enderror

                                </span>
				<span style="font-size: 12px;">Upload an image (1:1 ratio or 450px x 450px)</span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span> </label>

                            <div class="col-sm-6">

                            <select name="status" id="status" value="{{ old('status') }}" class="form-control select" >

                                        <option value="">Choose Status</option>

                                        <option value="1" @if(old('status')==1) selected @endif>Active</option>

                                        <option value="2" @if(old('status')==2) selected @endif>In-active</option>

                                    </select>

                                    <span class="text-danger">

                                    @error('status')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Create Category</button>

                    </footer>

                </section>

            </form>

        </div>

        {{-- end here  --}}





    </section>

</div>





<x-footer/>

<script type="text/javascript">
    console.log("this");

    $(document).on('click','.category-item', function(element){
        console.log('Element with class "${element.id}" changed!');
    });

    // Attach a "change" event listener to all elements with the specified class
    document.querySelectorAll('.category-item').forEach(function (element) {
        element.addEventListener('change', function () {
            // Your code to handle the change event goes here
            console.log('Element with class "${element.id}" changed!');
        });
    });
</script>
