<x-header titletext="list editior" />
<section role="main" class="content-body">

    <header class="page-header">

        <h2>Editior List</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Editior-List</span></li>

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
                    <h2 class="card-title col-md-12 " style="text-align:center;">List Editiors</h2>
                    {{-- search start  --}}

                </div>
                {{-- search end  --}}

            </header>

            <div class="card-body" style="display: block;">
 <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">

                    <thead>

                        <tr style="text-align:center;">

                            <th>Sr.No</th>

                            <th>Title</th>


                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $i = $cms->perPage() * ($cms->currentPage() - 1) + 1; ?>

                        @if (count($cms) > 0)

                            @foreach ($cms as $key)
                                <tr style="text-align:center;">

                                    <td>{{ $i++ }}</td>

                                    <td>{{ ucfirst($key->title) }}</td>




                                    <td style="text-align:center;">
                                        @if ($key->status == 2)
                                            <span class="badge text-danger d-inline">In-Active</span>
                                            @endif @if ($key->status == 3)
                                                <span class="badge text-danger  d-inline">Deleted</span>
                                                @endif @if ($key->status == 1)
                                                    <span class="badge text-success  d-inline">Active</span>
                                                @endif
                                    </td>
                                    <td style="text-align:center;" class="actions">
                                        <a href="/editior/view-editior/{{ $key->id }}"
                                            class="btn-sm btn-view text-white mx-1 my-1">View</a>
                                            <a href="/editior/edit-editior/{{ $key->id }}"
                                                class="btn-sm btn-edit text-white mx-1">Edit</a>
                                        {{-- <a href="/editior/delete-editior/{{ $key->id }}"
                                            class="btn-sm btn-del text-white mx-1 my-1 delete-row"
                                            onclick="return confirm('Do you really want to delete {{ ucfirst($key->title) }}  Page? ')">Delete</a> --}}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>

                                <td colspan="8" class="text-center">No CMS Page Found</td>

                            </tr>

                        @endif



                    </tbody>



                </table>
</div>
            </div>



    </div>
    {{ $cms->links('vendor.pagination.custom') }}
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
