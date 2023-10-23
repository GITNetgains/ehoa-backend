<x-header titletext="list category" />
<section role="main" class="content-body">

    <header class="page-header">

        <h2>Category</h2>



        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Category lists</span></li>

            </ol>

            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>
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
    {{-- start here  --}}



    <div class="row">

        <div class="col">
            <section class="card">

                <header class="card-header">
                    <h2 class="card-title" style="text-align:center;">Category list</h2>

                </header>

                <div class="card-body">
                   <div class="table-responsive">

                    <table class="table table-striped table-bordered table-responsive-md mb-0">

                        <thead>

                            <tr style="text-align:center;">

                                <th>Sr.no</th>

                                <th>Image</th>

                                <th>Name</th>

                                <th>Description</th>

                                <th>Status</th>

                                <th width="20%">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @isset($mydata)

                                @php $sr=1 @endphp

                                @if (count($mydata) > 0)
                                    @foreach ($mydata as $data)

                                        <tr>

                                            <td>

                                                {{ $sr }}

                                            </td>

                                            <td style="text-align:center;">

                                                <img src="{{ env('APP_URL') }}{{ $data->category_image }}"
                                                    alt="categoryimage" style="height:58px;border-radius:6px;">

                                            </td>

                                            <td>

                                                {{ $data->category_name }}

                                            </td>

                                            <td style="text-align:center;">

                                                {{ $data->category_info }}

                                            </td>

                                            <td style="text-align:center;">
                                                @if ($data->status == 2)
                                                    <span class="badge text-danger badge-dan  d-inline">In-Active</span>
                                                    @endif @if ($data->status == 3)
                                                        <span class="badge text-danger badge-dan  d-inline">Deleted</span>
                                                        @endif @if ($data->status == 1)
                                                            <span class="badge text-success badge-suc d-inline">Active</span>
                                                        @endif
                                            </td>
                                            <td style="text-align:center;" class="actions">

                                                <a href="{{ '/admin/n-edit-category' }}/{{ $data->category_id }}"
                                                    class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>

                                                <a href="{{ '/admin/n-delete-category' }}/{{ $data->category_id }}/2"
                                                    onclick="return confirm('Do you really want delete if you delete parent category the child also delete!')"
                                                    class="btn-sm btn-del text-white mx-1 my-1">Delete</a>

                                            </td>

                                        </tr>
                                        {{-- sub cate here  --}}

                                        @isset($subcategories)
                                            {{-- @php $sr++ @endphp --}}

                                            @foreach ($subcategories as $subcategory)
                                                @if ($subcategory->parent_type == $data->category_id)
                                                    <tr>

                                                        <td>

                                                            <?php  echo $sr+1; ?>

                                                        </td>

                                                        <td style="text-align:center;">

                                                            <img src="{{ env('APP_URL') }}{{ $subcategory->category_image }}"
                                                                alt="categoryimage" style="height:58px;border-radius:6px;">

                                                        </td>

                                                        <td>

                                                            {{ $subcategory->category_name }}

                                                        </td>

                                                        <td style="text-align:center;">

                                                            {{ $subcategory->category_info }}

                                                        </td>

                                                        <td style="text-align:center;">
                                                            @if ($subcategory->status == 2)
                                                                <span class="badge text-danger badge-dan  d-inline">In-Active</span>
                                                                @endif @if ($subcategory->status == 3)
                                                                    <span class="badge text-danger badge-dan  d-inline">Deleted</span>
                                                                    @endif @if ($subcategory->status == 1)
                                                                        <span class="badge text-success badge-suc d-inline">Active</span>
                                                                    @endif
                                                        </td>

                                                        <td style="text-align:center;" class="actions">

                                                            <a href="{{ '/admin/n-edit-category' }}/{{ $subcategory->category_id }}"
                                                                class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>

                                                            <a href="{{ '/admin/n-delete-category' }}/{{ $subcategory->category_id }}/1"
                                                                onclick="return confirm('o you really want to delete {{ $subcategory->category_name }}  this Parent Category? ')"
                                                                class="btn-sm btn-del text-white mx-1 my-1">Delete</a>

                                                        </td>

                                                    </tr>
                                                    <?php $sr++;
                                                    continue;
                                                    ?>
                                                @endif
                                            @endforeach
                                        @endisset
                                        {{-- end subcat here  --}}


                                        @php($sr++)
                                    @endforeach
                                @endif

                            @endisset

                        </tbody>

                    </table>

</div>

                </div>

            </section>

        </div>

    </div>



    {{-- end here  --}}





</section>

{{-- --start podcast-- --}}



</div>





<x-footer />
