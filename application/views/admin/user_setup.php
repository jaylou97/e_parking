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
        <h4 class="text-themecolor">User Setup</h4>
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
       <div class="card animated bounceInDown">
        <div class="card-body">
          <h4 class="card-title"><i class="icon-user-follow"></i> &nbsp;User/s List</h4>
          <div class="row" style="margin: 0 15px 0 15px;">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-right">
              <button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-success" onclick="btn_add_user()"><i class=" icon-plus "></i> Add User</button>
            </div>
          </div>

          <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Business Unit</th>
                  <th>Usertype</th>
                  <th>View</th>
                  <th>Action</th>
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
<div id="myModal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="height: 500px;">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="icon-user-follow"></i> &nbsp;Add User</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <form method="POST" enctype="multipart/form-data" id="fileUploadForm2">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <!-- <div class="form-group row">
                <label class="control-label text-right col-md-3">Profile Picture</label>
                <div class="col-md-9" id="the-basics">
                  <input type="file" class="form-control" placeholder="Enter Profile Picture" name="profile2" id="profile2">
                </div>
              </div> -->
              <div class="form-group row">
                <label class="control-label text-right col-md-3">Emp. Name</label>
                <div class="col-md-9" id="the-basics">
                  <!-- <input type="text" class="typeahead form-control" name="name" id="name" placeholder="Enter & Select Employee Name" autocomplete="off" onkeypress="return nameOnly(event)"> -->
                  <input type="text" class="typeahead form-control" name="name" id="name" placeholder="Enter & Select Employee Name" autocomplete="off">
                  <input type="hidden" id="hiddenInputElement" name="hiddenInputElement">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-right col-md-3">Username</label>
                <div class="col-md-9" id="the-basics">
                  <input type="text" class="form-control" autocomplete="off" name="username" readonly="" placeholder="Enter Username" id="username" onkeypress="return blockSpecialChars(event)">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-right col-md-3">Password</label>
                <div class="col-md-9" id="the-basics">
                  <input type="password" class="form-control" autocomplete="off" placeholder="Enter Password" name="password" id="password" onkeypress="return blockSpecialChars(event)">
                  <input type="checkbox" onclick="show_password_js()"> Show Password </input>
                </div>
              </div>
               <div class="form-group row">
                <label class="control-label text-right col-md-3">Confirm Password</label>
                <div class="col-md-9" id="the-basics">
                  <input type="password" class="form-control" autocomplete="off" placeholder="Enter Password" name="password" id="confirmpassword" onkeypress="return blockSpecialChars(event)">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-right col-md-3">Usertype</label>
                <div class="col-md-9">
                  <select class="form-control custom-select" data-placeholder="Select Usertype" name="usertype" id="usertype" tabindex="1">
                    <option value="" hidden>Select Usertype</option>
                    <?php foreach ($usertype as $key => $value): ?>
                      <option value="<?php echo $value['usertype']; ?>"><?php echo $value['usertype']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-info waves-effect" onclick="btn_enterdata()" >Submit</button> -->
          <button type="submit" class="btn btn-info waves-effect">Submit</button>
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="close_btn()">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- view details modal -->
<style type="text/css">
  #usertbl {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #usertbl td, #usertbl th {
    border: 1px solid #ddd;
    padding: 6px;
    background-color: #f2f2f2;
  }
  /* #usertbl tr:nth-child(even){background-color: #f2f2f2;} */
  /* #usertbl tr:hover {background-color: #ddd;} */

  #usertbl th {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
    background-color: #3399ff;
    color: white;
  }
</style>
<div class="modal bs-example-modal-lg" id="largeModal_user_setup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="margin-left: 9px; height: 498px;">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel"><i class="icon-user"></i> User Details</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <center>
              <div class="card">
               <div class="card-body">
                <center class="m-t-30"><a class="image-popup-vertical-fit" href="" id="href_pp">  <img src="" id="user_profile_pic" class="img-circle" width="150" /></a>
                  <h4 class="card-title m-t-10" id="uname"></h4>
                  <h6 class="card-subtitle" id="position_area"></h6>
                  <div class="row">
                  </div>
                </center>
              </div>
            </div>
          </center>
        </div>
        <div class="col-md-6">
          <table id="usertbl">
            <thead>
              <tr>
                <th colspan="2"><center><h4 style="font-weight: bold; font-family: adobe hebrew;">User Information</h4></center></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Employee No:</label></td>
                <td><input type="text" id="empno" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr>
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Employee ID:</label></td>
                <td><input type="text" id="empid" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr>
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Payroll No:</label></td>
                <td><input type="text" id="payno" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr>
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Department:</label></td>
                <td><input type="text" id="empname" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr> 
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Position:</label></td>
                <td><input type="text" id="empposition" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr>
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Employee Type:</label></td>
                <td><input type="text" id="emptype" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr>
              
              <tr>
                <td class="text-right"><label style="font-weight: bold;">Status:</label></td>
                <td><input type="text" id="empstat" style="width: 100%; border-radius: 5px;" readonly></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary waves-effect text-left" data-dismiss="modal">Close</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<div id="myModal_location" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="icon-location-pin"></i> Assigned Location</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <div class="modal-body">
        <input type="hidden" id="hide_user_id">
        <input type="hidden" id="hide_emp_id">
        <div class="row">
          <div class="col-md-12 text-right" >
            <button type="button" class="btn btn-sm btn-success" style="margin-right: 15px;" onclick="btn_locationsetup()"><i class="icon-plus"></i> Location</button>
          </div>
        </div>
        <div class="row">
          <table class="table table-bordered table-striped" id="tbl_location" width="100%">
            <thead>
              <tr>
                <th>Employee Location</th>
                <th style="width: 8%;"></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div id="myModal_location22" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="icon-location-pin"></i> Location List</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <div class="modal-body">
       <table class="table table-bordered table-striped" id="tbl_lsetup">
         <thead>
           <tr>
             <th style="width: 10%;"> </th>
             <th>Location</th>
           </tr>
         </thead>
       </table>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-info waves-effect" id="btn_id_sub" onclick="setup_user_location()" disabled>Submit</button>
      <button type="button" class="btn btn-secondary waves-effect" id="closebtn_id" data-dismiss="modal">Close</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>