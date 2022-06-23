 <aside class="left-sidebar animated bounceInLeft">
     <!-- Sidebar scroll-->
     <div class="scroll-sidebar">
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav">
             <ul id="sidebarnav">
                 <li class="user-pro">
                     <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                         <img src="<?php echo $this->session->userdata('profile_pic') ?>" alt="user-img" class="img-circle">
                         <span class="hide-menu"><?php echo $this->session->userdata('usertype') ?></span>
                     </a>
                     <ul aria-expanded="false" class="collapse">
                         <li><a href="javascript:void(0)" onclick="myprofile('<?php echo $this->session->userdata('name') ?>')"><i class="ti-user"></i> My Profile</a></li>
                         <li><a href="javascript:void(0)" onclick="AccSettings()"><i class="ti-settings"></i> Account Setting</a></li>
                         <li><a href="javascript:void(0)" onclick="logout_user()"><i class=" icons-Power-3 "></i> Logout</a></li>
                     </ul>
                 </li>
                 <li class="nav-small-cap">&emsp;&ensp; E-Parking System Files</li>
                 <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>dashboard_index"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                 </li>
                 <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>parking_log_page"><i class=" ti-book"></i><span class="hide-menu"> Parking Logbook</span></a></li>
                 <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>remittance_route"><i class=" icons-Money-2"></i><span class="hide-menu"> Remittance</span></a></li>
                 <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" icon-printer"></i><span class="hide-menu"> Reports</span></a>
                     <ul aria-expanded="false" class="collapse">
                         <li><a href="<?php echo base_url() ?>end_of_shift_report">End of Shift</a></li>
                         <li><a href="<?php echo base_url() ?>end_of_day_report">End of Day</a></li>
                         <!-- <li><a href="<?php echo base_url() ?>monthly_data_report">Monthly Report</a></li> -->
                         <li><a href="<?php echo base_url() ?>monthly_range_data_report">Monthly Range Report</a></li>
                         <!-- <li><a href="<?php echo base_url() ?>daily_statistics_report">Daily Statistics Report</a></li>
                         <li><a href="<?php echo base_url() ?>weekly_statistics_report">Weekly Statistics Report</a></li>
                         <li><a href="<?php echo base_url() ?>monthly_statistics_report">Monthly Statistics Report</a></li> -->
                         <li><a href="<?php echo base_url() ?>black_listed_report">Black Listed</a></li>
                         <li><a href="<?php echo base_url() ?>admin_unblock_route">Unblock Report</a></li>
                         <li><a href="<?php echo base_url() ?>loginlogout_history_route">Parking Attendant Login/Logout History</a></li>
                     </ul>
                 </li>
                 <?php if ($this->session->userdata('usertype') == 'Admin') : ?>
                     <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" icon-user-follow "></i><span class="hide-menu"> User/s File</span></a>
                         <ul aria-expanded="false" class="collapse">
                             <li><a href="<?php echo base_url() ?>user_setup_admin">User Setup</a></li>
                             <li><a href="<?php echo base_url() ?>all_users_views">All Users</a></li>
                         </ul>
                     </li>
                     <li> <a class="waves-effect waves-dark" href="location_setup_admin"><i class=" icon-location-pin "></i><span class="hide-menu"> Location Setup</span></a></li>
                 <?php endif ?>


             </ul>
         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>

 <!-- Account Settings -->
 <style type="text/css">
     .clickme {
         color: #000000;
     }

     .inconz {
         color: #ff8000;
     }
 </style>

 <div id="myModalAccountSettings" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="myModalLabel"><i class="icon-settings"></i> Account Settings</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             </div>
             <div class="modal-body">
                 <div class="row" style="margin-top: 20px;">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                         <ul class="list-unstyled">
                             <li class="media">

                                 <h5><i class="icon-user inconz"></i> <a href="javascript:void(0)" class="clickme" onclick="changeSettings('1')"> <span style="margin-left: 30px;">Change Username</span></a></h5>
                             </li>
                             <li class="media my-4">

                                 <h5><i class=" icon-lock inconz"></i> <a href="javascript:void(0)" class="clickme" onclick="changeSettings('2')"> <span style="margin-left: 30px;">Change Password</span></a></h5>
                             </li>
                         </ul>
                     </div>
                     <div class="col-md-2"></div>
                 </div>

             </div>

         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <div id="ChangeSettingModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="myModalLabel"><i class=" ti-hand-point-right"></i> <span id="myModalLabel101"></span></h4>
                 <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-lg-1"></div>
                     <div class="col-lg-10">
                         <div class="row" id="change_div1">
                             <label><span style="font-weight: bold;">Note</span>: Username is alphanumeric and it should be unique, therefore you are advised to use username that is relevant to you or to your name.</label><br>
                             <input type="text" id="change_user" class="form-control" placeholder="New Username" onkeypress="return blockSpecialCharsAdd(event)">
                         </div>
                         <div class="row" id="change_div2">
                             <label><span style="font-weight: bold;">Note</span>: Password is alphanumeric. It must contain letters (uppercase and lowercase) and numbers.</label>
                             <br><br>
                             <input type="password" class="form-control" placeholder="Old Password" id="old_pass" onkeypress="return blockSpecialCharsAdd(event)">
                             <br><br>
                             <input type="password" class="form-control" placeholder="New Password" id="new_pass" onkeypress="return blockSpecialCharsAdd(event)">
                             <br><br>
                             <input type="password" class="form-control" placeholder="Confirm New Password" id="con_new_pass" onkeypress="return blockSpecialCharsAdd(event)">
                         </div>
                     </div>
                     <div class="col-lg-1"></div>

                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-info waves-effect" onclick="submitChange('<?php echo $this->session->userdata('password'); ?>')">Submit</button>
                 <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="closeChange()">Close</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <!-- logout modal -->

 <div id="logoutModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                 <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
             </div>
             <div class="modal-body">
                 <label>Are you sure you want to Logout?</label>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-info waves-effect" onclick="logoutNako()">Yes</button>
                 <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">No</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


        <!-- view blacklisted modal jay code-->

 <style>

    #modal_form input
     {
        margin: 5px;
     }

    .row
    {
        margin-right: 7px;
        margin-left: -24px;
    }

    #div_totamount
    {
        margin-left: 106px;
    }

    .close
    {
        font-size: 2rem;
    }

    #blacklisted_modal_content
    {
        height: 351px; 
        width: 871px;
    }

    #bld_header_modal
    {
        margin-bottom: -13px; 
        font-size: 2rem;
        margin-left: 343px;
    }

    #view_blaclisted_modal
    {
        margin-left: -200px;
    }

    #modal_form
    {
        font-size: 16px;
    }

    input[type=text]
    {
        text-align:center;
    }

    .row label
    {
        font-weight: bold;
    }

    #remittance_header_modal
    {
        /*font-weight: bold;*/
        margin-left: 250px;
    }

    #div_display_remittance
    {
        margin-left: 110px;
    }

    #div_display_remittance label
    {
        margin-left: 32px;
    }

    input[id=parkingattendant]
    {
        width: 300px;
    }

 </style>

 <div id="view_blaclisted_modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content" id="blacklisted_modal_content">
             <div class="modal-header">
                 <h4 class="modal-title" id="bld_header_modal" style="  ">Blacklisted</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><b>x</b></button>
             </div>
             <div class="modal-body">
                 <form id="modal_form">
                         <div class="row" id="div_display_blacklisted">

                            <!-- <div class="col-sm-6 form-inline">
                                <div class="col-sm-6">
                                    <label>Plate Number</label>
                                     <input type="text" id="platenumber">
                                </div>
                                <div class="col-sm-6">
                                    <label>Vehicle Type</label>
                                     <input type="text" id="vehicletype">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date Time In</label>
                                     <input type="text" id="timein">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date Escaped</label>
                                     <input type="text" id="dateescaped">
                                </div>
                            </div>

                            <div class="col-sm-6 form-inline">
                                <div class="col-sm-6">
                                    <label>Ticket No.</label>
                                     <input type="text" id="ticketno">
                                </div>
                                <div class="col-sm-6">
                                    <label>Transaction No.</label>
                                     <input type="text" id="transactionno">
                                </div>
                                <div class="col-sm-6">
                                    <label>Charge Amount</label>
                                     <input type="text" id="chargeamount">
                                </div>
                                <div class="col-sm-6">
                                    <label>Penalty</label>
                                     <input type="text" id="penalty">
                                </div>
                             </div>

                                <div class="col-sm-6" id="div_totamount">
                                    <label>Total Amount</label>
                                     <input type="text" id="totalamount">
                                </div> -->
                           

                        </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger waves-effect" onclick="unblock_js()">Unblock</button>
                 <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <div id="remittance_incharge_modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" style="margin-left: 360px;">
         <div class="modal-content" id="remittance_modal_content" style="width: 145%;">
             <div class="modal-header">
                 <h2 class="modal-title" id="remittance_header_modal" style="  ">Remittance</h2>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><b>x</b></button>
             </div>
             <div class="modal-body" style="margin-top: 22px; width: 101%;">
                 <form id="modal_form">
                         <div class="row" id="div_display_remittance">

                           <!--  <div class="col-sm-6">
                                <label>Parking Attendant</label>
                                 <input disabled="true" type="text" id="parkingattendant" value="">
                            </div>

                            <div class="col-sm-6">
                                <label style="margin-left: 50px;">Amount Remit</label>
                                 <input type="number" class="text-center" id="amountremit" value="">
                            </div> -->
                          
                        </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger waves-effect" onclick="remit_js()">Remit</button>
                 <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Close</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

 <script > 

     function calculate_breakdown_js()
     {
        var res = $('#1k').val() * 1000;
        var res1 = $('#5h').val() * 500;
        var res2 = $('#1h').val() * 100;
        var res3 = $('#fifty').val() * 50;
        var res4 = $('#twenty').val() * 20;
        var res5 = $('#coins').val() * 1;
           /* if (res == Number.POSITIVE_INFINITY || res == Number.NEGATIVE_INFINITY || isNaN(res))
                res = "N/A"; // OR 0*/
        var total = res + res1 + res2 + res3 + res4 + res5;
        $('#amountremit').val(total);
     }

 </script>