<x-header titletext="Update Order"/>

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

                <li><span>Order Update</span></li>

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

    <section class="card">



        <div class="col-lg-12">

            <form id="form" class="form-horizontal" enctype="multipart/form-data" action="{{'/update-order'}}" method="post">

                @csrf



                <section class="card">

                    <header class="card-header">

                       

                        <h2 class="card-title" style="text-align:center;">Update Order</h2>

                    </header>

                    <div class="card-body">

                        @foreach($orders as $podc)



                        <input type="hidden" name="id" value="{{$podc->order_id}}">

                       

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Users</label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="user_id" name="user_id">



                                        @isset($users)

                                        @foreach($users as $use)

                                        <option value="{{$use->user_id}}" @if($podc->user_id == $use->user_id) selected @endif >

                                        {{$use->name}}

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

                            <label class="col-sm-4 control-label text-sm-end pt-2">Package</label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="package_id" name="package_id">

                                    @isset($packages)

                                    @foreach($packages as $user)

                                    <option value="{{$user->package_id}}" @if($podc->package_id == $user->package_id) selected @endif >

                                    {{$user->package_title}}

                                    </option>

                                    @endforeach

                                    @endisset

                            </select>

                            <span class="text-danger">

                                @error('package_id')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Transaction Id</label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" value="{{$podc->transaction_id}}" id="transaction_id" name="transaction_id">

                            <span class="text-danger">

                                @error('transaction_id')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Coupons</label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" value="{{$podc->coupons_details}}" id="coupons_details" name="coupons_details">

                            <span class="text-danger">

                                @error('coupons_details')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Payment</label>

                            <div class="col-sm-6">

                                <select class="form-control"  id="payment" name="payment">

                                  

                                    <option value="PayPal" @if($podc->payment == 'PayPal') selected @endif >

                                        PayPal

                                    </option>

                                    <option value="Credit" @if($podc->payment == 'Credit') selected @endif >

                                        Credit Card

                                    </option>

                                    <option value="UPI" @if($podc->payment == 'UPI') selected @endif >

                                        UPI

                                    </option>

                                    

                            </select>

                            <span class="text-danger">

                                @error('payment')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Expiry Date</label>

                            <div class="col-sm-6">

                                <input type="date" class="form-control" value="{{$podc->package_expiry_date}}" id="package_expiry_date" name="package_expiry_date">

                            <span class="text-danger">

                                @error('package_expiry_date')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2">Start Date</label>

                            <div class="col-sm-6">

                                <input type="date" class="form-control" value="{{$podc->package_start_date}}" id="package_start_date" name="package_start_date">

                            <span class="text-danger">

                                @error('package_start_date')

                                {{$message}}

                            @enderror

                            </span>

                            </div>

                        </div>

                        <div class="form-group row pb-3">

                            <label class="col-sm-4 control-label text-sm-end pt-2 form-label select-label">Status </label>

                            <div class="col-sm-6">

                            <select name="status" id="status" class="form-control select" >  

                                <option value="0" @if($podc->status == 0) selected @endif>Choose Status</option>

                                        <option value="1" @if($podc->status == 1) selected @endif >On Hold</option>

                                        <option value="2" @if($podc->status == 2) selected @endif>Processing</option>

                                        <option value="3" @if($podc->status == 3) selected @endif>Completed</option>

                                        <option value="4" @if($podc->status == 4) selected @endif>Canceled</option>

                                        <option value="5" @if($podc->status == 5) selected @endif>Pending Payment</option>

                                    </select>

                                    <span class="text-danger">

                                    @error('status')

                                    {{$message}}

                                @enderror

                                </span>

                            </div>

                        </div>

                    <footer class="card-footer text-end">

                        <button class="btn btn-primary" type="submit">Update </button>



                    </footer>

                    @endforeach

                </section>

            </form>

        </div>

        {{-- end here  --}}





    </section>

{{----start podcast----}}







    </div>

<x-footer/>

