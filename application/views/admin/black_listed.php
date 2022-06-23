 <style type="text/css">
   th{
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    height: 35px;
    
}

</style> 
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
                <h4 class="text-themecolor"><?php echo $page_title; ?></h4>
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
     <!-- Start Page Content -->
     <!-- ============================================================== -->
     <div class="row">
        <div class="col-md-12">
            <div class="card card-body" style="max-height: 90px;">
                <!-- <form action="black_listed_report" method="POST" class="form-horizontal"> -->
                    <div class="form-body">
                        <div class="row" style="margin: 10px 0px 0px -10px;">
                            <div class="col-md-2">
                                <div class="form-group row">

                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">From: </span>
                                      </div>
                                      <input type="date" class="form-control" id="dtstart" name="dtstart" value="<?php echo date('Y-m-d');?>" >
                                </div>
                         </div>
                         <!--/span-->
                         <div class="col-md-4">

                       <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">To: </span>
                                      </div>
                                      <input type="date" class="form-control" id="dtend" name="dtend" value="<?php echo date('Y-m-d');?>" >
                        </div>



                        </div>
                        <div class="col-md-2">
                          <!--   <div class="form-group row">
                                <center>
                                    <button id="search" type="submit" class="btn waves-effect waves-light btn-success"><i class="ti ti-search"></i> Search</button>
                                </center>
                            </div> -->
                        </div>
                        <!--/span-->
                    </div>
                </div>
            <!-- </form> -->
            
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
        <div class="card-body printableArea" style="min-height: 500px;">
            <div class="row" hidden="">
                <div class="col-md-9">
                   <h4 id="elem" style="margin-left: 4px;font-weight: bolder;"><b>Plaza Marcela</b><br> <small>Pamaong, Corner Belderol St., Tagbilaran City, Bohol</small></h4>
               </div>
               <div class="col-md-3 pull-right">
                <label id="elem1" hidden="">
                    <b>Run Date:</b> 
                    <span id="myrundate"></span>   
                    <br><b>Run Time:</b> 
                    <span id="myruntime"></span>
                </label>
            </div>
        </div>
        <!-- <hr> -->
        <div class="row">
            <div class="col-md-12" >
                <div class="pull-left col-md-7" hidden="">
                    <h5 id="elem2" style="font-weight: bolder;"><b>Non-Payment Parking Fee</b></h5>
                    
                </div>
            </div>
            <div  class="col-md-12">
                    <label id="elem3" style=" font-weight: bolder;"><label style="font-weight: bold; font-size: 18px;">Blacklisted Report List</label><br><b>For the Date: </b> <u><span id="dtstart2"></span> &nbsp;<b>to</b>&nbsp; <span id="dtend2"> </span></u></label>
            <div class="table-responsive" style="clear: both;">
            <table id="tbl_blacklisted" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="text-center"><b>No.</b></th>
                    <th class="text-center"><b>Plate Number</b></th>
                    <th class="text-center"><b>Vehicle Type</b></th>
                    <th class="text-center"><b>Date Time In</b></th>
                    <th class="text-center"><b>Date Escaped</b></th>
                    <th class="text-center"><b>Ticket No.</b></th>
                    <th class="text-center"><b>Trans. No.</b></th>
                    <th class="text-center"><b>Total Hours</b></th>
                    <th class="text-center"><b>Excess Hours</b></th>
                    <th class="text-center"><b>Penalty Amt.</b></th>
                    <th class="text-center"><b>Charge Amt.</b></th>
                    <th class="text-center"><b>Total Amt.</b></th>
                    <th class="text-center"><b>Action</b></th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 3%;">
            <hr>
            <div class="text-right">
                <button id="generate_textfile_btn" class="btn btn-success" onclick="generate_textfile_js()" disabled><i class=""></i>📄 Generate Text File </button>
                <button id="printx" class="btn btn-info" type="submit" disabled><i class=" icon-printer"></i> Print </button>
                <button class="btn btn-primary" id="btn_back">Back </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
