

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">About E-Parking System</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                 <span class="caption-helper" id="currentTimer"></span>
             </div>
         </div>
     </div>
     <!-- ============================================================== -->
     <!-- End Bread crumb and right sidebar toggle -->
     <!-- ============================================================== -->
     <!-- ============================================================== -->
     <!-- Info box -->
     <!-- ============================================================== -->
     <!-- .row -->
     <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item"> 
                    <a class="nav-link active" data-toggle="tab" href="#system99" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-layout-grid4"></i></span> <span class="hidden-xs-down">General</span></a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" data-toggle="tab" href="#profile7" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="icon-people"></i></span> <span class="hidden-xs-down">Team</span></a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" data-toggle="tab" href="#rules99" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="icon-book-open"></i></span> <span class="hidden-xs-down">User Guide</span></a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" data-toggle="tab" href="#contacts99" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="icon-phone"></i></span> <span class="hidden-xs-down">Contacts</span></a> 
                </li>
            </ul>
            <hr>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="system99" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info"><h4 class="m-b-20 card-title"><b> GENERAL INFORMATION</b></h4></div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>IMPLEMMENTED ON:</label>
                                        <input type="text" class="form-control" value="- mm/DD/YYYY" readonly="" > 
                                    </div>
                                    <div class="form-group">
                                        <label>SYSTEM DESCRIPTION</label>
                                        <textarea class="form-control" readonly="">The System is intended for the back end system for the surface parking system of Plaza Marcela Mall</textarea>


                                    </div>
                                    <div class="form-group">
                                        <label>OTHER DETAILS</label>
                                        <textarea class="form-control" readonly="">other details here..</textarea>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="profile7" role="tabpanel"> 
                   <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info"><h4 class="m-b-20 card-title"><b>THE TEAM</b></h4></div>
                            <div class="card-body">
                                <!-- Project Manager -->
                                <div class="col-md-12">
                                    <div class="row el-element-overlay">
                                        <div class="col-md-4"></div>
                                        <?php foreach ($persons as $key => $value): ?>
                                            <?php if ($value['index'] == 10): ?>

                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="el-card-item">
                                                            <div class="el-card-avatar el-overlay-1"> <img  style="height: 300px;" src="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>" alt="<?php echo $value['name'];?>">
                                                                <div class="el-overlay">
                                                                    <ul class="el-info">
                                                                        <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>"><i class="icon-magnifier"></i></a></li>


                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="el-card-content">
                                                                <h5 class="card-title text-uppercase">
                                                                    <?php echo $value['name'];?><br>
                                                                CPA, CIA, CSCU, CISA, REB, REA, CICA, CrFA</h5> <h5><?php echo $value['position'];?></h5>
                                                                <br>
                                                                <h5><?php echo $value['current_status'];?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endif; ?>


                                        <?php endforeach;  ?> 
                                    </div> 
                                    <div class="col-md-4"></div>
                                </div>
                                <!-- Manager -->
                                <div class="col-md-12">
                                    <div class="row el-element-overlay">
                                        <div class="col-md-4"></div>
                                        <?php foreach ($persons as $key => $value): ?>
                                            <?php if ($value['index'] == 9): ?>

                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="el-card-item">
                                                            <div class="el-card-avatar el-overlay-1"> <img  style="height: 250px;" src="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>" alt="<?php echo $value['name'];?>">
                                                                <div class="el-overlay">
                                                                    <ul class="el-info">
                                                                        <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>"><i class="icon-magnifier"></i></a></li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="el-card-content">
                                                                <h5 class="card-title text-uppercase"><?php echo $value['name'];?></h5> <h5><?php echo $value['position'];?></h5>
                                                                <br>
                                                                <h5><?php echo $value['current_status'];?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endif; ?>


                                        <?php endforeach;  ?> 
                                    </div> 
                                    <div class="col-md-4"></div>
                                </div>

                                <!-- Supervisors -->
                                <div class="col-md-12">
                                    <div class="row el-element-overlay">
                                        <div class="col-md-3"></div>
                                        <?php foreach ($persons as $key => $value): ?>
                                            <?php if ($value['index'] == 11 || $value['index'] == 1): ?>

                                                <div class=" col-md-3">
                                                    <div class="card">
                                                        <div class="el-card-item">
                                                            <div class="el-card-avatar el-overlay-1"> <img  style="height: 300px;" class="imgs" src="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>" alt="<?php echo $value['name'];?>">
                                                                <div class="el-overlay">
                                                                    <ul class="el-info">
                                                                        <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>"><i class="icon-magnifier"></i></a></li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="el-card-content">
                                                                <h5 class="card-title text-uppercase"><?php echo $value['name'];?></h5> <h5><?php echo $value['position'];?></h5>
                                                                <br>
                                                                <h5><?php echo $value['current_status'];?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endif; ?>


                                        <?php endforeach;  ?> 
                                    </div> 
                                    <div class="col-md-3"></div>
                                </div>

                                <!-- The Programming Team -->
                                <div class="col-md-12"><div class="row el-element-overlay">
                                    <?php foreach ($persons as $key => $value): ?>
                                        <?php if ($value['index'] != 9 && $value['index'] != 10 && $value['index'] != 11 && $value['index'] != 1): ?>

                                            <div class="col-lg-3 col-md-6">
                                                <div class="card">
                                                    <div class="el-card-item">
                                                        <div class="el-card-avatar el-overlay-1"> <img  style="height: 300px;" class="imgs" src="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>" alt="<?php echo $value['name'];?>">
                                                            <div class="el-overlay">
                                                                <ul class="el-info">
                                                                    <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url()?>assets/images/persons/<?php echo $value['picture'];?>"><i class="icon-magnifier"></i></a></li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="el-card-content">
                                                            <h5 class="card-title text-uppercase"><?php echo $value['name'];?></h5> <h5><?php echo $value['position'];?></h5>
                                                            <br>
                                                            <h5><?php echo $value['current_status'];?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endif; ?>


                                    <?php endforeach;  ?> 
                                </div> 
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane " id="rules99" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info"><h4 class="m-b-20 card-title"><b>MANUAL GUIDE</b></h4></div>
                        <div class="card-body">

                         Download User's Guide? <a href="<?php echo base_url()?>assets/users_guide/PAY PARKING USER1S GUIDE_v2.docx"> Click Here...</a>      

                     </div>
                 </div>
             </div>
         </div> 
     </div>
     <div class="tab-pane " id="contacts99" role="tabpanel">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info"><h4 class="m-b-20 card-title"><b>CONTACT INFORMATION</b></h4></div>
                <div class="card-body">

                   <div class="form-group">
                    <label>COMPANY OFFICE</label>
                    <input type="text" class="form-control" value="- Corporate IT SysDev't" readonly="" > 
                </div>
                <div class="form-group">
                    <label>COMPANY/OFFICE PHONE: Smart</label>
                    <input type="text" class="form-control" value="- 09190796051"readonly=""  >
                </div>
                 <div class="form-group">
                    <label>IP PHONE</label>
                    <input type="text" class="form-control" value="1844/1953"readonly=""  >
                </div>
                <div class="form-group">
                    <label>COMPANY OFFICE EMAIL ADDRESS</label>
                    <p><a href="http://www.itsysdev@alturasbohol.com" target="_blank" style="text-decoration: none;background-color: #333;">- itsysdev@alturasbohol.com</a></p>

                </div>

            </div>
        </div>
    </div>
</div> 
</div>



</div>
</div>






</div>
<!-- /.row -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
