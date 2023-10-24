<x-header titletext="View Orders"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Order Details</h2>

        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Orders Details</span></li>

            </ol>

            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>



	<form class="order-details action-buttons-fixed" method="post">

						<div class="row">

							<div class="col-xl-4 mb-4 mb-xl-0">

						

								<div class="card card-modern">

									<div class="card-header">

										<h2 class="card-title">General</h2>

									</div>

									<div class="card-body">

										<div class="form-row">

											<div class="form-group col mb-3">

												<label>Status</label>

												<select class="form-control form-control-modern select2-hidden-accessible" name="orderStatus" required="" data-select2-id="1" tabindex="-1" aria-hidden="true">

                                                    @if(isset($orders))

                                                @foreach($orders as $order)

                                                <option value="0" @if($order->status == 0) selected @endif>Choose Status</option>

                                                <option value="1" @if($order->status == 1) selected @endif >On Hold</option>

                                                <option value="2" @if($order->status == 2) selected @endif>Processing</option>

                                                <option value="3" @if($order->status == 3) selected @endif>Completed</option>

                                                <option value="4" @if($order->status == 4) selected @endif>Canceled</option>

                                                <option value="5" @if($order->status == 5) selected @endif>Pending Payment</option>

                                                    @endforeach 

                                                    @endif

												</select>

											</div>

										</div>

										

										<div class="form-row">

											<div class="form-group col mb-3">

												<label>Customer</label>

												<select class="form-control form-control-modern select2-hidden-accessible" name="orderCustomer" required="" data-plugin-selecttwo="" data-select2-id="4" tabindex="-1" aria-hidden="true">

												

												

                                                    @isset($users)

                                                    @foreach($users as $use)

                                                    <option value="{{$use->user_id}}" @if($order->user_id== $use->user_id) selected @endif >

                                                    {{$use->name}}

                                                    </option>

                                                    @endforeach

                                                    @endisset

											

												</select>

											</div>

										</div>

									</div>

								</div>



							</div>

							<div class="col-xl-8">



								<div class="card card-modern">

									<div class="card-header">

										<h2 class="card-title">Users Details</h2>

									</div>

									<div class="card-body">

										@isset($users)

										@foreach($users as $use)

										<p>@if($order->user_id== $use->user_id) User Email  : {{$use->email}} @endif </p>

										

										@endforeach

										@endisset

								        {{-- @isset($countries)

										@foreach($countries as $count)

										<p> @if($order->country_id == $count->country_id) Country : {{$count->country_name}} @endif </p>

										

										@endforeach

										@endisset

										 --}}

									</div>

								

								</div>

						

							</div>

						</div>

						<div class="row">

							<div class="col">



								<div class="card card-modern  mt-3 mb-3">

									<div class="card-header">

										<h2 class="card-title">Packages</h2>

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table class="table table-striped table-bordered table-responsive-md mb-0" style="min-width: 380px;">

												<thead>

													<tr>

														<th width="8%" class="ps-4">ID</th>

														<th width="40%">Package</th>

														<th width="10%" class="text-end">Type</th>

														<th width="12%" class="text-end">Cost</th>

                                                     

													</tr>

												</thead>

												<tbody>

												@if(isset($orders))

                                                @foreach($orders as $order)

													<tr>

												

														<td class="ps-4"><strong>{{$order->order_id}}</strong></td>

														<td><strong>@if(isset($packages))

                                                            @foreach($packages as $pack)

                                                                @if($pack->package_id==$order->package_id)

                                                                    {{$pack->package_title}}

                                                               @endif  @endforeach  @endif</strong></td>

														<td class="text-end">@if(isset($packages))

                                                            @foreach($packages as $pack)

                                                                @if($pack->package_id==$order->package_id)

                                                                    {{$pack->type}}

                                                               @endif  @endforeach  @endif</td>

														<td class="text-end">@if(isset($packages))

                                                            @foreach($packages as $pack)

                                                                @if($pack->package_id==$order->package_id)

                                                                    {{$pack->price}} {{env('CURRENCY')}}

                                                               @endif  @endforeach  @endif</td>

														

                                                        

													</tr>

                                                    @endforeach

													@endif

													

												</tbody>

											</table>

											

							

										</div>



									</div>

								</div>

							

							</div>

						</div>

					

		

					</form>

    <x-footer />