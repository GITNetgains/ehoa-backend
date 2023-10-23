<x-header titletext="list users"/>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Compose</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="../index.html">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>coach</span></li>
                <li><span>compose</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- start here  --}}
    <section class="card">
        <header class="card-header">
            <div class="card-actions">
    
            </div>
    
            
        </header>
    
        <div class="card-body">
            <form class="form-horizontal form-bordered" method="post" action="{{'/save-user'}}">
                @csrf
                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Name</label>
                    <div class="col-lg-6">
                        <input type="text" name="username" class="form-control" id="inputDefault">
                        @error('username')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
    
                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Email</label>
                    <div class="col-lg-6">
                        <input type="email" name="email" class="form-control" id="inputDefault">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
    
    
                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Password</label>
                    <div class="col-lg-6">
                        <input type="password" name="password" class="form-control" id="inputDefault">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
    
                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Nick name</label>
                    <div class="col-lg-6">
                        <input type="text" name="nickname" class="form-control" id="inputDefault">
                        @error('nickname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>

                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Register</label>
                    <div class="col-lg-6">
                        <select class="form-control"  id="status" name="status">
                            <option value="0">Register</option>
                            <option value="1">Un-registered</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>

                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Term</label>
                    <div class="col-lg-6">
                        {{-- <input type="text" name="term_conditions" class="form-control" id="inputDefault"> --}}
                        <input type="checkbox" id="term_conditions" name="term_conditions">
                            <label for="term_conditions">Accept</label><br>
                            <input type="checkbox" id="term_conditions" name="term_conditions">
                            <label for="term_conditions">Accept</label><br>
                            <input type="checkbox" id="term_conditions" name="term_conditions">
                            <label for="term_conditions">Accept</label><br>
                        @error('term_conditions')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>

                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">understand</label>
                    <div class="col-lg-6">
                        <input type="checkbox" id="understand" name="understand">
                        <label for="understand">yes</label><br>
                        <input type="checkbox" id="understand" name="understand">
                        <label for="understand">no</label><br>
                        <input type="checkbox" id="understand" name="understand">
                        <label for="understand">never</label><br>
                        @error('understand')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>

                <div class="form-group row pb-4">
                    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">status</label>
                    <div class="col-lg-6">
                        <select class="form-control"  id="status" name="status">
                            <option value="1">Active</option>
                            <option value="2">De-active</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                       @enderror
                    </div>
                </div>
    
                <div class="text:end">
                <input type="submit" value="Submit" class="btn btn-primary btn-user btn-block">
                </div>
            </aside>
        </section>
    
    {{-- end here  --}}
</section>
</div>
<x-footer/>