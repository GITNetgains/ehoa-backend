<x-header titletext="Edit Groups"/>
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
                <li><span>Update Groups</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}

    <section class="card">

        <div class="col-lg-12">
            <form id="" class="form-horizontal" action="{{'/groups/update-groups'}}" method="post" enctype="multipart/form-data">
                @csrf
                <section class="card">
                    <header class="card-header">
                       

                        <h2 class="card-title" style="text-align:center;">Update Groups</h2>
                    </header>
                    @foreach($groups as $group)
                    <input type="hidden" name="id" value="{{$group->g_id}}">
                    <div class="card-body">
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Group Name <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="group_name" value="{{old('group_name',$group->group_name)}}" class="form-control" >
                                <span class="text-danger">
                                    @error('group_name')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span> </label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control" >
                                    <option value="">Choose Status</option>
                                    <option value="1" @if(old('status',$group->status==1)) selected @endif>Active</option>
                                    <option value="2" @if(old('status',$group->status==2)) selected @endif>Deactive</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update</button>
                        {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                    </footer>
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>
    </div>
<x-footer/>
