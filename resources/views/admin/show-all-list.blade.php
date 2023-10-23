<x-header titletext="list"/>

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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/n-save-category'}}" method="POST">

                @csrf



                <section class="card">



                    <header class="card-header">



                        <h2 class="card-title">Create Category</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Category name: </label>

                            <div class="col-sm-6">

                                <select name="select_category" id="select_category" class="form-control select">

                                    <option value="" selected>Choose </option>

                                    <option value="tip" class="tips" >Tips</option>

                                    <option value="video" class="videos" >Videos</option>

                                    <option value="blogs" class="blogs" >Blogs</option>

                                    <option value="podcast" class="podcasts" >Podcasts</option>

                                    <option value="yoga" class="yogas" >Yogas</option>



                                </select>

                                <span class="text-danger">

                                    @error('category_name')

                                    {{$message}}

                                    @enderror

                                </span>

                            </div>

                        </div>



                        <!-- <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Choose category: </label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="parent_type" name="parent_type">

                                        <option value=""> Category</option>

                                        @isset($categorys)

                                        @foreach($categorys as $category)

                                        <option value="{{$category->c_id}}">

                                        {{$category->category_name}}

                                        </option>

                                        @endforeach

                                        @endisset

                                </select>

                            </div>

                        </div> -->



                        <!-- <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Description: </label>

                            <div class="col-sm-6">

                                <textarea  name="category_info" class="form-control"></textarea>

                                <span class="text-danger">

                                    @error('category_info')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div> -->

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status : </label>

                            <div class="col-sm-6">

                                <select name="status" id="status" class="form-control select">



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

                            <button class="btn btn-primary" type="submit">Create Category</button>



                        </footer>

                </section>

            </form>

        </div>

    </section>

    {{-- end here  --}}





    {{----start list----}}





    <section class="card tips" id="datatip">

        <div class="row">

            <div class="col">

                <section class="card">

                    <header class="card-header">



                        <h2 class="card-title">Tip list</h2>

                    </header>

                    <div class="card-body">

                        <table class="table table-responsive-md mb-0">

                            <thead>

                                <tr>

                                    <th>Sr. no</th>

                                    <th>Tips description</th>

                                    <th>Tips Add Info</th>

                                    <th>Tipa image</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>



                                <tr>

                                    <td>

                                        1

                                    </td>

                                    <td>

                                        Loss weight

                                    </td>

                                    <td>

                                        For most people, a weight loss goal of 1–2 pounds per week is considered safe. Cutting carbs, eating more protein, lifting weights, and getting more sleep ...

                                    </td>

                                    <td>

                                        \C:\xampp\tmp\php3EFB.tmp

                                    </td>

                                    <td>

                                        <a href="" class="btn btn-primary mx-2">Edit</a>

                                        <a href="" onclick="confirm('Do you really want delete')" class="btn btn-danger">Delete</a>

                                    </td>



                                </tr>

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </div>

    </section>





    <section class="card videos" id="datavideo">

        <div class="row">

            <div class="col">

                <section class="card">

                    <header class="card-header">



                        <h2 class="card-title">Video list</h2>

                    </header>

                    <div class="card-body">

                        <table class="table table-responsive-md mb-0">

                            <thead>

                                <tr>

                                    <th>Sr. no</th>

                                    <th>Tips description</th>

                                    <th>Tips Add Info</th>

                                    <th>Tipa image</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>



                                <tr>

                                    <td>

                                        1

                                    </td>

                                    <td>

                                        Loss weight

                                    </td>

                                    <td>

                                        For most people, a weight loss goal of 1–2 pounds per week is considered safe. Cutting carbs, eating more protein, lifting weights, and getting more sleep ...

                                    </td>

                                    <td>

                                        \C:\xampp\tmp\php3EFB.tmp

                                    </td>

                                    <td>

                                        <a href="" class="btn btn-primary mx-2">Edit</a>

                                        <a href="" onclick="confirm('Do you really want delete')" class="btn btn-danger">Delete</a>

                                    </td>



                                </tr>

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </div>

    </section>





    <section class="card blogs" id="datablog">

        <div class="row">

            <div class="col">

                <section class="card">

                    <header class="card-header">



                        <h2 class="card-title">Blog list</h2>

                    </header>

                    <div class="card-body">

                        <table class="table table-responsive-md mb-0">

                            <thead>

                                <tr>

                                    <th>Sr. no</th>

                                    <th>Tips description</th>

                                    <th>Tips Add Info</th>

                                    <th>Tipa image</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>



                                <tr>

                                    <td>

                                        1

                                    </td>

                                    <td>

                                        Loss weight

                                    </td>

                                    <td>

                                        For most people, a weight loss goal of 1–2 pounds per week is considered safe. Cutting carbs, eating more protein, lifting weights, and getting more sleep ...

                                    </td>

                                    <td>

                                        \C:\xampp\tmp\php3EFB.tmp

                                    </td>

                                    <td>

                                        <a href="" class="btn btn-primary mx-2">Edit</a>

                                        <a href="" onclick="confirm('Do you really want delete')" class="btn btn-danger">Delete</a>

                                    </td>



                                </tr>

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </div>

    </section>





    <section class="card podcasts" id="datapodcast">

        <div class="row">

            <div class="col">

                <section class="card">

                    <header class="card-header">



                        <h2 class="card-title">Podcast list</h2>

                    </header>

                    <div class="card-body">

                        <table class="table table-responsive-md mb-0">

                            <thead>

                                <tr>

                                    <th>Sr. no</th>

                                    <th>Tips description</th>

                                    <th>Tips Add Info</th>

                                    <th>Tipa image</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>



                                <tr>

                                    <td>

                                        1

                                    </td>

                                    <td>

                                        Loss weight

                                    </td>

                                    <td>

                                        For most people, a weight loss goal of 1–2 pounds per week is considered safe. Cutting carbs, eating more protein, lifting weights, and getting more sleep ...

                                    </td>

                                    <td>

                                        \C:\xampp\tmp\php3EFB.tmp

                                    </td>

                                    <td>

                                        <a href="" class="btn btn-primary mx-2">Edit</a>

                                        <a href="" onclick="confirm('Do you really want delete')" class="btn btn-danger">Delete</a>

                                    </td>



                                </tr>

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </div>

    </section>





    <section class="card yogas" id="datayoga">

        <div class="row">

            <div class="col">

                <section class="card">

                    <header class="card-header">



                        <h2 class="card-title">Yoga list</h2>

                    </header>

                    <div class="card-body">

                        <table class="table table-responsive-md mb-0">

                            <thead>

                                <tr>

                                    <th>Sr. no</th>

                                    <th>Tips description</th>

                                    <th>Tips Add Info</th>

                                    <th>Tipa image</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>



                                <tr>

                                    <td>

                                        1

                                    </td>

                                    <td>

                                        Loss weight

                                    </td>

                                    <td>

                                        For most people, a weight loss goal of 1–2 pounds per week is considered safe. Cutting carbs, eating more protein, lifting weights, and getting more sleep ...

                                    </td>

                                    <td>

                                        \C:\xampp\tmp\php3EFB.tmp

                                    </td>

                                    <td>

                                        <a href="" class="btn btn-primary mx-2">Edit</a>

                                        <a href="" onclick="confirm('Do you really want delete')" class="btn btn-danger">Delete</a>

                                    </td>



                                </tr>

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </div>

    </section>





    <x-footer />



    <script>

        $('#datatip,#datavideo,#datablog,#datapodcast,#datayoga').hide();



        $('#select_category').on('change', function() {

            var getval = $('#select_category').val();

            // alert(getval);

            if (getval == 'tip') {

                $('#datatip').show();

                $('#datavideo,#datablog,#datapodcast,#datayoga').hide();

            }

             else if(getval == 'video'){

                $('#datavideo').show();

                $('#datatip,#datablog,#datapodcast,#datayoga').hide();

            }

             else if(getval == 'blogs'){

                $('#datablog').show();

                $('#datatip,#datavideo,#datapodcast,#datayoga').hide();

            }

             else if(getval == 'yoga'){

                $('#datayoga').show();

                $('#datatip,#datablog,#datapodcast,#datavideo').hide();

            }

             else if(getval == 'podcast'){

                $('#datapodcast').show();

                $('#datatip,#datablog,#datavideo,#datayoga').hide();

            }  else {

                $('#datatip,#datavideo,#datablog,#datapodcast,#datayoga').hide();

            }

        }).change();

    </script>