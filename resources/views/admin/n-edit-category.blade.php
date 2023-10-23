<x-header titletext="edit category"/>
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

                <li><span>Category Update</span></li>

            </ol>

            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>

    {{-- start here  --}}



    <section class="card">



        <div class="col-lg-12">

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/n-update-category'}}" method="POST">

                @csrf



                <section class="card">



                    <header class="card-header">

                        

                        <h2 class="card-title" style="text-align:center">Update Category</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Category Name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="text" name="category_name" value="{{old('category_name',$olddata->category_name)}}"  class="form-control" required>

                                <span class="text-danger">

                                    @error('category_name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Choose Parent Category <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="parent_type" name="parent_type">

                                        <option value="0" @if($olddata->parent_type==0) selected @endif>None</option>

                                        @isset($categorys)

                                        @foreach($categorys as $category)

                                        <option value="{{$category->category_id}}"  @if($olddata->parent_type==$category->category_id) selected @endif>

                                        {{$category->category_name}}

                                        </option>

                                        @endforeach

                                        @endisset

                                </select>

                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <textarea  name="category_info" class="form-control" >{{old('category_info',$olddata->category_info)}}</textarea>

                                <span class="text-danger">

                                    @error('category_info')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Category Image <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="file" name="category_image"  class="form-control" >

                                <span class="text-danger ">

                                    @error('category_image')

                                    {{$message}}

                                @enderror

                                </span>

                                <img class="my-3" src="{{env('APP_URL')}}{{old('category_image',$olddata->category_image)}}" alt="categoryimage" style="height:58px;border-radius:6px;">

                            </div>

                        </div>



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <select name="status" id="status" class="form-control select" >

                                    <option value="" >Choose Status</option>

                                    <option value="1" @if(old('status',$olddata->status == 1)) selected @endif>Active</option>

                                    <option value="2" @if(old('status',$olddata->status == 2)) selected @endif>In-active</option>

                                </select>

                                    <span class="text-danger">

                                    @error('status')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                            <input type="hidden" name="c_id" value="{{ $olddata->category_id }}">

                        </div>

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Update Category</button>



                    </footer>

                </section>

            </form>

        </div>

        {{-- end here  --}}





    </section>

{{----start podcast----}}



    </div>

   =



<x-footer/>

