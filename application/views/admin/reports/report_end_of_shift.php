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
     border-top: 1px solid black;
     border-bottom: 2px solid black;
     font-weight: bold;
   }

   .tbl_2 {
     margin-bottom: 2px;
   }

   #personList {
     list-style-type: none;
     margin: 0;
     padding: 0;
     width: 100%;
   }

   li {
     display: inline;
     float: left;
     margin: 3%;
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
         <h4 class="text-themecolor" style="margin-top: 11px;"><?php echo $mm_data['page_theme'] ?></h4>
       </div>
       <div class="col-md-7 align-self-center text-right">
         <div class="d-flex justify-content-end align-items-center">
           <span class="caption-helper" style="margin-top: 11px;" id="currentTimer"></span>
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
             <!--  <input id="incharge_id" type="" name="" value="<?php echo $incharge_id; ?>"> 
              <input id="dtendz" type="" name="" value="<?php echo $dtendz; ?>">  -->
               <h4 id="elem"><b><?php echo $mm_data['mall_name']; ?></b><br> <small><?php echo $mm_data['address']; ?></small></h4> <br>
               <h4 id="elem2"><b><?php echo $mm_data['title']; ?></b><br><small>As of <?php echo $mm_data['date_end']; ?></small></h4>
             </div>
             <div class="col-md-3 ">
               <label id="elem1"><b><span style="font-weight: bold;">Location:</span></b> <span><?php echo $location_data->location; ?></span><br><b><span style="font-weight: bold;">Run Date:</span></b> <span id="myrundate"></span><br><b><span style="font-weight: bold;">Run Time:</span></b> <span id="myruntime"></span></label>
               <br><!-- <label id="elem5"><b><span style="font-weight: bold;">Login:</span></b><br><b><span style="font-weight: bold;">Logout:</span> </b></label> -->
             </div>
           </div>
           <!-- <hr> -->
           <div class="row">
             <div id="elem3" class="col-md-12">
               <div class="table-responsive m-t-40" style="clear: both;">
                 <label style="margin: 5px 0px -10px 0px; font-weight: bolder;"><b>Cashier: </b><?php echo $mm_data['cashier']; ?></label>
                 <table class="mytable tbl_2" width="100%">
                   <thead>
                     <tr>
                       <th class="text-center bordertopbot2 ctd">Vehicle Type</th>
                       <th class="text-center bordertopbot2 ctd">Transaction No.</th>

                       <th class="text-center bordertopbot2 ctd">Time Trans.</th>
                       <th class="text-right bordertopbot2 rtd">Penalty amt.</th>
                       <th class="text-right bordertopbot2 rtd">Charge Amt.</th>
                       <th class="text-right bordertopbot2 rtd">Total Amt.</th>
                     </tr>
                   </thead>
                   <tbody>

                     <?php
                      $w2 = 0;
                      $w4 = 0;
                      $totalw2 = 0;
                      $totalw4 = 0;
                      $penalty1 = 0;
                      foreach ($data_result4 as $key => $value) :
                        if ($value['amt'] == 50 && floatval(str_replace(",", "", $value['charges'])) > 0) {
                          $w2 += 1;
                          $totalw2 += $value['penalty1'];
                        }
                        if ($value['amt'] == 100 && floatval(str_replace(",", "", $value['charges'])) > 0) {
                          $w4 += 1;
                          $totalw4 += $value['penalty1'];
                        }
                        // if ($value['amt'] == 50 && floatval(str_replace(",", "", $value['penalty1'])) > 0) {
                        //   $totalw2 += 1;
                        // }
                        // if ($value['amt'] == 100 && floatval(str_replace(",", "", $value['penalty1'])) > 0) {
                        //   $totalw2 += 1;
                        // }
                      ?>
                       <tr>
                         <td class="text-center ctd"><?php echo $value['v_type'] ?></td>
                         <td class="text-center ctd"><?php echo $value['trans_num'] ?></td>

                         <td class="text-center ctd"><?php echo $value['time_trans'] ?></td>
                         <td class="text-right rtd"><?php echo number_format($value['penalty1'] + $value['lost_of_ticket'], 2) ?></td>

                         <td class="text-right rtd"><?php echo $value['charges'] ?></td>
                        <!--  <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['charges'])), 2); ?></td> -->

                                <!-- jay code -->
                          <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['penalty1'] + $value['lost_of_ticket'] + $value['charges'])), 2); ?></td>
                                <!-- end of jay code -->

                         <!-- <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['charges'])) + floatval(str_replace(",", "", $value['coupon_amt'])), 2); ?></td> -->
                       </tr>
                     <?php endforeach ?>

                   </tbody>
                 </table>
                 <table class="mytable" id="tbl_1" width="100%">
                   <thead>
                     <tr>
                       <th class="text-center bordertopbot2 ctd">Vehicle Type</th>
                       <th class="text-center bordertopbot2 ctd">Transaction Count</th>

                       <th class="text-center bordertopbot2 ctd">Excess Time Count</th>
                       <th class="text-right bordertopbot2 rtd">Penalty amt.</th>
                       <th class="text-right bordertopbot2 rtd">Charge Amt.</th>
                       <th class="text-right bordertopbot2 rtd">Total Amt.</th>
                     </tr>
                     <hr style="border-width:0;color:gray;background-color:gray">
                   </thead>
                   <tbody>
                     <?php foreach ($data_result as $key => $value) : ?>
                       <tr>
                         <td class="text-center ctd"><?php echo $value['trans_count'] . " | " . $value['v_type'] ?></td>
                         <td class="text-center ctd"><?php echo $value['trans_count'] ?></td>
                         <!-- <td class="text-center ctd"><?php echo $value['coupon'] ?></td> -->
                         <td class="text-center ctd">
                           <?php
                            if ($value['v_type'] == '2-w') {
                              //echo $w2;

                              /*jay code*/
                              $w2 = $value['penalty'] / 10;
                              echo $w2;
                              /*end jay code*/

                              $penalty1 = $totalw2;
                            }
                            if ($value['v_type'] == '4-w') {
                              //echo $w4;

                               /*jay code*/
                               $w4 = $value['penalty'] / 20;
                               echo $w4;
                              /*end jay code*/
                              
                              $penalty1 = $totalw4;
                            }
                            ?>

                         </td>


                         <!-- <td class="text-right rtd"><?php  echo $value['penalty1'];  ?> </td> -->
                         <td class="text-right rtd"><?php  echo number_format($penalty1 + $value['lost_of_ticket'], 2);  ?> </td>
                         <td class="text-right rtd"><?php echo number_format($value['penalty'], 2) ?> </td>
                        <!--  <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['penalty'])), 2); ?></td> -->

                                    <!-- jay code -->
                            <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $penalty1 + $value['lost_of_ticket'] + $value['penalty'])), 2); ?></td>
                                    <!-- end of jay code -->

                         <!-- <td class="text-right rtd"><?php echo number_format(floatval(str_replace(",", "", $value['coupon_amt'])) + floatval(str_replace(",", "", $value['penalty'])), 2); ?></td> -->
                       </tr>
                     <?php endforeach ?>

                     <?php  
                     $total_es = 0;
                      foreach ($data_result2 as $key => $value) : 
                        $total_es += number_format($value['penalty'], 2);
                        $total_es += number_format($value['lost_of_ticket'], 2);
                        $total_es += $totalw4;
                        $total_es += $totalw2;
                      ?>

                       <div class="col-md-12" id="elem5" style="margin-top: 1%; margin-bottom: 5%;">
                        
                       <tr style="border-top: 2px solid black; border-bottom: 3px solid black; font-weight: bold;">
                        <label style="font-weight: bold;">GRAND TOTAL SUMMARY COLLECTION <br></label>
                         <!-- <td class="text-center bordertopbot3 ctd"><?php echo $value['trans_count'] ?></td>
                         <td class="text-center bordertopbot3 ctd"><?php echo $value['trans_count'] ?></td>
                         <td class="text-center bordertopbot3 ctd"><?php echo $w2 + $w4; ?></td>
                         <td class="text-right bordertopbot3 ctd"><?php echo number_format($totalw2 + $totalw4, 2); ?></td>
                         <td class="text-right bordertopbot3 rtd"><?php echo number_format($value['penalty'], 2); ?> </td>
                         <td class="text-right bordertopbot3 rtd"><?php echo $value['tot_amt'] ?> </td> -->

                                      <!-- jay code -->
                         <td class="text-center bordertopbot3 ctd"></td>
                         <td class="text-center bordertopbot3 ctd"><?php echo $value['trans_count'] ?></td>
                         <td class="text-center bordertopbot3 ctd"><?php echo $w2 + $w4; ?></td>
                         <td class="text-right bordertopbot3 rtd"><?php echo number_format($totalw2 + $totalw4 + $value['lost_of_ticket'], 2); ?></td>
                         <td class="text-right bordertopbot3 rtd"><?php echo number_format($value['penalty'], 2); ?> </td>
                         <td class="text-right bordertopbot3 rtd"><?php echo number_format($totalw2 + $totalw4 +$value['penalty'] + $value['lost_of_ticket'], 2); ?> </td>
                                      <!-- end of jay code -->

                       </tr>
                      
                     <?php endforeach ?>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
        <hr style="border-width:0;color:gray;background-color:black">

