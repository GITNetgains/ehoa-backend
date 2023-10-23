<x-header titletext="list podcast"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2> Podcast List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Archived Podcast List</span></li>
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
               
                    <h2 class="card-title"  style="text-align:center;" >Archived Podcast list</h2>
                    
            </header>

            <div class="card-body" style="display: block;">
            
<div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">

                            <th>Sr.No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Image</th>
                            <th>Short Description</th>
                            <th>Status</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = ($podcast->perPage() * ($podcast->currentPage() - 1)) + 1; ?>
                        @if (count($podcast) > 0)
                            @foreach ($podcast as  $key)
                                <tr style="">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ucfirst($key->title)}}</td>
                                    <td>@foreach($categories as $keyy) @if($keyy->category_id==$key->category_id) {{$keyy->category_name}} @endif @endforeach</td>
                                    <td>@foreach($categories as $keyy) @if($keyy->category_id==$key->subcategory_id) {{$keyy->category_name}} @endif @endforeach</td>
                                    <td style="text-align:center;"><img src="{{env('APP_URL')}}/{{ $key->thumbnail}}" style="height:58px;border-radius:6px;"></td>
                                    <td >{{$key->description}}</td>
                                    <td style="text-align:center;">@if($key->status==2)<span class="badge text-danger badge-dan  d-inline">In-Active</span> @endif @if($key->status==3)<span class="badge text-danger badge-dan  d-inline">Deleted</span> @endif @if($key->status==1) <span class="badge badge-suc text-success  d-inline">Active</span> @endif</td>
                                    <td style="text-align:center;" class=""> <a href="/undo-podcast/{{$key->podcast_id}}" class="btn-sm btn-edit text-white mx-1 my-1">Undo</a>
                                    
                                    
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">No Podcast Found</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
                </div>
            </div>

    </div>
    {{ $podcast->links('vendor.pagination.custom') }}
</section>

<div></div>
</div>

{{-- end here  --}}


</section>

</div>
<x-footer />
