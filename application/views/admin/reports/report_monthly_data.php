<style type="text/css">
    th {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        height: 35px;
    }

    table tr th {
        font-weight: bold;
    }

    table tfoot tr td {
        border-bottom: 2px solid black;
        font-weight: bold;
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
                        <div class="col-md-9">
                            <h4 id="elem" style="margin-left: 4px;"><b><?php echo $mm_data['mall_name']; ?></b><br> <small><?php echo $mm_data['address']; ?></small></h4>
                        </div>
                        <div class="col-md-3 pull-right">
                            <span id="elem1"> <b>Run Date:</b> <span id="myrundate"></span><br><b>Run Time:</b> <span id="myruntime"></span></span>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <h4 id="elem2"><b><?php echo $mm_data['title']; ?></b><br><small>As of <?php echo $mm_data['date_end']; ?></small></h4>
                            </div>

                        </div>
                        <div id="elem3" class="col-md-12">
                            <?php
                            foreach ($data_result101 as $key => $valuezz) :

                                // var_dump($valuezz);
                            ?>
                                <div class="row">
                                    <div class="col-md-9">
                                        <!-- <label style="margin: 10px 0px -10px 0px; font-weight: bolder;"><b>Cashier: </b><?php //echo $valuezz['cashier']; ?></label> -->
                                        <label style="margin: 10px 0px -10px 0px; font-weight: bolder;"><b>MONTH: </b><?php echo $valuezz['month']; ?></label>
                                    </div>
                                   <!--  <div class="col-md-3">
                                        <label><span style="font-weight: bold;">Location: </span> <?php// echo $valuezz['location'] ? $valuezz['location']->location : ''; ?></label>
                                    </div> -->
                                </div>
                                <table class="mytable" id="tbl_1" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bordertopbot2 ctd">Vehicle Type</th>
                                            <th class="text-center bordertopbot2 ctd">Trans. Count</th>
                                           <!--  <th class="text-center bordertopbot2 ctd">Coupon Issued</th> -->
                                         <!--    <th class="text-right bordertopbot2 rtd">Coupon Amount</th> -->
                                         
                                            <th class="text-right bordertopbot2 rtd">Penalty Amount</th>
                                            <th class="text-right bordertopbot2 rtd">Charge Amount</th>
                                            <th class="text-right bordertopbot2 rtd">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($valuezz['data_result'] as $key => $value) : ?>
                                            <tr>
                                                <td class="text-center ctd"><?php echo $value['trans_count'] . " | " . $value['v_type'] ?></td>
                                                <td class="text-center ctd"><?php echo $value['trans_count'] ?></td>
                                               <!--  <td class="text-center ctd"><?php echo $value['coupon'] ?></td> -->
                                              <!--   <td class="text-right rtd"><?php echo $value['coupon_amt'] ?></td> -->
                                                <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['penalty1'])) + floatval(str_replace(",", "", $value['lost_of_ticket'])), 2) ?> </td>
                                                <td class="text-right rtd"><?php echo $value['penalty'] ?> </td>
                                                <!-- <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "",$value['penalty1'] + $value['penalty'])), 2); ?> </td> -->

                                                <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['penalty1'] + $value['lost_of_ticket'])) + floatval(str_replace(",", "", $value['penalty'])), 2); ?> </td>
                                                
                                                <!-- <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['coupon_amt'])) + floatval(str_replace(",", "", $value['penalty'])), 2); ?> </td> -->

                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>

                                        <?php
                                        foreach ($valuezz['data_result2'] as $key => $value) :
                                        ?>
                                            <tr style="border-top: 2px solid black;">
                                                <td class="text-center bordertopbot3  ctd"><?php echo $value['trans_count'] ?></td>
                                                <td class="text-center bordertopbot3  ctd"><?php echo $value['trans_count'] ?></td>
                                               <!--  <td class="text-center bordertopbot3  ctd"><?php echo $value['coupon'] ?></td>
                                                <td class="text-right  bordertopbot3 rtd"><?php echo $value['coupon_amt'] ?></td> -->
                                                <td class="text-right  bordertopbot3 rtd"><?php echo $value['penalty1'] ?> </td>
                                                <td class="text-right  bordertopbot3 rtd"><?php echo $value['penalty'] ?> </td>
                                                <td class="text-right  bordertopbot3 rtd"><?php echo number_format(floatval(str_replace(",", "",$value['penalty1'] + $value['penalty'])), 2); ?></td>

                                            <!--     <td class="text-right  bordertopbot3 rtd"><?php echo number_format(floatval(str_replace(",", "", $value['coupon_amt'])) + floatval(str_replace(",", "", $value['penalty'])), 2); ?></td> -->

                                            </tr>
                                        <?php endforeach ?>
                                    </tfoot>
                                </table>
                                <br><br>
                            <?php endforeach ?>
                        </div>
                        <div class="col-md-12" id="elem5" style="margin-top: 1%; margin-bottom: 5%;">

                            <label style="font-weight: bold;">GRAND TOTAL SUMMARY COLLECTION <br></label>

                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center bordertopbot2 ctd">Vehicle Type</th>
                                        <th class="text-center bordertopbot2 ctd">Trans. Count</th>
                                       <!--  <th class="text-center bordertopbot2 ctd">Coupon Issued</th> -->
                                      <!--   <th class="text-right bordertopbot2 rtd">Coupon Amount</th> -->
                                        <th class="text-right bordertopbot2 rtd">Penalty Amount</th>
                                        <th class="text-right bordertopbot2 rtd">Charge Amount</th>
                                        <th class="text-right bordertopbot2 rtd">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $trans_count = 0;
                                    $coupon = 0;
                                    $coupon_amt = 0;
                                    $penalty = 0;
                                    $penalty1 = 0;
                                    $lost_of_ticket = 0;
                                    foreach ($g_totals as $key => $value) :
                                        $trans_count += $value['trans_count'];
                                        $coupon += $value['coupon'];
                                        $coupon_amt += $value['coupon_amt'];
                                        $penalty += $value['penalty'];
                                        $penalty1 += $value['penalty1'];
                                        $lost_of_ticket += $value['lost_of_ticket'];
                                    ?>
                                        <tr>
                                            <td class="text-center ctd"><?php echo $value['trans_count'] . " | " . $key ?></td>
                                            <td class="text-center ctd"><?php echo $value['trans_count'] ?></td>
                                            <!-- <td class="text-center ctd"><?php echo $value['coupon'] ?></td> -->
                                            <!-- <td class="text-right rtd"><?php echo number_format($value['coupon_amt'], 2) ?></td> -->
                                            <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['penalty1'])) + floatval(str_replace(",", "", $value['lost_of_ticket'])), 2) ?></td>

                                            <td class="text-right rtd"><?php echo number_format($value['penalty'], 2) ?></td>
                                            <td class="text-right rtd">
                                                <?php echo number_format($value['penalty1'] + $value['lost_of_ticket'] + $value['penalty'], 2) ; ?>
                                                <!-- <?php echo number_format($value['coupon_amt'] + $value['penalty'], 2); ?> -->
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr id="mr_jay" style="border-top: 3px solid black; border-bottom: 3px solid black;">
                                        <td class="text-center bordertopbot3  ctd"></td>
                                        <td class="text-center bordertopbot3  ctd"><?php echo $trans_count; ?></td>
                                       <!--  <td class="text-center bordertopbot3  ctd"><?php echo $coupon; ?></td> -->
                                       <!--  <td class="text-right  bordertopbot3 rtd"><?php echo number_format($coupon_amt, 2); ?></td> -->
                                        <td class="text-right  bordertopbot3 rtd"><?php echo number_format($penalty1 + $lost_of_ticket, 2); ?></td>
                                        <td class="text-right  bordertopbot3 rtd"><?php echo number_format($penalty, 2); ?></td>
                                        <td class="text-right  bordertopbot3 rtd"><?php echo number_format($penalty1 + $lost_of_ticket + $penalty, 2); ?></td>
                                        <!-- <td class="text-right  bordertopbot3 rtd"><?php echo number_format($coupon_amt + $penalty, 2); ?></td> -->
                                    </tr>
                                </tfoot>
                            </table>
                            <hr style="border-width:0;color:gray;background-color:gray">

                        </div>
                        <div class="col-md-12" id="elem4" style="margin-top: 5%;">
                            <label>
                                <center>
                                    <b><span style="font-weight: bold;">Prepared By:</span></b><br><br><br>
                                    <u><?php echo $user_data->name; ?></u>
                                    <br>
                                    <b><span style="font-weight: bold;">Signature</span></b>
                                    <br>
                                    <label><b><span style="font-weight: bold;">Date:</span> </b><u><?php echo date('F d, Y'); ?></u></label>
                                </center>
                            </label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right" style="margin-top: 5%;">
                            <hr>
                            <div>
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