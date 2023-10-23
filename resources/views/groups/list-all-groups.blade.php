<x-header titletext="List Groups"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>List Groups</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>list-Groups</span></li>
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
               
                <h2 class="card-title" style="text-align:center;">List Groups</h2>
            </header>
            <div class="card-body" style="display: block;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">
                            <th width="10%">Sr.No</th>
                            <th width="35%">Group</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = ($groups->currentpage() - 1) * $groups->perpage() + 1; ?>
                        @if(count($groups)>0)
                        @foreach($groups as $group)
                        <tr>
                          <td>{{$i++}}</td>
                            <td>{{ucfirst($group->group_name)}}</td>
                            <td style="text-align:center;">@if($group->status==2)<span class="badge badge-dan text-danger  d-inline">In-Active</span> @endif @if($group->status==3)<span class="badge text-danger badge-dan  d-inline">Deleted</span> @endif @if($group->status==1) <span class="badge badge-suc text-success d-inline">Active</span> @endif</td>
                            <td class="actions" style="text-align:center;">
                                <a href="/groups/edit-group/{{$group->g_id}}" class="btn-sm btn-edit text-white mx-1 ">Edit</a>
                                <a href="/groups/delete-group/{{$group->g_id}}"  class="btn-sm btn-del text-white mx-1 my-1  "
                                    onclick="return confirm('Do you really want to delete {{$group->group_name}}  this Group? ')">Delete</a>
                               
                            </td>
                        </tr>
                        @endforeach
@endif
                    </tbody>
                </table>
                </div>
            </div>
        </section>
        <div></div>
    </div>

    {{-- end here  --}}
    {{ $groups->links('vendor.pagination.custom') }}

</section>
</div>
<x-footer />

