<x-header titletext="Archived package"/>
<div class="tutpr">
</div>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>List Package</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>list-package</span></li>
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
               
                <h2 class="card-title"  style="text-align:center;">List Packages</h2>
            </header>
            <div class="card-body" style="display: block;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">
                            <th>Sr.No</th>
                            <th>Title</th>
                            <th>Cost</th>
                            <th>Validity(Days)</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = ($packages->perPage() * ($packages->currentPage() - 1)) + 1; ?>
                        @if(count($packages)>0)
                        @foreach($packages as $pack)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ucfirst($pack->package_title)}}</td>
                            <td style="text-align:center;">{{$pack->price}}</td>
                            <td style="text-align:center;">{{$pack->package_expiry}}</td>
                            <td style="text-align:center;">@if($pack->type==2)<span class="badge text-primary  d-inline">Premium</span> @else <span class="badge text-warning d-inline">Free</span> @endif</td>

                            <td style="text-align:center;">@if($pack->status==2)<span class="badge text-danger  d-inline">In-Active</span> @endif @if($pack->status==3)<span class="badge text-danger  d-inline">Deleted</span> @endif @if($pack->status==1) <span class="badge text-success  d-inline">Active</span> @endif</td>
                            <td style="text-align:center;" class="actions">
                                <a class="btn-sm btn-view text-white mx-1 my-1" href="/package-undo/{{$pack->package_id}}">Undo</a>
                                
                        </tr>
                        @endforeach
                        @else 
                       <tr>
                        <td colspan="8" class="text-center">No Packages Found</td>
                       </tr>
                        @endif

                    </tbody>
                </table>
                </div>
            </div>
            {{ $packages->links('vendor.pagination.custom') }}
        </section>
        <div></div>
    </div>

    {{-- end here  --}}


</section>
</div>
<x-footer />

