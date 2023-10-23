<x-header titletext="Editior Update" />

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

      
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


<section role="main" class="content-body">
    <header class="page-header">
        <h2>Create Editior</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Update Editior</span></li>
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
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="col-lg-12">
        <form id="form1" class="form-horizontal" action="{{ '/update-editior' }}" enctype="multipart/form-data"
            method="post">
            @csrf
            <section class="card">
                <header class="card-header">
                   

                    <h2 class="card-title " style="text-align:center;">Update CMS</h2>
                </header>
<input type="hidden" name="id" value="{{$cms->id}}">
                    <h2 class="card-title" style="text-align:center;"></h2>
                    <div class="card-body">
                        <div class="form-group row pb-3">
                            <div class="col-sm-12">
    
                                <input type="text" name="title" id="title" placeholder="Enter Title" value="{{$cms->title}}" class="form-control" autocomplete="off">
                                <span class="text-danger">
                                    @error('title')
                                    {{$message}}
                                @enderror</span>
                            </div>
                        </div>

                    
                        <div class="form-group row pb-3">
                            <div class="col-sm-12">
    
                                <input type="text" name="short_description" id="short_description" placeholder="Enter Short Description" value="{{$cms->short_description}}" class="form-control" autocomplete="off">
                                <span class="text-danger">
                                    @error('short_description')
                                    {{$message}}
                                @enderror</span>
                            </div>
                        </div>
                 
                        <div class="form-group row pb-3">
                            <div class="col-sm-12">
                            <textarea class="ckeditor form-control"  id="long_description" name="long_description" >{{$cms->long_description}}</textarea>
                            <span class="text-danger">
                                @error('long_description')
                                {{$message}}
                            @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <div class="col-sm-12">
    
                                <input type="text" name="slug" id="slug" placeholder="Enter Slug" value="{{$cms->slug}}" class="form-control"  autocomplete="off">
                                <span class="text-danger">
                                    @error('slug')
                                    {{$message}}
                                @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <div class="col-sm-12">
    
                                <select name="status" class="form-control" >
                                    <option value="">Choose Status</option>
                                    <option value="1" @if($cms->status==1) selected @endif>Active</option>
                                    <option value="2" @if($cms->status==2) selected @endif>Deactive</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror</span>
                            </div>
                        </div>
                    </div>

              
                <footer class="card-footer text-end">

                    <button class="btn btn-primary" type="submit">Update</button>
                </footer>
            </section>
        </form>
    </div>
</section>

</div>
<x-footer />
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>