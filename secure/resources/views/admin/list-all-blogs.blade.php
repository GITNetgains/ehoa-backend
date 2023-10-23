<x-header titletext="list blogs" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Blog List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Blogs-List</span></li>
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
               

                <h2 class="card-title"  style="text-align:center;">List Blogs</h2>

            </header>

            <div class="card-body" style="display: block;overflow-x:scroll">
                @php($i = ($blogs->perPage() * ($blogs->currentPage() - 1)) + 1)
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th width="10%">Sr.No</th>
                            <th style="text-align:center;" width="20%">Title</th>
                            <th style="text-align:center;">Image</th>
                            <th style="text-align:center;" width="30%">Description</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @isset($blogs)
                            @if (count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td style="text-align:center;"><img src="{{ env('APP_URL') }}/{{ $blog->image }}"
                                                style="height:40px;border-radius:6px;"></td>
                                        <td>{{ $blog->description }}</td>
                                        
                                        <td style="text-align:center;">
                                            @if ($blog->status == 2)
                                                <span class="badge text-danger badge-dan  d-inline">In-active</span> @endif
                                            @if($blog->status == 1)
                                                <span class="badge text-success badge-suc  d-inline">Active</span>
                                            @endif
                                            @if($blog->status == 3)
                                            <span class="badge text-danger badge-dan  d-inline">Delete</span>
                                        @endif
                                        </td>
                                        <td style="text-align:center;"><a href="/admin/edit-blog/{{ $blog->blog_id }}" class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>
                                    <a href="/admin/delete-blog/{{ $blog->blog_id }}" class=" btn-sm btn-del text-white mx-1 my-1 delete-row"
                                        onclick="return confirm('Do you really want to delete {{$blog->title}} this Blogs?')">Delete</a>
                                    </td>
                                        
                                    {{-- </tr>
                                    @isset($slides)
                                        @foreach ($slides as $slide)
                                            @if ($slide->blog_id == $blog->blog_id)
                                                <tr>
                                                    <td></td>
                                                    <td>--{{ $slide->slide_title }}</td>
                                                    <td style="text-align:center;">
                                                        <img src="{{ env('APP_URL') }}/{{ $slide->slide_image }}"
                                                            style="height:40px;border-radius:6px;">
                                                    </td>
                                                    <td>{{ $slide->slide_description }}</td>
                                                    <td style="text-align:center;">
                                                        <a href="/admin/edit-blog-slide/{{ $slide->slide_id }}" class=""><i
                                                                class="fas fa-pencil-alt text-primary"></i></a>
                                                        <a href="/admin/delete-blog-slide/{{ $slide->slide_id }}"
                                                            class="text-danger delete-row"
                                                            onclick="return confirm('DO you really want delete this !')"><i
                                                                class="far fa-trash-alt"></i></a>
                                                    </td>
                                                    <td></td>
                                                    <td style="text-align:center;">
                                                        @if ($slide->product_url != null)
                                                            <a href="{{ $slide->product_url }}"
                                                                class="btn btn-sm btn-primary">Product</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endisset---}}
                                @endforeach
                                @else
                                <tr> 
                                    <td colspan="7" class="text-center">No Blog Found</td>
                                </tr>
                            @endif
                        @endisset

                    </tbody>

                </table>
                </div>
                
                {!! $blogs->links('vendor.pagination.custom') !!}
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
