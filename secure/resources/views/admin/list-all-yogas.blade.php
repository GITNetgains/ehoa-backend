<x-header titletext="list yoga"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Yogas List</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Yoga-List</span></li>

            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>

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

                



                <h2 class="card-title">List Yogas</h2>



            </header>



            <div class="card-body" style="display: block;">

                <a class="text-light btn btn-primary " href="{{ '/admin/yoga-create' }}"> Create Yogas</a>

   <div class="table-responsive">

                <table class="table  table-responsive-md mb-0">

                    <thead>

                        <tr>



                            <th width="10%">#</th>

                            <th >Yoga Image</th>

                            <th>Yogas Description</th>

                            <th width="40%">Yogas Additional Info</th>



                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $i = 1; ?>

                        @if (count($uniqueid) > 0)

                            @foreach ($uniqueid as $id => $key)

                                <tr style="background-color:rgb(215, 215, 215);">

                                    <td>{{ $i++ }}</td>

                                    <td><img src="{{env('APP_URL')}}/{{$key['yoga_image'] }}" width="90" height="60" ></td>

                                    <td>{{ $key['yoga_description'] }}</td>

                                    <td>{{ $key['yoga_additional_info'] }}</td>

                                    <td> <a href="/admin/edit-mainpodcast/{{ $id }}" class=""><i

                                                class="fas fa-pencil-alt text-primary"></i></a>

                                        <a href="/admin/delete-yogas/{{ $id }}"

                                            class="text-danger delete-row"

                                            onclick="confirm('DO you really delete this !')"><i

                                                class="far fa-trash-alt"></i></a>

                                    </td>

                                </tr>



                               

                             

                            @endforeach

                        @else

                            <tr>

                                <td colspan="6" class="text-center">No Tips Found</td>

                            </tr>

                        @endif



                    </tbody>



                </table>
                </div>

            </div>



    </div>



</section>



<div></div>

</div>



{{-- end here  --}}



{{-- {{ $tips->links('vendor.pagination.custom') }} --}}

</section>



</div>

<x-footer />

