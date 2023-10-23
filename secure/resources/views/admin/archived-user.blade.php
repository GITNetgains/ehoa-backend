<x-header titletext="list user"/>
<div class="list">
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Users List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Archived Users-List</span></li>
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
                <div class="card-actions">
                  
                </div>
                <h2 class="card-title" style="text-align:center;">Archived Users</h2>
            </header>
            <div class="card-body" style="display: block;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">
                          <th>Sr.No</th>
                            <th>User Id</th>
                            <th >Name</th>
                            <th >Email</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = ($users->perPage() * ($users->currentPage() - 1)) + 1; ?>
                        @if(count($users)>0)
                       @foreach($users as  $user)
                       @if($user->register_type == 1)
                       @else
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->user_id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email }}</td>
                            
                            <td style="text-align:center;">@if($user->status==2)<span class="badge badge-dan text-danger  d-inline">In-Active</span> @endif @if($user->status==3)<span class="badge badge-dan text-danger  d-inline">Deleted</span> @endif @if($user->status==1) <span class="badge badge-suc text-success  d-inline ">Active</span> @endif</td>
                            <td>{{$user->created_at}}</td>

                            <td class="actions" style="text-align:center">
                                <a  href="/undo-users/{{$user->user_id}}" class="btn-sm btn-edit text-white mx-1 my-1 " >Undo</a>
                               
                                

                            </td>
                        </tr>
                 @endif

                        @endforeach

                        @else <tr><td colspan="7" class="text-center">No data Found</td></tr>
                        @endif

                    </tbody>
                    </tbody>
                </table>
                </div>
                
                
                
                {{ $users->links('vendor.pagination.custom') }}
            </div>
          
        </section>
        <div></div>
    </div>

    {{-- end here  --}}


</section>
</div></div>
<x-footer />
{{-- onclick="userdetails('{{ $user->user_id }}')" --}}
