<x-header titletext="create Pronoun"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>





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

                <li><span>Pronoun</span></li>

            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>

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

            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-pronoun'}}" method="post">

                @csrf



                <section class="card">

                    <header class="card-header">

                      

                        <h2 class="card-title" style="text-align:center;">Create Pronoun</h2>

                    </header>

                    <div class="card-body">



                    <div class="card-body">

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Pronoun</label>

                            <div class="col-sm-6">

                                <input type="text" name="pronoun" value="{{old('pronoun')}}" class="form-control" >

                                <span class="text-danger">

                                    @error('pronoun')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>



                      

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Create</button>



                    </footer>

                    </div>

                </section>

            </form>

        </div>

        {{-- end here  --}}





    </section>





    </div>

<x-footer/>



