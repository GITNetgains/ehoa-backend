<x-header titletext="create yoga"/>
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
                <li><span>Yogas Create</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}

    <section class="card">

        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/save-yogas'}}" method="post">
                @csrf

                <section class="card">

                    <header class="card-header">
                      
                        <h2 class="card-title">Create Yogas</h2>
                    </header>
                    <div class="card-body">

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Yoga Title: </label>
                            <div class="col-sm-6">
                                <input type="text" name="yoga_description" value="{{ old('yoga_description') }}" class="form-control" required>
                                <span class="text-danger">
                                    @error('yoga_description')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Parent : </label>
                            <div class="col-sm-6">
                            <select name="parent_type" id="parent_type" class="form-control select" >

                                        <option value="0" selected>Null</option>
                                        @if (count($yogaget) > 0)
                                        @foreach ($yogaget as  $key)
                                        <option value="{{$key->yoga_id}}"><strong style="color:#000000;">{{$key->yoga_description}}</strong></option>
                                        
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
                            <label class="col-sm-4 control-label text-sm-end pt-2">Description: </label>
                            <div class="col-sm-6">
                                <textarea  name="yoga_additional_info" id="yoga_additional_info" value="{{ old('yoga_additional_info') }}"  class="form-control" placeholder=""></textarea>
                                <span class="text-danger">
                                    @error('yoga_additional_info')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Podcast Image: </label>
                            <div class="col-sm-6">
                                <input type="file" name="yoga_image" id="yoga_image" value="{{ old('yoga_image') }}" aria-describedby=""  class="form-control" placeholder="" accept="image*/">
                                <span class="text-danger">
                                    @error('yoga_image ')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Tips Status: </label>
                            <div class="col-sm-6">
                                <select name="status" id="status" class="form-control select" >

                                    <option value="0" selected>Choose Status</option>
                                    <option value="1">Active</option>
                                <option value="2" >Deactive</option>
                                </select>
                               
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Create Yogas</button>

                    </footer>
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>
{{----start podcast----}}



    </div>
<x-footer/>
