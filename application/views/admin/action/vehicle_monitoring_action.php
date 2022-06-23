<script type="text/javascript">
	$(function () {
		$('#tbl_vehicle_monitoring').DataTable({
			destroy:true,
			'ajax':'<?php echo base_url('get_v_monitoring_list_data')?>',
			"autoWidth": false,
			"sScrollX": "100%",
			"sScrollXInner": "100%",
			"columnDefs":[
			{className: "text-center", "targets": [3]},
			{className: "text-center", "targets": [4]}
			],
			dom: 'Bfrtip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
	});
  $('#dtstart').on('change', function(event){
        var dtstart = $('#dtstart').val();
        var dtend = $('#dtend').val();
        if(dtstart <= dtend){
            $(this).removeAttr('style');
           $('#tbl_vehicle_monitoring').DataTable({
			destroy:true,
			'ajax':'<?php echo base_url()?>gen_v_monitoring_data/'+dtstart+'/'+dtend,
			"autoWidth": false,
			"sScrollX": "100%",
			"sScrollXInner": "100%",
			"columnDefs":[
			{className: "text-center", "targets": [3]},
			{className: "text-center", "targets": [4]}
			],
			dom: 'Bfrtip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        }else{
          $(this).css({ 'border-color': 'red' });
          $(this).unbind('focus').bind('focus', function() {
            $(this).removeAttr('style');
        });
          alertToust('info', 'Invalid date input, please check and try again.');
      }
  });
    $('#dtend').on('change', function(event){
        var dtstart = $('#dtstart').val();
        var dtend = $('#dtend').val();
        if(dtstart <= dtend){
            $(this).removeAttr('style');
           $('#tbl_vehicle_monitoring').DataTable({
			destroy:true,
			'ajax':'<?php echo base_url()?>gen_v_monitoring_data/'+dtstart+'/'+dtend,
			"autoWidth": false,
			"sScrollX": "100%",
			"sScrollXInner": "100%",
			"columnDefs":[
			{className: "text-center", "targets": [3]},
			{className: "text-center", "targets": [4]}
			],
			dom: 'Bfrtip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        }else{
          $(this).css({ 'border-color': 'red' });
          $(this).unbind('focus').bind('focus', function() {
            $(this).removeAttr('style');
        });
          alertToust('info', 'Invalid date input, please check and try again.');
      }
  });
</script>