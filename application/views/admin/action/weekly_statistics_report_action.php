<script type="text/javascript">
	$('#tbl_weekly_statistics').DataTable({
		destroy: true,
		'ajax': '<?php echo base_url('get_weekly_stat_data') ?>',
	});
	selectMonthAndYear();

	function selectMonthAndYear() {
		d = new Date();
		m = d.getMonth() + 1;
		y = d.getFullYear();



		$.ajax({
			url: 'get_months_data',
			method: 'POST',
			dataType: 'json',
			success: function(data) {
				$.each(data, function(i, d) {
					$('#my_month').append($('<option/>', {
						value: d.date_val,
						text: d.month_name
					}));
				});
				$('#my_month').val(m);
			}
		});
		$.ajax({
			url: 'get_years_data',
			method: 'POST',
			dataType: 'json',
			success: function(data) {
				$.each(data, function(i, d) {
					$('#my_year').append($('<option/>', {
						value: d.my_yr,
						text: d.my_yr
					}));
				});
				$('#my_year').val(y);
			}
		});
	}

	function view_WeeklyStat_Data(f_dt, l_dt) {
		$.post('getNumOfWeeklyData', {
			f_dt: f_dt,
			l_dt: l_dt
		}, function(num) {
			if (num.trim() > 0) {
				window.location.href = 'report_incharge_weekly/' + f_dt + '/' + l_dt;
			} else {
				alertToust('info', "There's no data to generate.");
			}
		});
	}
	$('#my_month, #my_year').on('change', function(event) {
		var mm = $('#my_month').val();
		var yy = $('#my_year').val();
		$('#tbl_weekly_statistics').DataTable({
			destroy: true,
			'ajax': '<?php echo base_url() ?>get_WeeklyStatData/' + mm + '/' + yy,
		});
	});
</script>