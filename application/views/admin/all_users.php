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
        <h4 class="text-themecolor">Users</h4>
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
    <?php foreach ($userdata as $key => $value):?>
      <!-- .col -->
    <div class="col-md-4">
      <div class="card" style="min-height: 200px;">
        <div class="card-body">
          <div class="row">

            <div class="col-md-4 col-sm-12 text-center">
            <a class="image-popup-vertical-fit" href="<?php echo $value['profile_pic'];?>"><img src="<?php echo $value['profile_pic'];?>" alt="user" class="img-circle img-responsive" style="height: 90px;"></a>
            </div>
            <div class="col-md-8">
              <h5 class="card-title m-b-0"><?php echo $value['emp_name']; ?></h5> <small><?php echo $value['emp_id']; ?></small>
              <p>
                <span style="font-weight: bold;"><?php echo $value['department'] ?></span><br>
                <span><?php echo $value['position']?></span><br><br>
                <span><span class="label label-<?php echo $value['label'];?>"><?php echo $value['stat'];?></span> | <span><?php echo $value['usertype'] ?></span></span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <?php endforeach ?>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
</div>
