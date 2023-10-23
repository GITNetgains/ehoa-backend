<x-header titletext="list Archived video"/>
<section role="main" class="content-body">

    <header class="page-header">

        <h2>Archived Videos List</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Archived Videos-List</span></li>

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
                <div class="row">
                    <h2 class="card-title" style="text-align:center;">List Videos</h2>
                    {{-- search start  --}}
                    
                </div>
                    {{-- search end  --}}

            </header>

            <div class="card-body" style="display: block;">
             <div class="table-responsive">

                <table class="table table-striped table-bordered table-responsive-md mb-0">

                    <thead>

                        <tr style="text-align:center;">

                            <th >Sr.No</th>

                            <th>Title</th>
                            <th>Category</th>
                            <th>Sub Category</th>

                            <th>Image</th>

                            <th style="width:350px">Description</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $i = ($video->perPage() * ($video->currentPage() - 1)) + 1; ?>

                        @if(count($video) > 0)

                            @foreach ($video as  $key)

                                <tr style="">

                                    <td>{{ $i++ }}</td>

                                    <td>{{ucfirst($key->title)}}</td>
                                    <td>@foreach($categories as $keyy) @if($keyy->category_id==$key->category_id) {{ucfirst($keyy->category_name)}} @endif @endforeach</td>
                                    <td>@foreach($categories as $keyy) @if($keyy->category_id==$key->subcategory_id) {{ucfirst($keyy->category_name)}} @endif @endforeach</td>
                                    <td style="text-align:center;"><img src="{{env('APP_URL')}}/{{ $key->thumbnails}}" style="height:40px;border-radius:6px;"></td>

                                    <td>{{ucfirst($key->description)}}</td>

                                    {{-- <td>{{ $key->video_url }}</td> --}}

                                    

                                    <td style="text-align:center;" class="actions">@if($key->status==2)<span class="badge badge-dan text-danger d-inline">In-Active</span> @endif @if($key->status==3)<span class="badge badge-dan text-danger  d-inline">Deleted</span> @endif @if($key->status==1) <span class="badge badge-suc text-success  d-inline">Active</span> @endif</td>

                                <td style="text-align:center;" class=""><a href="/undo-videos/{{$key->video_id}}" class="btn-sm btn-edit text-white mx-1 my-1">Undo</a>

                               
                                </td>

                                </tr>

                              

                            @endforeach

                        @else

                            <tr>

                                <td colspan="8" class="text-center">No Videos Found</td>

                            </tr>

                        @endif



                    </tbody>



                </table>
                </div>

            </div>



    </div>
{{$video->links('vendor.pagination.custom') }}
</section>

<div></div>

</div>



{{-- end here  --}}





</section>



</div>

<x-footer />
<script>
    var input = document.getElementById("serach");
    input.addEventListener("keypress", function(evenst) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("myBtn").click();
      }
    });
    </script>
