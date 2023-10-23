<x-header titletext="Create Disorders"/>

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

                <li><span>Create </span></li>

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


        @if(!(isset($emotions)))
        <div class="col-lg-12">

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-disorders'}}" method="post">

                @csrf



                <section class="card">



                    <header class="card-header">

                        

                        <h2 class="card-title" style="text-align:center;">Create   <?php if(isset($menstrual)){?>

                            Menstrual Flow

                            <?php

                           } 

                            ?>

                             <?php if(isset($symptoms)){?>

                                 Symptoms

                                 <?php

                                } 

                                 ?>

                          

                          <?php if(isset($energy)){?>

                            Energy

                             <?php

                            } 

                             ?> </h2>

                    </header>

                    <div class="card-body">
                    

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2"> Type <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="disorders_type" name="disorders_type">

                                        

                                      <?php if(isset($menstrual)){?>

                                       <option value="1">Menstrual Flow</option>

                                       <?php

                                      } 

                                       ?>

                                        <?php if(isset($symptoms)){?>

                                            <option value="2" >Symptoms</option>

                                            <?php

                                           } 

                                            ?>

                                      <?php if(isset($emotions)){?>

                                        <option value="3">Emotions</option>

                                        <?php

                                       } 

                                        ?>

                                     <?php if(isset($energy)){?>

                                        <option value="4">Energy</option> 

                                        <?php

                                       } 

                                        ?>
                                </select>

                            </div>

                        </div>

                    <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">  Name <span class="text-danger">*</span></label>

                            <div class="col-sm-6">

                                <input type="text" name="name" id="name" value="{{ old('name')}}"  class="form-control" >

                                <span class="text-danger">

                                    @error('name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Icon <span class="text-danger">*</span></label>

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

                                            <option value="" >choose status</option>

                                            <option value="1" @if(old('status')==1) selected @endif>Active</option>

                                            <option value="2" @if(old('status')==1) selected @endif>In-Active</option>

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
        @else
        <div class="col-lg-12">

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-disorders'}}" method="post">

                @csrf
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title" style="text-align:center;">Create  Emotions </h2>
                    </header>

                    <div class="card-body">
                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2"> Type: </label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="disorders_type" name="disorders_type">

                                        <option value="3">Emotions</option>
                                </select>

                            </div>

                        </div>

                    <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">  Name</label>

                            <div class="col-sm-6">

                                <input type="text" name="name" id="name" value="{{ old('name')}}"  class="form-control" >

                                <span class="text-danger">

                                    @error('name')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end ">Primary</label>

                            <div class="col-sm-6">

                                <input type="checkbox" class="form-check-input" value="primary"  name="primary" >

                                <span class="text-danger">

                                    @error('primary')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Icon: </label>

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

                                <label class="col-sm-4 control-label text-sm-end pt-2">Status</label>

                                    <div class="col-sm-6">

                                        <select class="form-control" value="{{ old('status') }}" id="status" name="status">

                                            <option value="">choose status</option>

                                            <option value="1">Active</option>

                                            <option value="2">In-Active</option>

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
        @endif
        {{-- end here  --}}





    </section>



    </div>

<x-footer/>



