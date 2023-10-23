<x-header titletext="List Orders"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Orders List</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Orders List</span></li>

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

                



                <h2 class="card-title" style="text-align:center;">Orders</h2>



            </header>

            {{-- <div class="row mb-4 mt-4 mx-2">

                <form action="/order/searchorder" method="post" role="search" class="d-flex">

                    @csrf

                    <div class="col-3">

                                        Start date<input type="date" name="to_date" id="to" class="form-control"></div>&nbsp;&nbsp;

                                            <div class="col-3">

                                                End date<input type="date" name="from_date" id="from" class="form-control">

                                            </div>&nbsp;&nbsp;

                                            <div class="col-3">

                                                &nbsp;

                                            <button type="submit" name="submit" id="" class="form-control btn btn-primary">Apply</button>

                                            </div>

                                            </form>

                                            </div> --}}

            <div class="card-body" style="display: block;">

               

   <div class="table-responsive">

                <table class="table table-striped table-bordered table-responsive-md mb-0">

                    <thead>

                        <tr style="text-align:center;">



                            <th >Sr.No</th>

                            <th>Order Id</th>

                            <th>Customer Name</th>

                            <th >Package </th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                      

                            <?php $i = ($orders->perPage() * ($orders->currentPage() - 1)) + 1; ?>

                            @if (count($orders) > 0)

                                @foreach ($orders as  $key)

                                    <tr style="">

                                        <td>{{ $i++ }}</td>

                                        <td style="text-align:center;">{{$key->order_id}}</td>

                                       <td><?php if(isset($users)){

                                         foreach($users as $user){

                                               if($user->user_id == $key->user_id){

                                                echo ucfirst($user->name);

                                               }

                                         }

                                       } ?>

                                       </td>

                                       @if(isset($packages))

                                       @foreach($packages as $package)

                                       @if($package->package_id == $key->package_id)

                                       <td style="text-align:center;">

                                        {{ucfirst($package->package_title)}}

                                        </td> @endif

                                         {{-- @if($package->package_id == $key->package_id)

                                         <td>{{$package->price}}{{env('CURRENCY')}}</td>

                                             @endif --}}

                                       @endforeach

                                       @endif

                                      

                                     {{-- <td>{{$key->coupons_details}}</td> --}}

                                     

                                        <td style="text-align:center;">@if($key->status==1)<span class="badge text-success  d-inline">On Hold</span> @endif @if($key->status==2)<span class="badge text-secondary  d-inline">Processing</span> @endif @if($key->status==3)<span class="badge text-primary  d-inline">Completed</span> @endif @if($key->status==4)<span class="badge text-danger  d-inline">Canceled</span> @endif @if($key->status==5)<span class="badge text-danger  d-inline">Pending Payment</span> @endif </td>



                                        <td style="text-align:center;" class="actions">

                                            <a href="/order/views-orders/{{$key->order_id}}" class="btn-sm btn-view text-white mx-1 my-1">View</a>

                                            <a href="/order/edit-order/{{$key->order_id}}" class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>

                                            {{-- <a href="/disorder/delete-moonphase/{{$key->order_id}}" class="btn btn-sm btn-danger  text-white mx-1 "

                                                onclick="return confirm('Do you really want to delete   this Moon Phases? ')">Delete</a> --}}

                                            </td>

                                 

                                 

                                    </tr>

                                @endforeach

                            @else

                                <tr>

                                    <td colspan="9" class="text-center">No Orders Found</td>

                                </tr>

                            @endif

    

                        



                    </tbody>



                </table>
                </div>

            </div>



    </div>

    {{$orders->links('vendor.pagination.custom') }}

</section>



<div></div>

</div>



{{-- end here  --}}





</section>



</div>

<x-footer />

