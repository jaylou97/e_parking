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
                 <!--  <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" icon-printer"></i><span class="hide-menu"> #1 Reports</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url() ?>ticket_list_page">List of Ticket</a></li>
                                <li><a href="<?php echo base_url() ?>coupon_list_page">List of Coupon</a></li>
                                <li><a href="<?php echo base_url() ?>vehicle_monitoring_page">Vehicle Monitoring</a></li>
                                <li><a href="<?php echo base_url() ?>billing_statement_page">Billing Statement</a></li>
                                <li><a href="<?php echo base_url() ?>collection_page">Collection Report</a></li>
                                <li><a href="<?php echo base_url() ?>overall_collection_page">Overall Collection</a></li>
                            </ul>
                        </li> -->
                 <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" icon-printer"></i><span class="hide-menu">Reports</span></a>
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
                     <!-- <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>user_setup_admin"><i class=" icon-user-follow "></i><span class="hide-menu"> User Setup</span></a></li> -->
                     <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>location_setup_admin"><i class=" icon-location-pin "></i><span class="hide-menu"> Location Setup</span></a></li>
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