<div class="row"> 
  <div class="col-sm-6 form-inline" id="elem4">
      <div class="col-md-12 text-right"  style="margin-top: -1%; margin-left: 300px;">
        <h3 class="text-right rtdb"><b>Breakdown </b></h3>
        <table style="float: right;">

          <?php foreach ($data_result5 as $key => $value) : ?>

          <?php endforeach ?>
          <tr>
            <th class="text-right border_r rtd" scope="col">
              <?php 
                  echo 'PCS&nbsp;';
              ?>
            </th>

            <th class="text-right border_r rtd" scope="col">
              <?php 
                  echo 'PCS';
              ?>
            </th>
          </tr>

          <tr>
            <th class="text-right border_v rtd" scope="row">
              <?php 
                  echo '₱1,000: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['1k'].'&nbsp;&nbsp;&nbsp;';
              ?>
            </th>
        
            <th class="text-right border_v rtd" scope="row">
              <?php 
                  echo '₱500: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['5h'].'&nbsp;&nbsp;';
              ?>
            </th>
          </tr>

          <tr>
            <th class="text-right border_v rtd" scope="row">
              <?php  
                  echo '₱100: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['1h'].'&nbsp;&nbsp;&nbsp;';
              ?>
            </th>
         
            <th class="text-right border_v rtd" scope="row">
              <?php  
                  echo '₱50: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['fifty'].'&nbsp;&nbsp;'; 
              ?>
            </th>
          </tr>

          <tr>
            <th class="text-right border_v rtd" scope="row">
              <?php 
                  echo '₱20: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['twenty'].'&nbsp;&nbsp;&nbsp;';   
              ?>
            </th>
         
            <th class="text-right border_v rtd" scope="row">
              <?php 
                  echo 'coins: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['coins'].'&nbsp;&nbsp;'; 
              ?>
            </th>
          </tr>  
         
        </table>
      </div>  
  </div>

  <!-- <div class="col-sm-6 form-inline" id="elem4">
      <div class="col-md-12 text-right" style="margin-top: 1%; margin-left: 300px;">
        <h3 class="text-right rtd"><b>Variance </b></h3>
        <table style="float: right;">

          <?php foreach ($data_result5 as $key => $value) : 
            $result = $total_es - $value['r_amount_total'];
            $result2 = $value['r_time'];
            ?>
          <?php endforeach ?>

          <tr>
            <th class="text-right border_r rtd" scope="col">
              <?php 
                if($result2 == 'NO DATA') 
                {
                 echo 'Not Yet Remit:';
                }
                else
                {
                  if($result == 0) 
                    {    
                     echo 'Balance:';
                    }
                    elseif($result > 0) 
                    {
                     echo 'Short:';
                    }
                    elseif($result < 0) 
                    {
                     echo 'Over:';
                    }
                }
              ?>&nbsp;&nbsp;&nbsp;&nbsp; 
            </th>

            <th class="text-right border_r rtd" scope="col">
              <?php
                if($result2 == 'NO DATA') 
                {
                  echo '₱ 0';
                }
                else
                {
                  echo '₱ '.number_format($result, 2); 
                }
              ?>
               </th>
          </tr>  

        </table>
      </div>  
  </div> -->

  <div class="col-sm-6 form-inline" id="elem7">
      <div class="col-md-12 text-right" style="margin-top: 1%;">
        <h3 class="text-right rtd"><b>Remittance </b></h3>
        <table style="float: right;">
          <tr>
            <th class="text-right border_r rtd" scope="col"><?php echo 'Time'; ?>&nbsp;&nbsp;&nbsp;&nbsp; </th>
            <th class="text-right border_r rtd" scope="col"><?php echo 'Amount'; ?> </th>
          </tr>

          <?php foreach ($data_result5 as $key => $value) : ?>

          <tr>
            <td class="rtd" scope="row">&nbsp;

              <?php 

              if($value['r_time'] == 'NO DATA')
              {
                echo '----&nbsp;&nbsp;&nbsp;&nbsp;';
              }
              else
              {
                echo date('g:i A', strtotime($value['r_time'])).'&nbsp;&nbsp;&nbsp;&nbsp;'; 
              }

              ?>  
              </td>
            <td class="rtd" scope="row">&nbsp;<?php echo '₱ '.number_format($value['r_amount'], 2).'&nbsp;'; ?></td>
          </tr>
          
          <?php endforeach ?>

          <tr>
            <th scope="row" class="border_r rtd">&nbsp;&nbsp;Total Remittance:&nbsp;&nbsp;&nbsp;</th>
            <th scope="row" class="border_r rtd"><?php echo '₱ '.number_format($value['r_amount_total'], 2).'&nbsp;'; ?></th>
          </tr>

          <!-- -----------Variance--------------- -->
            <?php foreach ($data_result5 as $key => $value) : 
            $result = $total_es - $value['r_amount_total'];
            $result2 = $value['r_time'];
            ?>
          <?php endforeach ?>

          <tr>
            <th class="text-right border_v rtd" scope="col">
              <?php 
                if($result2 == 'NO DATA') 
                {
                 echo 'Not Yet Remit:';
                }
                else
                {
                  if($result == 0) 
                    {    
                     echo '&nbsp;&nbsp;Variance &nbsp;/&nbsp; Balance:';
                    }
                    elseif($result > 0) 
                    {
                     echo '&nbsp;&nbsp;Variance &nbsp;/&nbsp; Short:';
                    }
                    elseif($result < 0) 
                    {
                     echo '&nbsp;&nbsp;Variance &nbsp;/&nbsp; Over:';
                    }
                }
              ?>&nbsp;&nbsp;&nbsp; 
            </th>

            <th class="text-right border_v rtd" scope="col">
              <?php
                if($result2 == 'NO DATA') 
                {
                  echo '₱ 0'.'&nbsp;';
                }
                else
                {
                  echo '₱ '.number_format($result, 2).'&nbsp;'; 
                }
              ?>
               </th>
          </tr>  

        </table>
      </div>
  </div>  

