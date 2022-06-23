<script type="text/javascript">
	$('#tbl_end_of_shift').DataTable({
		destroy:true,
		'ajax':'<?php echo base_url('get_EndOfShift_by_incharge')?>',
	});
	function view_EndOfShift_Data(id){
		var dt = $('#trans_date').val();
		$.post('search_endofshift_data', {id:id, dt:dt}, function(msg){
			console.log(msg);

			if(msg.trim() == "no_data"){
        		/*alertToust('info', 'Incharge has no data record.');*/

        			/*jay code*/
        			Swal.fire('Incharge has no data record', 'Please check the date!', 'info')
        			/*end of jay code*/

			}else if(msg.trim() == "inactive"){
        		/*alertToust('info', 'Sorry, Incharge is already inactivate.');*/

        			/*jay code*/
        			Swal.fire('Sorry', 'Incharge is already inactivate!', 'error')
        			/*end of jay code*/
			}
			else{
				window.location.href = "report_incharge_endofshift/"+id+"/"+dt;
			}
		});
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