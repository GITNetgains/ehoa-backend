<x-header titletext="Create Moon Phase"/>

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

                <li><span>Moon Phase Create</span></li>

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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-moonphase'}}" method="post">

                @csrf



                <section class="card">



                    <header class="card-header">

                        

                        <h2 class="card-title" style="text-align:center;">Create Moon Phases</h2>

                    </header>

                    <div class="card-body">

                       

                    <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="text" name="moon_phases_name" id="moon_phases_name" value="{{old('moon_phases_name')}}"  class="form-control" >

                                <span class="text-danger">

                                    @error('moon_phases_name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                            

                    <div class="form-group row mb-3">

                        <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>

                        <div class="col-sm-6">

                            <textarea type="text" name="short_description" id="short_description" value=""  class="form-control" >{{old('short_description')}}</textarea>

                            <span class="text-danger">

                                @error('short_description')

                                {{$message}}

                            @enderror

                            </span>

                        </div>

                    </div>

                        

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Icon <span class="text-danger">*</span> </label>

                            <div class="col-sm-6">

                                <input class="form-control" value="{{ old('icon')}}" type="file" name="icon" >

                                <span class="text-danger">

                                    @error('icon')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                       

                        <div class="form-group row mb-3">

                                <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>

                                    <div class="col-sm-6">

                                        <select class="form-control" value="{{ old('status') }}" id="status" name="status">

                                            <option value="">choose status</option>

                                            <option value="1" @if(old('status')  == 1) selected @endif>Active</option>

                                            <option value="2" @if(old('status') == 2) selected @endif>In-Active</option>

                                        </select>

                                        @error('status')

                                        <span class="text-danger">{{$message}}</span>

                                    @enderror

                                    </div>

                            </div>



                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Create </button>



                    </footer>

                </section>

            </form>

        </div>

        {{-- end here  --}}





    </section>



    </div>

<x-footer/>



