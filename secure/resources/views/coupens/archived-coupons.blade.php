<x-header titletext="list Coupons"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Coupons List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Archived Coupons List</span></li>
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
    <div class="col-lg-12 m-auto mb-2">
        <section class="card">
            <header class="card-header">
                

                <h2 class="card-title" style="text-align:center;">List Archived Coupons</h2>

            </header>

            <div class="card-body" style="display: block;">
                {{-- <a class="text-light btn btn-primary " href="{{'/admin/podcast-create'}}"> Create Podcast</a> --}}
<div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">

                            <th >Sr.No</th>
                            <th>Name</th>
                            <th>Coupons</th>
                            <th >Description</th>
                            <th>Expiry</th>
                            <th>Used Times</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = ($coupens->perPage() * ($coupens->currentPage() - 1)) + 1; ?>
                        @if (count($coupens) > 0)
                            @foreach ($coupens as  $key)
                                <tr style="">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ucfirst($key->name)}}</td>
                                    <td style="text-align:center;">{{$key->coupon}}%</td>
                                    <td >{{$key->description}}</td>
                                    <td style="text-align:center;">{{$key->expiry}}</td>
                                    <td style="text-align:center;">{{$key->used_number_of_times}}</td>
                                    <td style="text-align:center;">{{$key->created_at}}</td>
                                    <td style="text-align:center;">@if($key->status==2)<span class="badge badge-dan text-danger  d-inline">In-Active</span> @endif @if($key->status==3)<span class="badge badge-dan text-danger  d-inline">Deleted</span> @endif @if($key->status==1) <span class="badge badge-suc text-success  d-inline">Active</span> @endif</td>
                   <td style="text-align:center;" class="actions">
                    <a href="/undo-coupons/{{$key->coupons_id}}" class="btn-sm btn-edit text-white mx-1">Undo</a>
                                        
                              
                                </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">No Archived Coupons Found</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
                </div>
            </div>

    </div>
    {{ $coupens->links('vendor.pagination.custom') }}
</section>

<div></div>
</div>

{{-- end here  --}}


</section>

</div>
<x-footer />
