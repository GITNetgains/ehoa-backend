<x-header titletext="Edit Language"/>

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

                <li><span>Language Update</span></li>

            </ol>

            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>

    {{-- start here  --}}



    <section class="card">



        <div class="col-lg-12">

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/update-language'}}" method="post">

                @csrf

<input type="hidden" name="id" value="{{$languages->language_id}}">

                <section class="card">



                    <header class="card-header">

                       

                        <h2 class="card-title" style="text-align:center;">Update Language</h2>

                    </header>

                    <div class="card-body">



                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Name </label>

                            <div class="col-sm-6">

                                <input type="text" name="langauge_name" value="{{$languages->langauge_name}}" class="form-control" >

                                <span class="text-danger">

                                    @error('langauge_name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Code</label>

                            <div class="col-sm-6">

                                <input type="text" name="langauge_code" value="{{$languages->langauge_code}}" class="form-control">

                                <span class="text-danger">

                                    @error('langauge_code')

                                    {{$message}}

                                @enderror

                                </span>

                            

                                   

                            </div>

                        </div>

                      

                    </div>

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Update</button>



                    </footer>

                </section>

            </form>

        </div>

        {{-- end here  --}}





    </section>

{{----start podcast----}}







    </div>

<x-footer/>

