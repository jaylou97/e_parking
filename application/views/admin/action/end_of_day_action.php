<script type="text/javascript">
	$('#tbl_end_of_day').DataTable({
		destroy:true,
		'ajax':'<?php echo base_url('get_end_of_day_data')?>',
	});
	selectMonthAndYear();
	function selectMonthAndYear(){
		d = new Date();
		m = d.getMonth() + 1;
		y = d.getFullYear();
		$.ajax({
			url:'get_months_data',
			method:'POST',
			dataType:'json',
			success:function(data){
				$.each(data, function(i, d) {
					$('#my_month').append($('<option/>',{
						value:d.date_val,
						text:d.month_name
					}));
				});
				$('#my_month').val(m);
			}
		});
		$.ajax({
			url:'get_years_data',
			method:'POST',
			dataType:'json',
			success:function(data){
				$.each(data, function(i, d) {
					$('#my_year').append($('<option/>',{
						value:d.my_yr,
						text:d.my_yr
					}));
				});
				$('#my_year').val(y);
			}
		});
	}
	function view_EndOfday_Data(dt, id){
		window.location.href = 'report_incharge_endofday/'+dt+'/'+id;
	}
	$('#my_month, #my_year').on('change', function(event){
		var mm = $('#my_month').val();
		var yy = $('#my_year').val();
		$('#tbl_end_of_day').DataTable({
			destroy:true,
			'ajax':'<?php echo base_url()?>getendofdaydata/'+mm+'/'+yy,
		});
	});
</script>