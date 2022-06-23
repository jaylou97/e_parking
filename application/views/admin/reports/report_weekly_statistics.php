 <style type="text/css">
     th{
        border: 1px solid black;

        height: 35px;
    }
    .line{

        border-top: 1px solid black;
    }
    #tbl_1 tfoot tr td{
        font-weight: bold;
        border-bottom: 2px solid black;
        border-top: 1px solid black;
        
    }
    #tbl_2 thead tr th{
        font-weight: bold;
    }
    #tbl_2 tbody tr .dclass{
        font-weight: bold;
    }
    #tbl_2
    {
        border:solid 1px black;
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
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                     <h4 id="elem" class="text-center" style="font-weight: bolder;"><b ><?php echo $mm_data['mall_name'];?></b><br> 
                        <small ><?php echo $mm_data['address'];?></small><br>
                        <b><?php echo $mm_data['title'];?></b>
                    </h4>
                </div>
                <div class="col-md-3">

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive m-t-40">
                        <div><label id="elem2" style="margin: 10px 0px -10px 0px; font-weight: bolder;"><b> Period:</b> <?php echo $mm_data['date_start'];?> to <?php echo $mm_data['date_end'];?></label></div>
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
                                    <th class="text-center ctd borderbotri" >Charge</th>
                                    <th class="text-center ctd borderbotri">In</th>
                                    <th class="text-center ctd borderbotri">Out</th>
                                    <th class="text-center ctd borderbot">Charge</th>

                                </tr>
                            </thead>
                            <tbody >
                                <?php foreach ($data_result101 as $key => $value): ?>
                                  <tr>
                                    <td class="text-center">
                                        <?php echo $value['dtime']; ?>
                                    </td>
                                    <td class="text-center ctd"><?php echo $value['w4in'] ?></td>
                                    <td class="text-center ctd"><?php echo $value['w4out'] ?></td>
                                    <td class="text-right rtd"><?php echo $value['pw4'] ?></td>
                                    <td class="text-center ctd"><?php echo $value['w2in'] ?></td>
                                    <td class="text-center ctd"><?php echo $value['w2out'] ?></td>
                                    <td class="text-right rtd"><?php echo $value['pw2'] ?></td>
                                    <td class="text-right rtd"><?php echo $value['s_tot'] ?></td>
                                </tr>  
                            <?php endforeach ?>
                        </tbody>
                        <tfoot class="">
                            
                            <tr class="lined">
                                     <td class="text-center  bordertop ctd">Weekly Grand Total :</td>
                                    <td class="text-center bordertop ctd"><?php echo $g_total['w4in']; ?></td>
                                    <td class="text-center bordertop ctd"><?php echo $g_total['w4out']; ?></td>
                                    <td class="text-right bordertop rtd"><?php echo $g_total['pw4']; ?></td>
                                    <td class="text-center bordertop ctd"><?php echo $g_total['w2in']; ?></td>
                                    <td class="text-center bordertop ctd"><?php echo $g_total['w2out']; ?></td>
                                    <td class="text-right bordertop rtd"><?php echo $g_total['pw2']; ?></td>
                                    <td class="text-right bordertop rtd"><?php echo $g_total['s_tot']; ?></td>
                            </tr>
                           
                             <tr class="lined">
                                <td class="text-center bordertopbot2 ctd">Daily Average:</td>
                                 <td class="text-center bordertopbot2 ctd"><?php echo $d_average['w4in']; ?></td>
                                    <td class="text-center bordertopbot2 ctd"><?php echo $d_average['w4out']; ?></td>
                                    <td class="text-right bordertopbot2 rtd"><?php echo $d_average['pw4']; ?></td>
                                    <td class="text-center bordertopbot2 ctd"><?php echo $d_average['w2in']; ?></td>
                                    <td class="text-center bordertopbot2 ctd"><?php echo $d_average['w2out']; ?></td>
                                    <td class="text-right bordertopbot2 rtd"><?php echo $d_average['pw2']; ?></td>
                                    <td class="text-right bordertopbot2 rtd"><?php echo $d_average['s_tot']; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <div  class="table-responsive m-t-40" style="clear: both;">
                    <div id="elem4">
                    <table class="mytable borderall" id="tbl_2" width="100%">
                        <thead>
                            <tr>
                                <th class="borderbot ltd" colspan="8">Weekly Summary</th>
                            </tr>
                            <tr>
                                <th class="text-center borderbotri ctd">Days</th>
                                 <th class="text-center borderbotri ctd">In</th>
                                    <th class="text-center borderbotri ctd">Out</th>
                                    <th class="text-center borderbotri ctd" >Charge</th>
                                    <th class="text-center borderbotri ctd">In</th>
                                    <th class="text-center borderbotri ctd">Out</th>
                                    <th class="text-center borderbotri ctd">Charge</th>
                                <th class="text-center borderbot ctd">Subtotal</th>
                            </tr>

                        </thead>
                        <tbody>
                           <?php foreach ($average_data as $key => $value): ?>
                                <tr>
                                    <td class="text-center ctd"><?php echo $value['date_time']; ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php echo $value['date_day']; ?>
                                    </td>
                                    <td class="text-center  ctd"><?php echo $value['w4in'] ?></td>
                                    <td class="text-center ctd"><?php echo $value['w4out'] ?></td>
                                    <td class="text-right rtd"><?php echo $value['pw4'] ?></td>
                                    <td class="text-center ctd"><?php echo $value['w2in'] ?></td>
                                    <td class="text-center ctd"><?php echo $value['w2out'] ?></td>
                                    <td class="text-right rtd"><?php echo $value['pw2'] ?></td>
                                    <td class="text-right rtd"><?php echo $value['s_tot'] ?></td>
                                </tr>
                           <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>

            </div>
            <div class="col-md-12" style="margin-top: 10%;">

                <hr>
                <div class="text-right">
                    <button id="printx" class="btn btn-info" type="submit"><i class=" icon-printer"></i> Print </button>
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
