 <style type="text/css">
     th{
        border: 1px solid black;

         height: 35px;
     }
     #line{

        border-top: 1px solid black;
     }
     #tbl_1 tfoot tr td{
        font-weight: bold;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
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
                <h4 class="text-themecolor"><?php echo $mm_data['page_theme'] ?></h4>
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
            <div class="card card-body printableArea" style="min-height: 500px;">
                <div  class="row">
                    <div class="col-md-4"></div>
                    <div  class="col-md-4">
                         <h4 id="elem" class="text-center" style="font-weight: bolder; "><b ><?php echo $mm_data['mall_name'];?></b><br> 
                            <small ><?php echo $mm_data['address'];?></small><br>
                            <b><?php echo $mm_data['title'];?></b>
                         </h4>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
   
                </div>
                <!-- <hr> -->
                <div   class="row">
                            <div  class="col-md-12">
                                <div  class="table-responsive m-t-40" style="clear: both;">
                                    <div>
                                    <label id="elem2" style="margin: 10px 0px -10px 0px; font-weight: bolder;"><b>Date: </b><?php echo $mm_data['date_end'];?></label>
                                        </div>
                                    <div id="elem3">
                                    <table class="mytable" id="tbl_1" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center ctd borderall" rowspan="2">Time</th>
                                                <th class="text-center ctd bordertopbot1" colspan="3">4-Wheeled</th>
                                                <th class="text-center ctd bordertopbot2" colspan="3">2-Wheeled</th>
                                                <th class="text-center ctd borderall" rowspan="2">Sub-Total</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center ctd borderbotri">In</th>
                                                <th class="text-center ctd borderbotri">Out</th>
                                                <th class="text-center ctd borderbotri" >Total Charge and Penalty</th>
                                                <th class="text-center ctd borderbotri">In</th>
                                                <th class="text-center ctd borderbotri">Out</th>
                                                <th class="text-center ctd borderbot">Total Charge and Penalty</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php foreach ($data_result101 as $key => $value): ?>
                                              <tr>
                                                <td class="text-center ctd">
                                                    <?php echo $value['dtime']; ?>
                                                </td>
                                                <td class="text-center ctd"><?php echo $value['w4in'] ?></td>
                                                <td class="text-center ctd"><?php echo $value['w4out'] ?></td>
                                                <td class="text-center rtd"><?php echo $value['pw4'] ?></td>
                                                <td class="text-center ctd"><?php echo $value['w2in'] ?></td>
                                                <td class="text-center ctd"><?php echo $value['w2out'] ?></td>
                                                <td class="text-center rtd"><?php echo $value['pw2'] ?></td>
                                                <td class="text-center rtd"><?php echo $value['s_tot'] ?></td>
                                            </tr>  
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot class="">
                                            <tr class="lined">
                                                <td class="text-center borderbot bordertop ctd">Daily Grand Total :</td>
                                                <td class="text-center borderbot bordertop ctd"><?php echo $g_total['w4in']; ?></td>
                                                <td class="text-center borderbot bordertop ctd"><?php echo $g_total['w4out']; ?></td>
                                                <td class="text-center borderbot bordertop rtd"><?php echo $g_total['pw4']; ?></td>
                                                <td class="text-center borderbot bordertop ctd"><?php echo $g_total['w2in']; ?></td>
                                                <td class="text-center borderbot bordertop ctd"><?php echo $g_total['w2out']; ?></td>
                                                <td class="text-center borderbot bordertop rtd"><?php echo $g_total['pw2']; ?></td>
                                                <td class="text-center borderbot bordertop rtd"><?php echo $g_total['s_tot']; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10%;">
                                <hr>
                                <div class="text-right">
                                    <div id="editor"></div>
                                    <!-- <button id="printx" class="btn btn-info" onclick="printContent('printableArea')"><i class=" icon-printer"></i> Print </button> -->
                                    <button id="printx" class="btn btn-info"><i class=" icon-printer"></i> Print </button>
                                    <button class="btn btn-secondary" id="btn_back">Back </button>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->

            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
