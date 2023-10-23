<x-header titletext="list tips"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tips List</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Tips-List</span></li>
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
                <h2 class="card-title col-md-8 " style="text-align:center;" >List Tips</h2>
                {{-- search start  --}}
                <div class="col-md-4 mb-1">
                    <form action="{{ '/searchcategory' }}" method="post" role="search" class="d-flex">
                        @csrf
                        <select class="form-control"  value="{{old('energy_id')}}" id="search"  placeholder="Search category..." name="search" >
                            <option value="">Search Category...</option>
                            @isset($categ)
                            @foreach($categ as $cat)
                            <option value="{{$cat->category_name}}">
                            {{$cat->category_name}}
                            </option>
                            @endforeach
                            @endisset
                    </select>
                       
                       
                      
                    </form>
                </div>
            </div>
                {{-- search end  --}}
            </header>
            <div class="card-body" style="display: block;">
             <div class="table-responsive">
                <table class="table table-striped table-bordered table-responsive-md mb-0">
                    <thead>
                        <tr style="text-align:center;">
                            <th >Sr.No</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Sub Categories</th>
                            <th>Energy</th>
                            <th >Description</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th  style="width:150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table_id">
                        <?php $i = ($tips->perPage() * ($tips->currentPage() - 1)) + 1; ?>
                    @isset($tips)
                        @if(count($tips) > 0)
                            @foreach ($tips as  $tip)
                           
                                <tr>
                                   
                                    <td>{{ $i++ }}</td>
                                    <td style="text-align:center;"><img src="{{env('APP_URL')}}/{{ $tip->image}}" style="height:40px;border-radius:6px;"></td>
                                    
                                    <td>{{ucfirst($tip->title)}}</td>
                                   
                                   <td style="text-align:center;">@foreach($categories as $key) @if($key->category_id==$tip->category_id) {{$key->category_name}} @endif @endforeach</td>
                                    <td style="text-align:center;">@foreach($categories as $key) @if($key->category_id==$tip->subcategory) {{$key->category_name}} @endif @endforeach</td>
                                    <td style="text-align:center;">@foreach($energy as $key) @if($key->disorders_id==$tip->energy_id) {{$key->name}} @endif @endforeach</td>
                                    <td style="text-align:left;">{{$tip->description}}</td>
                                    <td style="text-align:center;">{{$tip->expiry}}</td>
                                    <td style="text-align:center;">@if($tip->status==2)<span class="badge badge-dan text-danger  d-inline">In Active</span>@endif @if($tip->status==1)<span class="badge badge-suc text-success  d-inline">Active</span>@endif @if($tip->status==3) <span class="badge badge-dan text-danger d-inline"> Deleted</span>@endif </td>
                                <td style="text-align:center;" class=""><a href="/admin/edit-tips/{{$tip->tip_id }}" class="btn-sm btn-edit text-white mx-1 my-1">Edit</a>
                                        <a href="/admin/delete-tips/{{$tip->tip_id }}"  class="btn-sm btn-del text-white mx-1 my-1 "
                                            onclick="return confirm('Do you really want to delete {{$tip->title}}  this Tip? ')">Delete</a>
                              </td>
                                </tr>
                            
                            @endforeach
                            @endif
                            @endisset

                    </tbody>

                </table>
                
                </div>
                
            </div>

    </div>
    {{ $tips->links('vendor.pagination.custom') }}
</section>
<div></div>
</div>

{{-- end here  --}}


</section>

</div>
<x-footer />
<script>
    $('#search').on('change', function(e) {
        e.preventDefault();
        var search = $('#search').val();
        var host = "{{ URL::to('/') }}";
        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "search": search,
            },
            url: host + '/admin/search-tip-categories',
        }).done(function(response) {
            // console.log(response.get_data);  
            $('#table_id').html("");
            if(response.get_data == '') {
                $('#table_id').append("<tr><td colspan='10' class='text-center'>No Tips Found</td></tr>");
            } else {
               $('#table_id').append(response.get_data);
            }
      
    });
});

</script>