<x-header titletext="create category"/>

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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/n-update-sub-category'}}" method="POST">

                @csrf



                <section class="card">



                    <header class="card-header">

                        

                        <h2 class="card-title" style="text-align:center">Create Category</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Category name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="category" name="category">

                                        <option value="">Choose Category</option>

                                        @isset($categorys)

                                        @foreach($categorys as $category)

                                        <option value="{{$category->c_id}}" @if($olddata->cat_id== $category->c_id) selected @endif >

                                        {{$category->category_name}}

                                        </option>

                                        @endforeach

                                        @endisset

                                </select>

                            </div>

                        </div>



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category name <span class="text-danger">*</span> </label>

                            <div class="col-sm-6">

                                <input type="text" name="sub_cat_name" value="{{$olddata->sub_cat_name}}" class="form-control" required>

                                <span class="text-danger">

                                    @error('sub_cat_name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>



                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <textarea  name="sub_cat_info" class="form-control" value="{{$olddata->sub_cat_info}}"></textarea>

                                <span class="text-danger">

                                    @error('sub_cat_info')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span></label>

                            <div class="col-sm-6">



                                <select name="sub_status" id="status" class="form-control select" >

                                    <option value="" >Choose Status</option>

                                    <option value="1" @if($olddata->sub_status == 1) selected @endif>Active</option>

                                    <option value="2" @if($olddata->sub_status ==2) selected @endif>De-active</option>

                                </select>

                                    <span class="text-danger">

                                    @error('sub_status')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                            <input type="hidden" name="sub_cat_id" value="{{ $olddata->sub_cat_id }}">

                        </div>

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Update Sub-Category</button>



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

