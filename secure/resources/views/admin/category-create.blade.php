<x-header titletext="create category"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Category Create</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}

    <section class="card">

        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-category'}}" method="post">
                @csrf

                <section class="card">

                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
                        </div>
                        <h2 class="card-title">Create Category</h2>
                    </header>
                    <div class="card-body">

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Category name</label>
                            <div class="col-sm-6">
                                <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control" required>
                                <span class="text-danger">
                                    @error('category_name')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Parent</label>
                            <div class="col-sm-6">
                            <select name="parent_type" id="parent_type" class="form-control select" >

                                        <option value="0" selected>Main Category</option>
                                        @if (count($categoryget) > 0)
                                        @foreach ($categoryget as  $key)
                                        <option value="{{$key->c_id}}"><strong style="color:#000000;">{{$key->category_name}}</strong></option>
                                          @if(isset($sub_categories)>0)
                                            @foreach($sub_categories as $category)
                                            @if($category->sub_parent_type ==1)
                                            @if ($category->cat_id == $key->c_id)
                                           <option value="{{$category->sub_cat_id}}"><strong style="padding-left:10%;color:#8c4a4a;">&nbsp;&nbsp;&nbsp;* {{$category->sub_cat_name}}</strong></option>

                                           @endif
                                           @else
                                           {{-- @if ($yoga->sub_y_id == $key->y_id)
                                           <option value="{{$yoga->s_y_id}}"><strong style="padding-left:10%;color:#8c4a4a;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;** {{$yoga->sub_yoga_description}}</strong></option>

                                           @endif --}}
                                          @endif


                                            @endforeach
                                            @endif
                                       @endforeach
                                             @endif


                                    </select>
                                    <span class="text-danger">
                                    @error('parent_type')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Description</label>
                            <div class="col-sm-6">
                                <textarea  name="category_info" id="category_info" value="{{ old('category_info') }}"  class="form-control" placeholder=""></textarea>
                                <span class="text-danger">
                                    @error('category_info')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status</label>
                            <div class="col-sm-6">
                            <select name="status" id="status" class="form-control select" >

                                        <option value="0" selected>Choose Status</option>
                                        <option value="1" selected>Active</option>
                                        <option value="2" selected>In-Active</option>

                                    </select>
                                    <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Create Category</button>

                    </footer>
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>
{{----start podcast----}}

    </div>
   =

<x-footer/>
