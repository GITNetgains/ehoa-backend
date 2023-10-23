<x-header titletext="create tip"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
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
                <li><span>Packages Setting</span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}
    @if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
    @endif
    <section class="card">
        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/save-tips'}}" method="post">
                @csrf

                <section class="card">
                    <header class="card-header">
                      
                        <h2 class="card-title" style="text-align:center;">Create Tips</h2>
                    </header>
                    <div class="card-body">

                    <div class="card-body">
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" placeholder="Maximum limit of the characters 30" name="title" value="{{old('title')}}" class="form-control" >
                                <span class="text-danger">
                                    @error('title')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                    <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Energy <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"  value="{{old('energy_id')}}" id="energy_id" name="energy_id">
                                        <option value="">Choose Energy</option>
                                        @isset($mood_disorders)
                                        @foreach($mood_disorders as $energy)
                                        <option value="{{$energy->disorders_id}}">
                                        {{$energy->name}}
                                        </option>
                                        @endforeach
                                        @endisset
                                </select>
                                <span class="text-danger">
                                    @error('energy_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub Energy </label>
                            <div class="col-sm-6">
                                <select class="form-control"  value="{{old('sub_energy_id')}}" id="sub_energy_id" name="sub_energy_id">
                                        <option value="">Choose Sub Energy</option>
                                        @isset($sub_energy)
                                        @foreach($sub_energy as $energy)
                                        <option value="{{$energy->sub_energy_id}}">
                                        {{$energy->sub_energy}}
                                        </option>
                                        @endforeach
                                        @endisset
                                </select>
                               
                            </div>
                        </div>
                       

                         <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Language <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="language_id" id="language_id" value="{{ old('language_id')}}" class="form-control select" >
                                    <option value="">Choose Language</option>
                                    <option value="1" @if( old('language_id')==1) selected @endif>English</option>
                                    <option value="2" @if( old('language_id')==2) selected @endif>Māori</option>
                                </select>
                                <span class="text-danger">
                                    @error('language_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                       


                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control"   value="{{old('category_id')}}" id="category_id" name="category_id">
                                        <option value="">Choose Category</option>
                                        
                                        @isset($categorys)
                                        @foreach($categorys as $category)
                                        <option value="<?php if($category->status==1){echo $category->category_id;} else{} ?>">
                                        {{$category->category_name}}
                                        </option>
                                        @endforeach
                                        @endisset
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>

                       

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Sub-Category <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" value="{{old('subcategory_id')}}"  id="subcategory_id" name="subcategory_id">
                                    <option value="">Choose Sub-Category</option>
                              </select>
                              <span class="text-danger">
                                @error('subcategory_id')
                                {{$message}}
                            @enderror
                            </span>
                            </div>
                           
                        </div>

                      <div class="form-group row mb-3">
    <label class="col-sm-4 control-label text-sm-end pt-2">Image <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        <input type="file" name="image" id="image" value="{{ old('image') }}" aria-describedby="" class="form-control" placeholder="Upload an image (1:1 ratio or 450px x 450px)" accept="image/*">
        <span style="font-size: 12px;">Upload an image (1:1 ratio or 450px x 450px)</span>
        <span class="text-danger">
            @error('image')
            {{$message}}
            @enderror
        </span>
    </div>
</div>



                    

                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                            <textarea type="text" placeholder="Maximum limit of the characters 250" name="description" id="description"  aria-describedby=""  class="form-control" placeholder="" accept="image/*">{{ old('description')}}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                @enderror
                                </span>
                              
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Gender <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="gender_id[]" multiple  id="gender_id" value="{{ old('gender_id[]')}}" class="form-control select" >
                                    <option value="">Choose Gender</option>
                                    <option value="1" @if( old('gender_id')==1) selected @endif>Male</option>
                                    <option value="2" @if( old('gender_id')==2) selected @endif>Female</option>
                                    <option value="3" @if( old('gender_id')==3) selected @endif>Other</option>
                                </select>
                                <span class="text-danger">
                                    @error('gender_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Focus <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="focus_id[]" multiple  id="focus_id" value="{{ old('focus_id[]')}}" class="form-control select" >
                                    <option value="">Choose focus</option>
                                    <option value="1" @if( old('focus_id')==1) selected @endif>Track Menstrual cycle</option>
                                    <option value="2" @if( old('focus_id')==2) selected @endif>Track energy levels</option>
                                </select>
                                <span class="text-danger">
                                    @error('focus_id')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                       
                        

                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="status" id="status" value="{{ old('status')}}" class="form-control select" >
                                    <option value="">Choose Status</option>
                                    <option value="1" @if( old('status')==1) selected @endif>Active</option>
                                    <option value="2" @if( old('status')==2) selected @endif>In Active</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                    <footer class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Create Tip</button>

                    </footer>
                    </div>
                </section>
            </form>
        </div>
        {{-- end here  --}}


    </section>
{{----start podcast----}}

    </div>
<x-footer/>

<script>
    $('#category_id').on('change',function(e){
        
        e.preventDefault();
        $('#subcategory_id').html('');
       
        var category_id  = $('#category_id').val();
    //  alert (category_id );
        if(category_id ==''){
            var data=' <option value="">Choose sub category</option>';
	       $('#subcategory_id').append(data);
        } else{
            
            $('#subcategory_id').html('');
        }
        var host = "{{URL::to('/')}}";
        $.ajax({
            type: "POST",
            data: {
            "_token": "{{ csrf_token() }}",
             "category_id": category_id,
           
        },
         url: host+'/admin/get-tips-sub-categories',
        }).done(function(response) {
         console.log(response.get_data);  
		 $.each(response.get_data, function(index, element){
            var data=' <option value="'+element.category_id +'">'+element.category_name+'</option>';
	       $('#subcategory_id').append(data);
		 });
        });	
    });
    $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var minDate= year + '-' + month + '-' + day;

    $('#expiry').attr('min', minDate);
});
</script>