</div>  


            <!--  <div class="col-md-12" id="elem4">
               <?php if (count($short_over_data['over_offset'])) : ?>
                 <div class="table-responsive m-t-40" style="clear: both;">
                   <label style="font-weight: bold; color: green;">POSIBLE OVERAGE OFFSETTING TO OTHER CASHIER</label>
                   <table width="100%" class="mytable tbl_2">
                     <thead>
                       <tr>
                         <th class="text-center text-uppercase bordertopbot2 ctd">Cashier's Name</th>
                         <th class="text-center text-uppercase bordertopbot2 ctd">Transaction No.</th>

                         <th class="text-center text-uppercase bordertopbot2 ctd">Time Trans.</th>
                         <th class="text-right text-uppercase bordertopbot2 rtd">Charge Amount</th>
                       </tr>
                     </thead>
                     <tbody>

                       <?php
                        $total_over_amt_offset = 0;
                        foreach ($short_over_data['over_offset'] as $key => $value) :
                          $total_over_amt_offset += $value['penalty'];
                        ?>
                         <tr>
                           <td class="text-center ctd"><?php echo $value['name'] ?></td>
                           <td class="text-center ctd"><?php echo $value['checkDigit'] ?></td>
                           <td class="text-center ctd"><?php echo $value['checkDigit'] ?></td>
                           <td class="text-center ctd"><?php echo date('m-d-Y g:i:s a', strtotime($value['dateTimeIn'])) ?></td>
                           <td class="text-right rtd"><?php echo number_format($value['penalty'], 2); ?></td>
                         </tr>
                       <?php endforeach ?>

                     </tbody>
                     <tfoot>
                       <tr>
                         <td colspan="4" class="text-right bordertopbot2 rtd">
                           <label style="font-weight: bold;" class="text-uppercase"> Final Posible Overage Amount</label>
                         </td>
                         <td class="text-right bordertopbot2 rtd">
                           <?php echo number_format($total_over_amt_offset, 2); ?>
                         </td>
                       </tr>
                     </tfoot>
                   </table>
                 </div>
               <?php endif ?>
             </div> -->
             <!-- <div class="col-md-12" id="elem7">
               <?php if (count($short_over_data['short_offset'])) : ?>
                 <div class="table-responsive m-t-40" style="clear: both;">
                   <label style="font-weight: bold; color: red;">POSIBLE SHORTAGE OFFSETTING TO OTHER CASHIER</label>
                   <table width="100%" class="mytable tbl_2">
                     <thead>
                       <tr>
                         <th class="text-center text-uppercase bordertopbot2 ctd">Cashier's Name</th>
                         <th class="text-center text-uppercase bordertopbot2 ctd">Transaction No.</th>

                         <th class="text-center text-uppercase bordertopbot2 ctd">Time Trans.</th>
                         <th class="text-right text-uppercase bordertopbot2 rtd">Charge Amount</th>
                       </tr>
                     </thead>
                     <tbody>

                       <?php
                        $total_shor_amt_offset = 0;
                        foreach ($short_over_data['short_offset'] as $key => $value) :
                          $total_shor_amt_offset += $value['penalty'];
                        ?>
                         <tr>
                           <td class="text-center ctd"><?php echo $value['name'] ?></td>
                           <td class="text-center ctd"><?php echo $value['checkDigit'] ?></td>
                           <td class="text-center ctd"><?php echo $value['checkDigit'] ?></td>
                           <td class="text-center ctd"><?php echo date('m-d-Y g:i:s a', strtotime($value['dateTimeIn'])) ?></td>
                           <td class="text-right rtd"><?php echo number_format($value['penalty'], 2); ?></td>
                         </tr>
                       <?php endforeach ?>

                     </tbody>
                     <tfoot>
                       <tr>
                         <td colspan="4" class="text-right bordertopbot2 rtd">
                           <label style="font-weight: bold;" class="text-uppercase"> Final Posible Shortage Amount</label>
                         </td>
                         <td class="text-right bordertopbot2 rtd">
                           <?php echo number_format($total_shor_amt_offset, 2); ?>
                         </td>
                       </tr>
                     </tfoot>
                   </table>
                 </div>
               <?php endif ?>
             </div> -->
             <!-- <div class="col-md-12" id="elem6" style="margin-top: 10%"> -->
             <div class="col-md-12" id="elem6">
               <ul class="list-unstyled" id="personList">
                 <li>
                   <label>
                     <center>
                       <b><span style="font-weight: bold;">Prepared By:</span></b><br><br><br>
                       <u><?php echo $user_data->name; ?></u>
                       <br>
                       <b><span style="font-weight: bold;">Signature</span></b>
                       <br>
                       <label><b><span style="font-weight: bold;">Date: </span></b><u><?php echo date('F d, Y'); ?></u></label>
                     </center>
                   </label>

                 </li>
                 <li>
                   <label>
                     <center>
                       <b><span style="font-weight: bold;">Remitted By:</span></b><br><br><br>
                       <u><?php echo $mm_data['cashier']; ?></u>
                       <br>
                       <b><span style="font-weight: bold;">Signature</span></b>
                       <br>
                       <label><b><span style="font-weight: bold;">Date: </span></b><u><?php echo date('F d, Y'); ?></u></label>
                     </center>
                   </label>

                 </li>
                 <li>
                   <label>
                     <center>
                       <b><span style="font-weight: bold;">Received By:</span></b><br><br><br>
                       _______________________________
                       <br>
                       <b><span style="font-weight: bold;">Signature</span></b>
                       <br>
                       <label><b><span style="font-weight: bold;">Date: </span></b><u><?php echo date('F d, Y'); ?></u></label>
                     </center>
                   </label>

                 </li>
               </ul>
             </div>
           </div>

           <div class="col-md-12" style="margin-top: -1%; margin-bottom: 1%;">
             <hr>
             <div class="text-right">
               <!-- <button id="pdf_print" class="btn btn-info" onclick="pdf_print_js()"><i class=" icon-printer"></i> PDF Print </button> -->
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