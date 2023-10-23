<x-header titletext="list notifications"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Category</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Notification lists</span></li>

            </ol>

            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>

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

    <div class="row">

        <div class="col">





            <section class="card">

                <header class="card-header">



                    <h2 class="card-title" style="text-align:center;">Push Notification list</h2>

                </header>

                <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-responsive-md mb-0">

                        <thead>

                            <tr style="text-align:center;">

                                <th>Sr.no</th>

                                <th>Title</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Time</th>
                                <th>Expiry</th>
                                <th>Image</th>
                                <th style="width:150px">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @isset($mydata)
                            <?php $sr = ($mydata->perPage() * ($mydata->currentPage() - 1)) + 1; ?>
                                @if (count($mydata) > 0)
                                    @foreach ($mydata as $data)
                                        <tr >
                                            <td>
                                                {{$sr++}}
                                            </td>
                                            <td>
                                            {{ucfirst($data->title)}}
                                            </td>
                                            <td>
                                                {{ucfirst($data->description)}}
                                            </td>
                                            <td>
                                         <?php if($data->type==1){
                                            echo('Blog');
                                         } 
                                         if($data->type==2){
                                            echo('Journal');
                                         }
                                         if($data->type==3){
                                            echo('Ritual');
                                         }
                                         if($data->type==4){
                                            echo('Podcast');
                                         }
                                         if($data->type==5){
                                            echo('Tip');
                                         }
                                        if($data->type==6){
                                            echo('Promotion');
                                         }
                                         
                                         ?>
                                            </td>
                                            <td style="text-align:center;">{{$data->user_id}}
                                                 </td>
                                            <td style="text-align:center;">@if($data->status==2)
                                                <span class="badge badge-dan text-danger  d-inline">In-Active</span> @endif
                                                 @if($data->status==3)<span class="badge badge-dan text-danger  d-inline">Deleted</span> @endif
                                                  @if($data->status==1) <span class="badge badge-suc text-success d-inline">Active</span> @endif</td>
                                            <td>
                                                {{$data->date}}
                                            </td>
                                            <td style="text-align:center;">
                                                {{$data->time}}
                                            </td>
                                            <td style="text-align:center;">
                                                {{$data->expiry_date}}
                                            </td>
                                            <td style="text-align:center;"><img src="{{env('APP_URL')}}/{{ $data->image}}" style="height:40px;border-radius:6px;"></td>
                                            <td style="text-align:center;" class="">

                                                <a  href="{{ '/notifications/edit-notifications' }}/{{$data->push_notification_id}} "
                                                    class="btn-sm btn-edit text-white mx-1">Edit</a>
                                       <a href="{{'/notifications/delete-notifications' }}/{{$data->push_notification_id}}"  class="btn-sm btn-del text-white mx-1 my-1 "
                                       onclick="return confirm('Do you really want to delete {{ucfirst($data->title)}}  this Notification? ')">Delete</a>
                                               

                                            </td>
                                        </tr>

                                    @endforeach


                                @endif

                            @endisset

                        </tbody>

                    </table>
</div>


                </div>

            </section>

        </div>

    </div>






    {{$mydata->links('vendor.pagination.custom') }}

</section>





</div>





<x-footer />

