<x-header titletext="detail user" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Details</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin/dashboard">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>User Details</span></li>
            </ol>
            <a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
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

    <div class="" style="">
        <div class="" style="background-color: #fff;">

            <div class="modal-body ">
                {{-- start here  --}}
                <div class="row">
                    <div class="col-md-12">
                        <section class="card mb-4">
                            <header class="card-header">


                                <h2 class="card-title">User Detail</h2>
                            </header>
                            <div class="" style="display: block;">
                                <div class="table-responsive">
                                    <table class="table table-border table-hover">

                                        @foreach ($users as $lead)
                                            @if ($lead->register_type == 1)
                                            @else
                                                <tbody class="no-bdr">
                                                    <tr>
                                                        <th width="25%">Name</th>
                                                        <td width="25%">{{ ucfirst($lead->name) }}</td>
                                                        <th width="25%">Date Of Birth</th>
                                                        <td width="25%">{{ ucfirst($lead->dob) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Gender</th>
                                                        @if(isset($lead->gender) && $lead->gender != NULL)
                                                            <td>
                                                                @if($lead->gender == 1)
                                                                    Female
                                                                @endif
                                                                @if ($lead->gender == 6)
                                                                    Male
                                                                @endif
                                                                @if ($lead->gender == 3)
                                                                    Non-binary
                                                                @endif
                                                                @if ($lead->gender == 2)
                                                                    Takatapuri
                                                                @endif
                                                                @if ($lead->gender == 4)
                                                                    Gender-fluid
                                                                @endif
                                                                @if ($lead->gender == 5)
                                                                    Inter Sex
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td>
                                                                {{ ucfirst($lead->custom_gender) }}
                                                            </td>
                                                        @endif

                                                        <th>Average Cycle Length</th>
                                                        <td>{{ ucfirst($lead->average_cycle_length) }} Length</td>
                                                    </tr>


                                                    <tr>
                                                        <th>Average Cycle Days</th>
                                                        <td>{{ ucfirst($lead->average_cycle_days) }} Days</td>
                                                        <th>Language</th>
                                                        <td>
                                                            @if (isset($languages))
                                                                @foreach ($languages as $lang)
                                                                    @if ($lang->language_id == $lead->language_id)
                                                                        {{ ucfirst($lang->langauge_name) }}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Country</th>
                                                        <td>
                                                            @if (isset($countries))
                                                                @foreach ($countries as $count)
                                                                    @if ($count->country_id == $lead->country_id)
                                                                        {{ ucfirst($count->country_name) }}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <th>Group</th>
                                                        <td>
                                                            @if (isset($groups))
                                                                @foreach ($groups as $grou)
                                                                    @if ($grou->g_id == $lead->group_id)
                                                                        {{ ucfirst($grou->group_name) }}
                                                                    @endif
                                                                @endforeach
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ ucfirst($lead->custom_group) }}
                                                        </td>
                                            @endif
                                            </tr>


                                            <tr>
                                                <th>Pronoun</th>
                                                <td> @isset($pronouns)
                                                        @foreach ($pronouns as $pronou)
                                                            @if ($pronou->pronoun_id == $lead->pronoun_id)
                                                                {{ ucfirst($pronou->pronoun) }}
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                    {{ ucfirst($lead->custom_pronoun) }}
                                                </td>


                                                <th>Focus</th>
                                                <td>
                                                    @if ($lead->focus_id == 0)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Tracking my menstrual cycle with maramataka(the mauri lunar
                                                            calender)</p>
                                                    @endif
                                                    @if ($lead->focus_id == 1)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Tracking my energy levels with maramataka</p>
                                                    @endif
                                                    @if ($lead->focus_id == 2)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Both</p>
                                                    @endif
                                                </td>

                                            </tr>


                                            <tr>
                                                <th>Is Understand</th>
                                                <td>
                                                    @if ($lead->is_understand == 1)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Yes</p>
                                                    @endif
                                                </td>
                                                <th>Date Security Accepted</th>
                                                <td>
                                                    @if ($lead->data_security_accepted == 1)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Yes</p>
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Is Social</th>
                                                <td>
                                                    @if ($lead->is_social == 1)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Yes</p>
                                                    @endif
                                                </td>
                                                <th>Google Synced Status </th>
                                                <td>
                                                    @if ($lead->google_cal_synced_status == 1)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Yes</p>
                                                    @endif
                                                </td>
                                            </tr>



                                            <tr>
                                                <th>Terms & Conditions</th>
                                                <td>
                                                    @if ($lead->is_term == 1)
                                                        <p style="font-weight:400;color:#000;padding:0px;margin:0px;">
                                                            Yes</p>
                                                    @endif
                                                </td>
                                                <th>&nbsp;</th>
                                                <td>&nbsp;</td>
                                            </tr>
                                            </tbody>
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    {{-- end here  --}}
                </div>

            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        {{-- <script>
    $('.list').html = '';
    $('.closenbtn').on('click', function() {
        location.reload();
        $('.leadlist').hide();
        $('.list').hide();
        $('.leadlist').css("display:none");

    });
</script> --}}
        {{-- end here  --}}


</section>
<x-footer />
