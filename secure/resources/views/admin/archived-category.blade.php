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

                <li><span>Archived Category List</span></li>

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

    <div class="row">

        <div class="col">





            <section class="card">

                <header class="card-header">



                    <h2 class="card-title" style="text-align:center;">Archived Category List</h2>

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
                                                            <span
                                                                class="badge text-danger badge-dan  d-inline">Deleted</span>
                                                            @endif @if ($data->status == 1)
                                                                <span
                                                                    class="badge text-success badge-suc d-inline">Active</span>
                                                            @endif
                                                </td>
                                                <td style="text-align:center;" class="actions">

                                                    <a href="{{ '/undo-category' }}/{{ $data->category_id }}/2"
                                                        class="btn-sm btn-edit text-white mx-1 my-1">Undo</a>

                                                   
                                                </td>

                                            </tr>


                                            @isset($subcategories)
                                                @foreach ($subcategories as $subcategory)
                                                    @if ($subcategory->parent_type == $data->category_id)
                                                        <tr>
                                                            <td>
                                                                <?php echo $sr + 1; ?>
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <img src="{{ env('APP_URL') }}{{ $subcategory->category_image }}"
                                                                    alt="categoryimage" style="height:58px;border-radius:6px;">
                                                            </td>
                                                            <td>
                                                                {{ $subcategory->category_name }}</td>

                                                            <td style="text-align:center;">

                                                                {{ $subcategory->category_info }}

                                                            </td>

                                                            <td style="text-align:center;">
                                                                @if ($subcategory->status == 2)
                                                                    <span
                                                                        class="badge text-danger badge-dan  d-inline">In-Active</span>
                                                                    @endif @if ($subcategory->status == 3)
                                                                        <span
                                                                            class="badge text-danger badge-dan  d-inline">Deleted</span>
                                                                        @endif @if ($subcategory->status == 1)
                                                                            <span
                                                                                class="badge text-success badge-suc d-inline">Active</span>
                                                                        @endif
                                                            </td>

                                                            <td style="text-align:center;" class="actions">

                                                                <a href="{{ '/undo-category' }}/{{ $subcategory->category_id }}/1"
                                                                    class="btn-sm btn-edit text-white mx-1 my-1">Undo</a>

                                                          
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
