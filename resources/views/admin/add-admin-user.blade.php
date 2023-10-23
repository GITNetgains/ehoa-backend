<x-header titletext="create category"/>

<section role="main" class="content-body">

    <header class="page-header">

        <h2>Category</h2>



        <div class="right-wrapper text-end">

            <ol class="breadcrumbs">

                <li>

                    <a href="/admin/dashboard">

                        <i class="bx bx-home-alt"></i>

                    </a>

                </li>

                <li><span>Admin</span></li>

                <li><span>Category-Create</span></li>

            </ol>

            <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>

        </div>

    </header>

    {{-- start here  --}}



    <section class="card">



        <div class="col-lg-12">
            <form id="create-admin" class="form-horizontal" enctype="multipart/form-data" action="{{'/admin/create-admin-user'}}" method="post">
                            @csrf
							<div class="form-group mb-3">
								<label>UserName</label>
								<div class="input-group">
									<input name="name" type="name" value="{{ old('name') }}" class="form-control form-control-lg" />
									<span class="text-danger">@error('name')
                                        {{$message}}
                                    @enderror
                                    </span>
								</div>
							</div>
                            <div class="form-group mb-3">
								<label>Email</label>
								<div class="input-group">
									<input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-lg" />
									<span class="text-danger">@error('email')
                                        {{$message}}
                                    @enderror
                                    </span>
								</div>
							</div>

							<div class="form-group mb-3">
                                <label>Password</label>
								<div class="input-group">
									<input name="password" type="password" class="form-control form-control-lg" />
									<span class="text-danger">@error('password')
                                        {{$message}}
                                        @enderror
                                    </span>
								</div>
							</div>

							<div class="row">

								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary mt-2">Sign Up</button>
								</div>
							</div>
						</form>

        </div>

        {{-- end here  --}}





    </section>

</div>

   



<x-footer/>

