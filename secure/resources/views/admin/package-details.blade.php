<!-- Button trigger modal -->
<!-- Modal -->
<style>
    tr ,td{
        height: 42px;
	}
		.modal {
	position: fixed;
	top: 0;
	left: 0;
	z-index: 1060;
	display: none;
	width: 100%;
	height: 100%;
	overflow-x: hidden;
	overflow-y: auto;
	outline: 0;
	background: rgb(7, 41, 96,0.5);
    }
</style>
<div class="modal fade mytutremcls show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="display:block">
    <div class="modal-dialog mytutremcls" style="max-width:800px!important">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header mytutremcls text-center">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center; width:100%;">Package Details</h5>
                {{-- <button type="button" class="btn-close myclosenbtn" data-bs-dismiss="modal">

                </button> --}}
            </div>
            <div class="modal-body mytutremcls">
                <div class="container  bg-white">
                    {{-- <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8  px-3">

                        </div>
                    </div> --}}
                    
                       <!-- <h2 class="fw-normal fs-3 blue-text mt-3"></h2>-->
                       
                        <div class="table-responsive">
                            <table  class="table table-striped table-hover">
                                <thead>
                                    
                                </thead>
                                <tbody>
                                    <tr class="my">
                                        <td width="50%"><strong> Package Title </strong> </td>
                                        <td>   {{ ucfirst($package->package_title) }}</td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Package Description </strong></td>
                                        <td>   {{ ucfirst($package->package_description) }}</td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Package price </strong> </td>
                                        <td>  <span class="badge badge-info rounded-pill d-inline">{{ $package->price }}</span></td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Package Expiry </strong></td>
                                        <td>   <span class="badge badge-info rounded-pill d-inline">{{ $package->package_expiry }} </span></td>
                                    </tr>

                                    <tr class="my">
                                        <td width="40%"><strong> Package Status </strong></td>
                                        <td>  
                                            @if ($package->status == 2)
                                                <span class="badge badge-danger rounded-pill d-inline">In-active</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Package Type </strong></td>
                                        <td>  
                                            @if ($package->type == 2)
                                                <span class="badge badge-primary rounded-pill d-inline">Premium</span>
                                            @else
                                                <span class="badge badge-warning rounded-pill d-inline">Free</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="my">
                                        <td width="40%"><strong> Tip Enabled </strong></td>
                                        <td>  
                                            @if ($package->tip_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Blog Enabled </strong></td>
                                        <td>  
                                            @if ($package->blog_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Podcast Enabled </strong></td>
                                        <td>  
                                            @if ($package->podcast_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Video Enabled </strong></td>
                                        <td>  
                                            @if ($package->video_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Movements Enabled </strong></td>
                                        <td>  
                                            @if ($package->movements_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Log Sharing Enabled </strong></td>
                                        <td>  
                                            @if ($package->log_sharing_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Cycle Length Report Enabled </strong></td>
                                        <td>  
                                            @if ($package->cycle_length_report_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Mood Report Enabled </strong></td>
                                        <td>  
                                            @if ($package->mood_report_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Energy Report Enabled </strong></td>
                                        <td>  
                                            @if ($package->energy_report_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="my">
                                        <td width="40%"><strong> Generay Report Enabled </strong></td>
                                        <td>  
                                            @if ($package->general_report_enabled == 0)
                                                <span class="badge badge-dark rounded-pill d-inline">Disabled</span>
                                            @else
                                                <span class="badge badge-success rounded-pill d-inline">Enabled</span>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

</div>
                      
                   

                    {{-- <div class="row">
                        <div class="col-md-12 mt-5">

                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
    <script>
        $('.tutpr').html = '';
        $('.myclosenbtn').on('click', function() {
            $('.mytutremcls').hide();
            $('.tutpr').html = '';
            $('body').css('overflow', 'scroll');
            $('.mytutremcls').css("display:none");
        });

        var mouse_is_inside = false;
        // $(document).ready(function()
        // {
        $('.mytutremcls').hover(function() {
            mouse_is_inside = true;
        }, function() {
            mouse_is_inside = false;
        });

        $(".tutpr").mouseup(function() {
            if (!mouse_is_inside) $('.mytutremcls').hide();
            $('.tutpr').html = '';
            $('body').css('overflow', 'scroll');
        });
        // });
    </script>
