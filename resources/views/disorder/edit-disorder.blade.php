<x-header titletext="Update Mood disorders" />
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
                <li><span>Update</span></li>
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
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <section class="card">
        @if ($mood_disorders->disorders_type == 3)
            <div class="col-lg-12">
                <form id="form1" class="form-horizontal" enctype="multipart/form-data"
                    action="{{ '/update-disorders' }}" method="post">
                    @csrf

                    <input type="hidden" name="id" value="{{ $mood_disorders->disorders_id }}">
                    <section class="card">

                        <header class="card-header">

                            <h2 class="card-title" style="text-align:center">Update </h2>
                        </header>
                        <div class="card-body">
                            <div class="form-group row pb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Disorder Type <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="disorders_type" name="disorders_type">
                                        <option value="3">Symtoms</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name"
                                        value="{{old('name', $mood_disorders->name )}}" class="form-control">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Icon <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ $mood_disorders->icon }}" type="file"
                                        name="icon">
                                    <span class="text-danger">
                                        @error('icon')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <image class="my-3" src="{{ env('APP_URL') }}/{{old('icon', $mood_disorders->icon) }}"
                                        alt="" style="height:58px;border-radius:6px;">
                                </div>
                            </div>
                            <div class="form-group row mb-3">

                                <label class="col-sm-4 control-label text-sm-end ">Primary <span class="text-danger">*</span></label>

                                <div class="col-sm-6">
                                    <input type="checkbox" class="form-check-input" @if(old('primary',$mood_disorders->primary == 'primary')) checked @endif value="primary" name="primary">
                                    <span class="text-danger">
                                        @error('primary')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>

                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control select" required>
                                        <option value="0" >Choose
                                            Status</option>
                                        <option value="1" @if(old('status',$mood_disorders->status == 1)) selected @endif>Active
                                        </option>
                                        <option value="2" @if(old('status',$mood_disorders->status == 2)) selected @endif>In
                                            Active</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                            <footer class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Update</button>

                            </footer>
                    </section>

                </form>
            </div>
        @else
            <div class="col-lg-12">
                <form id="form1" class="form-horizontal" enctype="multipart/form-data"
                    action="{{ '/update-disorders' }}" method="post">
                    @csrf

                    <input type="hidden" name="id" value="{{ $mood_disorders->disorders_id }}">
                    <section class="card">

                        <header class="card-header">

                            <h2 class="card-title" style="text-align:center">Update </h2>
                        </header>
                        <div class="card-body">
                            <div class="form-group row pb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Disorder Type <span class="text-danger">*</span> </label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="disorders_type" name="disorders_type">

                                        <?php if($mood_disorders->disorders_type == 1){?>
                                        <option value="1">Menstrual Flow</option>
                                        <?php
                                           } 
                                            ?>
                                        <?php if($mood_disorders->disorders_type == 2){?>
                                        <option value="2">Symptoms</option>
                                        <?php
                                                } 
                                                 ?>

                                        <?php if($mood_disorders->disorders_type == 4){?>
                                        <option value="4">Energy</option>
                                        <?php
                                            } 
                                             ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name"
                                        value="{{old('name',$mood_disorders->name)}}" class="form-control">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2">Icon <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ $mood_disorders->icon }}" type="file"
                                        name="icon">
                                    <span class="text-danger">
                                        @error('icon')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <image class="my-3" src="{{ env('APP_URL') }}/{{ old('icon',$mood_disorders->icon) }}"
                                        alt="" style="height:58px;border-radius:6px;">
                                </div>
                            </div>

                            <div class="form-group row pb-3">
                                <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control select" required>
                                        <option value="0" @if(old('status',$mood_disorders->status == 0)) selected @endif>Choose
                                            Status</option>
                                        <option value="1" @if(old('status',$mood_disorders->status == 1)) selected @endif>Active
                                        </option>
                                        <option value="2" @if(old('status',$mood_disorders->status == 2)) selected @endif>In
                                            Active</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                            <footer class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Update</button>

                            </footer>
                    </section>

                </form>
            </div>
        @endif
        {{-- end here  --}}


    </section>

    </div>
    <x-footer />
