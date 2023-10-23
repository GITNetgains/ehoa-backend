<x-header titletext="list category"/>
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



    <div class="row">

        <div class="col">

           

             

            <section class="card">

                <header class="card-header">

                    

                    <h2 class="card-title">Branch admin list</h2>

                </header>

                <div class="card-body">

                    <table class="table table-responsive-md mb-0">

                        <thead>

                            <tr>

                                <th>Sr. no</th>

                                <th>Category</th>

                                <th>Sub-Category Name</th>

                                <th>Description</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @isset($mydata)

                            @php $sr=1 @endphp

                            @if(count($mydata)>0)

                            @foreach($mydata as $data)

                            <tr>

                            <td>

                                {{$sr++}}

                            </td>

                            <td>

                                {{$data->category_name}}

                            </td>

                            <td>

                                {{$data->sub_cat_name}}

                            </td>

                            <td>

                                {{$data->sub_cat_info}}

                            </td>

                            <td>

                                @if($data->status==1) Active

                                @else De-Active

                                @endif

                            </td>

                            <td>

                                <a href="{{'/admin/n-edit-sub-category'}}/{{$data->sub_cat_id}}" class="btn btn-primary mx-2">Edit</a>

                                <a href="{{'/admin/n-delete-sub-category'}}/{{$data->sub_cat_id}}" onclick="confirm('Do you really want delete')" class="btn btn-danger">Delete</a>

                            </td>

                            </tr>

                            @endforeach

                            @else

                                <tr>

                                    <td colspan="4" class="text-center">No data found</td>

                                </tr>

                            @endif

                            @endisset

                        </tbody>

                    </table>

                   

                </div>

            </section>

        </div>

    </div>

            

        {{-- end here  --}}





    </section>

{{----start podcast----}}



    </div>





<x-footer/>

