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
        <h4 class="text-themecolor">Collection Report</h4>
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
          <h4 class="card-title"><i class="icon-list"></i> &nbsp;Collection List</h4>
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
        <div class="table-responsive m-t-40">
          <table id="tbl_month_collection" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>Incharge</th>
                <th>Location</th>
                <th>Amount</th>
                <th width="40px;">Action</th>
                
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
<!-- modalzzzz -->
<div class="modal bs-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel"><i class="icon-list"></i> Incharge Collection List</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
       <table class="table table-bordered table-striped" width="100%" id="tbl_breakdown_collection">
         <thead>
           <tr>
             <th>Date & Time In</th>
             <th>Date & Time Out</th>
             <th>Time-in Incharge</th>
             <th>Time-out Incharge</th>
             <th>Plate #</th>
             <th>Types of Wheel</th>
             <th>Amount</th>
             <th>Penalty</th>
           </tr>
         </thead>
       </table>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary waves-effect text-left" data-dismiss="modal">Close</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>