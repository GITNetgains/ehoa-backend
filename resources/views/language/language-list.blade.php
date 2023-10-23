<x-header titletext="List Language"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Country List</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Language List</span></li>

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

    @if (session('delete'))

        <div class="alert alert-danger">

            {{ session('delete') }}

        </div>

    @endif

    <div class="col-lg-12 m-auto mb-2">

        <section class="card">

            <header class="card-header">

                



                <h2 class="card-title" style="text-align:center;">List Language</h2>



            </header>



            <div class="card-body" style="display: block;">

                {{-- <a class="text-light btn btn-primary " href="{{'/admin/podcast-create'}}"> Create Podcast</a> --}}


   <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">

                    <thead>

                        <tr style="text-align:center;">



                            <th width="5%">Sr.No</th>

                            <th>Name</th>

                            <th>Code</th>

                            <th>Created At</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $i = ($languages->perPage() * ($languages->currentPage() - 1)) + 1; ?>

                        @if (count($languages) > 0)

                            @foreach ($languages as  $key)

                                <tr style="">

                                    <td>{{ $i++ }}</td>

                                    <td>{{ucfirst($key->langauge_name)}}</td>

                                    <td style="text-align:center;">{{$key->langauge_code}}</td>

                                  <td style="text-align:center;">{{$key->created_at}}</td>

                                    <td style="text-align:center;" class="actions"> <a href="/language/edit-language/{{$key->language_id}}" class="btn-sm btn-edit text-white mx-1">Edit</a>

                                        {{-- <a href="/language/delete-language/{{$key->language_id }}"  class="btn-sm btn-del text-white mx-1 my-1  "

                                            onclick="return confirm('Do you really want to delete {{$key->langauge_name}}  this Country? ')">Delete</a> --}}

                               </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>

                                <td colspan="6" class="text-center">No Country data Found</td>

                            </tr>

                        @endif



                    </tbody>



                </table>
</div>
            </div>



    </div>

    {{ $languages->links('vendor.pagination.custom') }}

</section>



<div></div>

</div>



{{-- end here  --}}





</section>



</div>

<x-footer />

