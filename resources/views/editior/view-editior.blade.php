<x-header titletext="View editior"/>
<section role="main" class="content-body">

    <header class="page-header">

        <h2>Editior View</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Editior-View</span></li>

            </ol>

            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>

   

    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if (session('delete'))

        <div class="alert alert-danger">

            {{ session('delete') }}

        </div>

    @endif

    <div class="col-lg-12 m-auto mb-2">

        <section class="card">
            <header class="card-header">
                <div class="row">
                    <h2 class="card-title col-md-12 " style="text-align:center;">View Editiors</h2>                 
                </div>
            </header>
            <div class="card-body" style="display: block;">
                {!! $long_description->long_description !!}
            </div>             
               </section>
                </div>





</section>

<x-footer />
