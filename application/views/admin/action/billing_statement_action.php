<script type="text/javascript">
	$(function () {
		$('#tbl_billing_statement').DataTable({
             destroy:true,
            'ajax':'<?php echo base_url('get_billing_statement_data')?>',
            "autoWidth": false,
            "sScrollX": "110%",
            "sScrollXInner": "120%",
            "columnDefs":[
            {className: "text-right", "targets": [6]}
            ],
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            });
       $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
	});
    $('#dtstart').on('change', function(event){
    var dtstart = $(this).val();
    var dtend = $('#dtend').val();
    if(dtstart <= dtend){
        $(this).removeAttr('style');
       $('#tbl_billing_statement').DataTable({
             destroy:true,
            'ajax':'<?php echo base_url()?>get_billing_statement_datavs2/'+dtstart+'/'+dtend,
            "autoWidth": false,
            "sScrollX": "110%",
            "sScrollXInner": "120%",
            "columnDefs":[
            {className: "text-right", "targets": [6]}
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
    var dtend = $(this).val();
    if(dtstart <= dtend){
        $(this).removeAttr('style');
       $('#tbl_billing_statement').DataTable({
             destroy:true,
            'ajax':'<?php echo base_url()?>get_billing_statement_datavs2/'+dtstart+'/'+dtend,
            "autoWidth": false,
            "sScrollX": "110%",
            "sScrollXInner": "120%",
            "columnDefs":[
            {className: "text-right", "targets": [6]}
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