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
                        <h4 class="text-themecolor">Admin Dashboard</h4>
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
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="icons-Address-Book2"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h5 class="m-b-0"><span id="parking_log"></span></h5>
                                        <h6 class="text-muted m-b-0">Total Number of Parking Log Records This Month Except Blacklisted</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="icons-Money-2"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h5 class="m-b-0"><span id="parking_fee"></span></h5>
                                        <h6 class="text-muted m-b-0">Charge Fee Collection This Month</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <!-- <div class="round align-self-center round-danger"><i class="icons-Wallet"></i></div> -->
                                    <div class="round align-self-center round-warning"><i class="icons-Money-2"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h5 class="m-b-0"><span id="collection"></span></h5>
                                        <h6 class="text-muted m-b-0">Penalty Fee Collection This Month</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <!-- <div class="round align-self-center round-success"><i class="icons-Ticket"></i></div> -->
                                    <div class="round align-self-center round-danger"><i class="icons-Money-2"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h5 class="m-b-0"><span id="coupon"></span></h5>
                                        <h6 class="text-muted m-b-0">Total Fee Collection This Month</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="icons-Ticket"></i> <input type="date" id="cpc_date" name="date_param" onchange="get_location_dataz()" value="<?php echo date('Y-m-d'); ?>"> Charge and Penalty Fee Collection</h4>
                                <div class="table-responsive">
                                    <table class="table" id="data_per_loc">
                                        <thead>
                                            <tr>
                                                <th>Location</th>
                                                <th style="text-align: right; width: 30%;">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="icons-Ticket"></i> <select id="monthz"></select> Charge and Penalty Fee Collection By Location</h4>
                                <div id="pie-chart" style="width:100%; height:400px;"></div>
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