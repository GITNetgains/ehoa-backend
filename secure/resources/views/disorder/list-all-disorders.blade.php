<x-header titletext="List Disorders"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Disorders List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>List</span></li>
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
                

                <h2 class="card-title">List </h2>

            </header>

            <div class="card-body" style="display: block;">
                {{-- <a class="text-light btn btn-primary " href="{{'/disorder/disorders-create'}}"> Create Disorder</a> --}}

                <table class="table  table-responsive-md mb-0">
                    <thead>
                        <tr>

                            <th width="10%">Sr.No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if (count($mood_disorders) > 0)
                            @foreach ($mood_disorders as  $key)
                                <tr style="background-color:rgb(215, 215, 215);">
                                    <td>{{ $i++ }}</td>
                                    <td><?php if($key->disorders_type==1){
                                         echo('Menstrual Flow');
                                    }
                                            if($key->disorders_type==3){
                                                echo('Emotions');
                                            }
                                                if($key->disorders_type==4){
                                                echo('Energy');
                                            }
                                            if($key->disorders_type==2){
                                            echo('Symptoms'); }?>
                                    </td>
                                    <td>{{ $key->name}}</td>
                                    <td><img src="{{env('APP_URL')}}/{{ $key->icon}}" style="height:58px;border-radius:6px;"></td>
                                    <td>@if($key->status==2)<span class="badge badge-danger rounded-pill d-inline">In-Active</span> @else <span class="badge badge-success rounded-pill d-inline">Active</span> @endif</td>
                                    <td> <a href="/disorder/edit-disorder/{{$key->disorders_id}}" class="btn btn-primary mx-2 btn-sm">Edit</a>
                                <a href="/disorder/delete-disorders/{{$key->disorders_id }}"
                                    class="btn btn-danger btn-sm"
                                    onclick="confirm('DO you really delete this !')">Delete</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No Data Found</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
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
