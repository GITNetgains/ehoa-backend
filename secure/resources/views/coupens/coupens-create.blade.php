<x-header titletext="Create Coupons"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
<style>

</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Coupons Create</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Coupons Create</span></li>
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
    <div class="col-lg-12">

            <section class="card">
                <header class="card-header">
                    
                    <h2 class="card-title" style="text-align:center;">Coupons Create</h2>
                </header>

<form id="form" class="form-horizontal" action="{{'/save-coupens'}}" method="post">
          @csrf
           
                    <div class="card-body">
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" autocomplete="off" >
                                <span class="text-danger">
                                    @error('name')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <textarea type="text" name="description" value="" class="form-control" autocomplete="off" >{{old('description')}}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Coupons <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="coupon" value="{{old('coupon')}}" class="form-control" autocomplete="off" >
                                <span class="text-danger">
                                    @error('coupon')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Expiry <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="date" name="expiry" id="expiry" value="{{old('expiry')}}" class="form-control" autocomplete="off" >
                                <span class="text-danger">
                                    @error('expiry')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Valid for <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="number" name="used_number_of_times" value="{{old('used_number_of_times')}}" class="form-control" autocomplete="off" >
                                <span class="text-danger">
                                    @error('used_number_of_times')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 control-label text-sm-end pt-2">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select name="status" id="status" value="" class="form-control select" >
                                    <option value="">Choose Status</option>
                                    <option value="1" @if (old('package_type') == 1) selected @endif>Active</option>
                                    <option value="2" @if (old('package_type') == 2) selected @endif>In Active</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                    {{$message}}
                                @enderror
                                </span>
                            </div>
                        </div>
 </div>
                <footer class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Create</button>
                </footer>
            </form>
            </section>

    </div>

    {{-- end here  --}}
</section>
</div>

<x-footer />

<script>
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

