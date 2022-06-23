
<!-- swal alert -->
 <script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2@11.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2.all.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>


<script type="text/javascript">
  var myVar2 = setInterval(myTimerzx, 1000);
  function myTimerzx() {
    var d = new Date();
    day = d.getDate();
    dd = d.getDay();
    days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    month = d.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    year = d.getFullYear();
    time = d.toLocaleTimeString()
    date = months[month] + " " + day+", "+year;
    TimeDate =date +' '+time;
    document.getElementById('myruntime').innerHTML = time;
    document.getElementById('myrundate').innerHTML = date ;
   // document.getElementById('datoh').innerHTML = date ;
  }
    // On change of range Date
    // ===============================================
    $('#dtstart, #dtend').on('change', function(){
    var dtstart = $('#dtstart').val();
    var dtend = $('#dtend').val();

 months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

var dateAr = dtstart.split('-');
var new_dtstart = months[Number(dateAr[1])-1] + ' ' + dateAr[2] + ', ' + dateAr[0];

var dateAr2 = dtend.split('-');
var new_dtend = months[Number(dateAr2[1])-1] + ' ' + dateAr2[2] + ', ' + dateAr2[0];

    $('#dtstart2').html(new_dtstart);
    $('#dtend2').html(new_dtend);

      if(dtstart <= dtend)
      {
        $('#tbl_blacklisted').DataTable({
           "searching": false,
            "paging": false,
            "info": false,
         destroy:true,
         'ajax':'<?php echo base_url()?>get_blacklist_data/'+dtstart+'/'+dtend,
         "autoWidth": false,
         "columnDefs":[
         {className: "text-center", "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12]/*[10]*/}
         ],
         dom: 'Bfrtip',
         buttons: [

         ]
       });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
      }
      else
      {
        Swal.fire({
          type: 'error',
          title: 'Invalid Date Range!',
          text:'start date must be less than the end date'
        })
      }
      $.post(
        'count_blacklisted_list', 
        {
          dtstart:dtstart,
          dtend:dtend
        }, 
        function(msg){
          if(msg.trim() == 'success'){
            $('#printx').prop('disabled', false);
            $('#generate_textfile_btn').prop('disabled', false);
          }else{
            $('#printx').prop('disabled', true);
            $('#generate_textfile_btn').prop('disabled', true);
          }
        });
    });


    // On Load for Table
    //===================================================
    var dtstart = $('#dtstart').val();
    var dtend = $('#dtend').val();


     months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

var dateAr = dtstart.split('-');
var new_dtstart = months[Number(dateAr[1])-1] + ' ' + dateAr[2] + ', ' + dateAr[0];

var dateAr2 = dtend.split('-');
var new_dtend = months[Number(dateAr2[1])-1] + ' ' + dateAr2[2] + ', ' + dateAr2[0];

    $('#dtstart2').html(new_dtstart);
    $('#dtend2').html(new_dtend);
    $(function () {
      $('#tbl_blacklisted').DataTable({

      "searching": false,
            "paging": false,
            "info": false,
       destroy:true,
       'ajax':'<?php echo base_url()?>get_blacklist_data/'+dtstart+'/'+dtend,
       "autoWidth": false,
       "columnDefs":[
       {className: "text-center", "targets": [1,2,3,4,5,6,7,8,9,10,11,12]/*[10]*/}
       ],
       dom: 'Bfrtip',
       buttons: []
     });
      $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

            $.post(
        'count_blacklisted_list', 
        {
          dtstart:dtstart,
          dtend:dtend
        }, 
        function(msg){
          if(msg.trim() == 'success'){
            $('#printx').prop('disabled', false);
            $('#generate_textfile_btn').prop('disabled', false);
          }else{
            $('#printx').prop('disabled', true);
            $('#generate_textfile_btn').prop('disabled', true);
          }
        });


    });
    $('#btn_back').on('click', function(){
      window.history.back();
    });





    // on click For Print
    //===================================================
    $('#printx').on('click',function(){
     var dtstart = $('#dtstart').val();
     var dtend = $('#dtend').val();
     $.ajax({
      url:'get_blacklist_data_list',
      method:'POST',
      data:{
        dtstart:dtstart,
        dtend:dtend
      },
      dataType:'json',
      success:function(data){
       var dev=$('#elem').html();
       var dev1=$('#elem1').html();
       var dev2=$('#elem2').html();
       var dev3=$('#elem3').html();
       var mywindow = window.open('', 'PRINT', 'height=400,width=600');
       mywindow.document.write('<html><head><title>' + document.title  + '</title>');
       mywindow.document.write('<style> .borderall{ border: 1px solid black;height: 35px;}.bordertopbot1{border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;height: 35px;}.bordertopbot2{border-top: 1px solid black;border-bottom: 1px solid black;height: 35px;}.borderbotri{;border-bottom: 1px solid black;border-right: 1px solid black;height: 35px;}.borderbot{border-bottom: 1px solid black;height: 35px;}.bordertop{border-top: 1px solid black;height: 35px;}.ctd{text-align: center;font-size:13px;}.rtd{text-align:right;font-size:12px;}.lined{font-style:bold;font-weight:bolder;}');
       mywindow.document.write('.item1{grid-area: main; text-align:top;}.item2{grid-area: right; margin-left:25%; }.grdcon{display:grid; grid-template-areas:"main right";grid-gap: 0px;} ');
       mywindow.document.write('</style></head><body style="font-family: Poppins,sans-serif;">');
       mywindow.document.write('<div class="grdcon"><div class="item1">'+dev+'</div>');
       mywindow.document.write('<div class="item2">'+dev1+'</div></div>');
       mywindow.document.write('<div style="margin-top:10px;">'+dev2+'</div>');
       mywindow.document.write('<div style="margin-top:30px;">'+dev3+'</div>');
       mywindow.document.write('<div style="margin-top:50px;"><table class="borderall" cellspacing="0" width="100%">');
       mywindow.document.write('<thead>');
       mywindow.document.write('<tr>');
       mywindow.document.write('<th class="borderbotri ctd"><b>No.</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Plate Number</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Vehicle Type</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Date&Time In</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Date Escaped</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Ticket No.</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Trans. No.</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Total Hours</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Excess Hours</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Penalty Amt.</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Charge Amt.</b></th>');
       mywindow.document.write('<th class="borderbotri ctd"><b>Total Amt.</b></th>');
       mywindow.document.write('</tr>');
       mywindow.document.write('</thead>');
       mywindow.document.write('<tbody>');
       $.each(data, function(i, d) {
        mywindow.document.write('<tr>');
        mywindow.document.write('<td class="bordertop ctd">'+d.num+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.plateNumber+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.v_type+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.time_date_in+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.date_listed+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.ticket_num+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.trans_num+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.totalHrs+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.excessHrs+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.penaltyA+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.totCharge+'</td>');
        mywindow.document.write('<td class="bordertop ctd">'+d.totalAmt+'</td>');
        mywindow.document.write('</tr>');
      });
       mywindow.document.write('</body>');
       mywindow.document.write('</table></div>');
       mywindow.document.write('</body></html>');
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            mywindow.print();
            mywindow.close();
            return true;
          }
        });
   });


                    /*jay code*/
                    
     /*disable future date*/
    $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#dtstart').attr('max', maxDate);
     $('#dtend').attr('max', maxDate);
    });


    function viewmodal_blacklisted_js(id)
             {
               $("#view_blaclisted_modal").modal("show"); 
                  // console.log(id);

                 $.ajax({
                          url: '<?php echo base_url() ?>get_blacklisted_route',
                          type: 'GET',
                          data: { id:id },   
                          success: function (data) { 
                              $("#div_display_blacklisted").html(data);
                          }
                      }); 
             }


    function unblock_js()
              {

                 Swal.fire({
                          title: 'Are you sure you want to unblock?',
                          icon:'warning',
                          showDenyButton: true,
                         /* showCancelButton: true,*/
                          confirmButtonText: 'Yes',
                          denyButtonText: 'No',
                          customClass: {
                            actions: 'my-actions',
                          /*  cancelButton: 'order-1 right-gap',*/
                            confirmButton: 'order-2',
                            denyButton: 'order-3',
                          }
                        }).then((result) => {
                          if (result.isConfirmed) 
                          {

                            var status = 'PAID';
                            var currentdate = new Date(); 
                            var datetime =  currentdate.getFullYear() + "-"
                                            + (currentdate.getMonth()+1)  + "-" 
                                            + currentdate.getDate() + " "  
                                            + currentdate.getHours() + ":"  
                                            + currentdate.getMinutes() + ":" 
                                            + currentdate.getSeconds();

                             $.ajax({
                                             type:'post',
                                             url:'<?php echo base_url(); ?>unblock_route',
                                             data:{
                                             'uid': $('#transactionno').val(),
                                             'status': status,
                                             'datepaid': datetime
                                             },
                                             dataType:'json', 
                                             success: function(data)
                                          {

                                             console.log(data);        
                                             Swal.fire('Successfully Unblock!', '', 'success')
                                             
                                             setTimeout(function()
                                                {
                                                  window.location.reload();
                                                }, 2000);
                                             
                                          }    
                                      });
                             
                          } else if (result.isDenied) {
                            Swal.fire('Cancel unblock', '', 'info')
                          }
                        })
              }

   function generate_textfile_js()
  {
     var dtstart = $('#dtstart').val();
     var dtend = $('#dtend').val();
    if(dtstart <= dtend)
    {

      $.ajax({

               type:'post',
                url:'<?php echo base_url(); ?>generate_texfile_route/'+dtstart+'/'+dtend,
               data:{
                    'dtstart' :dtstart,
                    'dtend':dtend
                  },
           dataType:'json',
            success:function(data)
            {
              Swal.fire('Success', 'Successfully Generate Text File', 'success')
            }
            });
    }
     else
    {
      Swal.fire({
        type: 'error',
        title: 'Invalid Date Range!',
        text:'start date must be less than the end date'
      })
    }
    
  }

                    /*end jay code*/
 </script>

