

<style>

input[type=text] {
    text-align: left;
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
        <h4 class="text-themecolor">Location Setup</h4>
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
          <h4 class="card-title"><i class="icon-location-pin "></i> &nbsp;Location/s List</h4>
          <div class="row" style="margin: 0 15px 0 15px;">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-right">
              <button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-success" onclick="btn_add_Location()"><i class=" icon-plus "></i> Add Location</button>
            </div>
          </div>
          <div class="table-responsive m-t-40">
            <table id="tbl_location" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>Location</th>
                  <th>Location Address</th>
                  <th style="width:18%">Action</th>
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

<div id="myModal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="height: 420px;">
      <div class="modal-header" style="margin-left: -56px;">
        <h4 class="modal-title" id="myModalLabel"><i class="icon-location-pin"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="title_id"></span></h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" style="padding-left: 34px;">
            <input type="hidden" id="hide_id">
            <div class="form-group">
              <label>Location</label>
              <input type="text" class="form-control" autocomplete="off" id="location_id"></input>
            </div>
            <div class="form-group">
              <label>Location Address</label>
              <textarea class="form-control" rows="5" autocomplete="off" id="loc_add"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info waves-effect" onclick="btn_enterdata()" id="btn_1">Submit</button>
        <button type="button" class="btn btn-info waves-effect" onclick="btn_editdata()" id="btn_2">Update</button>
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="close_btn()">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>