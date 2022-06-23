

<!-- swal alert -->
 <script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2@11.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2.all.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>


<script type="text/javascript">
	$('#tbl_end_of_shift').DataTable({
		destroy:true,
		'ajax':'<?php echo base_url('display_incharge_remittance_route')?>',
	});
	
     function get_incharge(id)
    {
       $("#remittance_incharge_modal").modal("show"); 
           console.log(id);

         $.ajax({
                  url: '<?php echo base_url() ?>get_incharge_remittance_route',
                  type: 'GET',
                  data: { id:id },   
                  success: function (data) { 
                      $("#div_display_remittance").html(data);
                  }
              }); 
    }

    function remit_js()
      {

         Swal.fire({
                  title: 'Are you sure you want to remit?',
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

                     if($('#amountremit').val() == '')
                     {
                        $('#amountremit').css({ 'border-color': 'red' });
                        $('#amountremit').unbind('focus').bind('focus', function() {
                            $(this).removeAttr('style');
                        });
                        Swal.fire('Empty', 'Please input amount', 'error')
                     }
                     else
                     {
                    var currentdate = new Date(); 
                    var datetime =  currentdate.getFullYear() + "-"
                                    + (currentdate.getMonth()+1)  + "-" 
                                    + currentdate.getDate() + " "  
                                    + currentdate.getHours() + ":"  
                                    + currentdate.getMinutes() + ":" 
                                    + currentdate.getSeconds();

                     $.ajax({
                                     type:'post',
                                     url:'<?php echo base_url(); ?>save_remittance_route',
                                     data:{
                                     'p_attendant': $('#parkingattendant_hide').val(),
                                     'amount': $('#amountremit').val(),
                                     'datepaid': datetime,
                                     'onek': $('#1k').val(),
                                     'fiveh': $('#5h').val(),
                                     'oneh': $('#1h').val(),
                                     'fifty': $('#fifty').val(),
                                     'twenty': $('#twenty').val(),
                                     'coins': $('#coins').val()
                                     },
                                     dataType:'json', 
                                     success: function(data)
                                  {

                                     console.log(data);        
                                     Swal.fire('Successfully remit!', '', 'success')
                                     
                                     setTimeout(function()
                                        {
                                          window.location.reload();
                                        }, 2000);
                                     
                                  }    
                              });
                     }
                     
                  } else if (result.isDenied) {
                    Swal.fire('Cancel remit', '', 'info')
                  }
                })
      }


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
    $('#trans_date').attr('max', maxDate);
    });

</script>