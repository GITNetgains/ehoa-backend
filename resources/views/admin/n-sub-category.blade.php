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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/n-sub-save-category'}}" method="POST">

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

                                <input type="text" name="sub_cat_name"  class="form-control" required>

                                <span class="text-danger">

                                    @error('sub_cat_name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>



                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description: </label>

                            <div class="col-sm-6">

                                <textarea  name="sub_cat_info" class="form-control"></textarea>

                                <span class="text-danger">

                                    @error('sub_cat_info')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status : </label>

                            <div class="col-sm-6">

                            <select name="sub_status" id="status" class="form-control select" >



                                        <option value="0" selected>Choose Status</option>

                                        <option value="1" selected>Active</option>

                                        <option value="2" selected>Deactive</option>



                                    </select>

                                    <span class="text-danger">

                                    @error('status')

                                    {{$message}}

                                @enderror

                                </span>

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

   =



<x-footer/>

