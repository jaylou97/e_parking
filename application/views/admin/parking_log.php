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
        <h4 class="text-themecolor">Parking Log</h4>
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
     <div class="col-lg-12">
       <div class="card">
        <div class="card-body">
          <h4 class="card-title"><i class=" icon-list"></i> &nbsp;Parking Logbook </h4>
          <div class="row" style="margin: -5px 10px -15px 10px;">
           <div class="col-lg-3"></div>
           <div class="col-lg-3"></div>
           <div class="col-lg-3 text-right">
             <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">From: </span>
              </div>
              <input type="date" class="form-control" id="trans_date" value="<?php echo date('Y-m-d');?>">
            </div>
          </div>
          <div class="col-lg-3 text-right"> 
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">To: </span>
              </div>
              <input type="date" class="form-control" id="trans_date2" value="<?php echo date('Y-m-d');?>">
            </div>
          </div>
        </div>
        <div class="table-responsive m-t-40">
          <table id="tbl_parking_log" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Date Time In</th>
                <th>Date Time Out</th>
                <th>Incharge</th>
                <th>Location</th>
                <th>Plate #</th>
                <th>Vehicle Type</th>
                <th>Status</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- modal -->
