<script type="text/javascript">
	tbl_logbook = $('#tbl_parking_log').DataTable({
		destroy:true,
		'ajax':'<?php echo base_url('get_daily_trans')?>',
		"columnDefs":[
		{className: "text-right", "targets": []/*[5]*/},
		{ type: 'date', 'targets': [0] }
		],
		order: [[ 0, 'asc' ]], 
		dom: 'Bfrtip',
		buttons: [
		'copy', 'csv', 'excel',
		{
		  extend: 'print',
		  title: '',
		  message: '<h2><center>Plaza Marcela</center></h2><center>Corner Pamaong & Belderol Street Cogon District Tagbilaran City Philippines <br></center><h3><center>Parking Logbook</center><h3><br>',
		  customize: function(win) {
		    $(win.document.body).append('<html elements here>'); //after the table
		    $(win.document.body).prepend('<html elements here>'); //before the table
		  }
		}
		]
	});
	$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
	$('#trans_date, #trans_date2').on('change', function(){
		var dt = $('#trans_date').val();
		var dt2 = $('#trans_date2').val();

		if(dt > dt2){
			$('#trans_date').css({ 'border-color': 'red' });
			$('#trans_date').unbind('focus').bind('focus', function() {
				$(this).removeAttr('style');
			});
			$('#trans_date2').css({ 'border-color': 'red' });
			$('#trans_date2').unbind('focus').bind('focus', function() {
				$(this).removeAttr('style');
			});
		}else{
			$('#trans_date').removeAttr('style');
			$('#trans_date2').removeAttr('style');
			$('#tbl_parking_log').DataTable({
				destroy:true,
				'ajax':'<?php echo base_url()?>get_daily_trans_2/'+dt+'/'+dt2,
				"columnDefs":[
				{className: "text-right", "targets": []/*[5]*/},
				{ type: 'date', 'targets': [0] }
				],
				order: [[ 0, 'asc' ]],
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'excel',
				{
				  extend: 'print',
				  title: '',
				  message: '<h2><center>Plaza Marcela</center></h2><center>Corner Pamaong & Belderol Street Cogon District Tagbilaran City Philippines <br></center><h3><center>Parking Logbook</center><h3><br>',
				  customize: function(win) {
				    $(win.document.body).append('<html elements here>'); //after the table
				    $(win.document.body).prepend('<html elements here>'); //before the table
				  }
				}
				]
			});
			$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
		}
		
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
    $('#trans_date').attr('max', maxDate);
     $('#trans_date2').attr('max', maxDate);
    });

	/*end jay code*/

</script>