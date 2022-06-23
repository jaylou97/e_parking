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
        <h4 class="text-themecolor">Released Coupon Report</h4>
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
          <h4 class="card-title"><i class="icon-list"></i> &nbsp;Released Coupon List</h4>
          <div class="row" style="margin: -5px 10px -25px 10px;">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
              <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">From</label>
                <div class="col-10">
                  <input class="form-control" type="date" value="<?php echo date('Y-m-d');?>" id="dtstart">
                </div>
              </div>
            </div>
            <div class="col-lg-4">
             <div class="form-group row">
              <label for="example-date-input" class="col-2 col-form-label">To</label>
              <div class="col-10">
                <input class="form-control" type="date" value="<?php echo date('Y-m-d');?>" id="dtend">
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive m-t-40" style="overflow-x:auto;">
          <table id="tbl_coupon_list" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Incharge</th>
                <th>Location</th>
                <th>Ticket#</th>
                <th>Plate#/ Customer</th>
                <th>Type of Vehicle</th>
                <th>Parking Rate/Coupon</th>
                <th>Validity Date</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
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
