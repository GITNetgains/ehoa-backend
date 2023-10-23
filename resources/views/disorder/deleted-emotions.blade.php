<x-header titletext="List Disorders" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Emotions Deleted List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Emotions Deleted List</span></li>
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
                <h2 class="card-title" style="text-align:center;">List Emotions </h2>
              </header>

            <div class="card-body" style="display: block;">
                {{-- <a class="text-light btn btn-primary " href="{{'/disorder/disorders-create'}}"> Create Disorder</a> --}}
                <div class="row">

                    <div class="col-md-4">
                        <div class="badge bg-primary text-wrap" style="width: 6rem;">
                            Total Primay Emotions = {{ $count }}
                        </div>

                    </div>
                    <div class="col-md-4">
                        <a href="/deleted-emotions"><div class="badge bg-primary text-wrap" style="width: 6rem;">
                         Deleted
                        </div></a>

                    </div>
                    <div class="col-md-4 text-end">
                        <div class="badge bg-danger text-wrap" style="width: 6rem;">
                            Pending Emotions = <?php $total = 6 - $count;
                            echo $total; ?>
                        </div>

                    </div>


                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">

                            <th>Sr.No</th>
                            {{-- <th>Type</th> --}}
                            <th width="35%"> Name</th>
                            <th> Icon</th>
                            <th>Primary</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = $mood_disorders->perPage() * ($mood_disorders->currentPage() - 1) + 1; ?>
                        @if (count($mood_disorders) > 0)
                            @foreach ($mood_disorders as $key)
                                <tr style="">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ ucfirst($key->name) }}</td>
                                    <td style="text-align:center;"><img src="{{ env('APP_URL') }}/{{ $key->icon }}"
                                            style="height:40px;border-radius:6px;"></td>
                                    <td style="text-align:center;">
                                        @if ($key->primary == 'primary')
                                            <span
                                                class="badge text-primary d-inline">{{ ucfirst($key->primary) }}</span>
                                            @endif @if ($key->primary == 'not primary')
                                                <span
                                                    class="badge text-danger  d-inline">{{ ucfirst($key->primary) }}</span>
                                            @endif
                                    </td>
                                    <td style="text-align:center;">
                                        @if ($key->status == 2)
                                            <span class="badge text-danger  d-inline">In-Active</span>
                                            @endif @if ($key->status == 3)
                                                <span class="badge text-danger  d-inline">Deleted</span>
                                                @endif @if ($key->status == 1)
                                                    <span class="badge text-success  d-inline">Active</span>
                                                @endif
                                    </td>
                                    <td style="text-align:center;" class="actions">
                                        <a href="/disorder/edit-disorder/{{ $key->disorders_id }}"
                                            class="btn-sm btn-edit text-white mx-1">Edit</a>
                                        <a href="/disorder/delete-emotions/{{ $key->disorders_id }}"
                                            class="btn-sm btn-del text-white mx-1 my-1 "
                                            onclick="return confirm('Do you really want to delete {{ $key->name }}  this Emotion? ')">Delete</a>

                                    </td>
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

    {{ $mood_disorders->links('vendor.pagination.custom') }}
    </div>
    </div>
</section>

<div></div>
</div>

{{-- end here  --}}


</section>

</div>
<x-footer />

     