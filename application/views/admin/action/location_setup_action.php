<script type="text/javascript">
	tbl_location = $('#tbl_location').DataTable({
		destroy:true,
		'ajax':'<?php echo base_url('getLocationData')?>',
	});
	function btn_add_Location(){
		$('#myModal').modal('show');
		$('#title_id').html('Add Location');
		$('#btn_1').show();
		$('#btn_2').hide();
	}
	function btn_enterdata(){
		var location = $('#location_id').val();
		var location_address = $('#loc_add').val();
		if(location == '' || location_address == ''){
			if(location == ''){
				$('#location_id').css({ 'border-color': 'red' });
				$('#location_id').unbind('focus').bind('focus', function() {
					$(this).removeAttr('style');
				});
			}
			if(location_address == ''){
				$('#loc_add').css({ 'border-color': 'red' });
				$('#loc_add').unbind('focus').bind('focus', function() {
					$(this).removeAttr('style');
				});
			}
			alertToust('info', "Fields must not be empty...");
		}else{
			$.ajax({
				url:'add_location_admin',
				method:'POST',
				data:{
					location:location,
					location_address:location_address
				},
				// dataType:'json',
				success:function(msg){

					if(msg == 'success'){
						tbl_location.ajax.reload(null, false);
						close_btn();	
						alertToust('success', 'Location is successfully saved.');
					}else{
						alertToust('info', msg);
						$('#location_id').css({ 'border-color': 'red' });
						$('#location_id').unbind('focus').bind('focus', function() {
							$(this).removeAttr('style');
						});
						$('#loc_add').css({ 'border-color': 'red' });
						$('#loc_add').unbind('focus').bind('focus', function() {
							$(this).removeAttr('style');
						});
					}
				}
			});
		}
	}
	function close_btn(){
		$('#myModal').modal('hide');
		$('#hide_id').val('');
		var nn = ['location_id','loc_add'];
		for (var i = 0; i < 2; i++) {
		$('#'+nn[i]).val('');
		$('#'+nn[i]).removeAttr('style');
		}
	}
	function btn_action(x, id){
		// $.ajax
	}
	function edit_location(id, dd, lad){
		$('#hide_id').val(id);
		$('#location_id').val(dd);
		$('#loc_add').val(lad);
		$('#myModal').modal('show');
		$('#title_id').html('Edit Location');
		$('#btn_2').show();
		$('#btn_1').hide();
	}
	function btn_editdata(){
		var id = $('#hide_id').val();
		var location = $('#location_id').val();
		var location_address = $('#loc_add').val();

		if(location == '' || location_address == ''){
			if(location == ''){
				$('#location_id').css({ 'border-color': 'red' });
				$('#location_id').unbind('focus').bind('focus', function() {
					$(this).removeAttr('style');
				});
			}
			if(location_address == ''){
				$('#loc_add').css({ 'border-color': 'red' });
				$('#loc_add').unbind('focus').bind('focus', function() {
					$(this).removeAttr('style');
				});
			}
			alertToust('info', "Fields must not be empty...");
		}else{
			$.ajax({
				url:'edit_location_admin',
				method:'POST',
				data:{
					id:id,
					location:location,
					location_address:location_address
				},
				dataType:'json',
				success:function(msg){

					if(msg == 'success'){
						tbl_location.ajax.reload(null, false);
						close_btn();	
						alertToust('success', 'Location is successfully edited.');
					}else{
						alertToust('info', msg);
						$('#location_id').css({ 'border-color': 'red' });
						$('#location_id').unbind('focus').bind('focus', function() {
							$(this).removeAttr('style');
						});
					}
				}
			});
		}
	}
	function btn_action(par, id){
		$.post('activate_location_admin',{par:par,id:id}, function(msg){
			if(msg != 'error'){
				alertToust('success', msg);
				tbl_location.ajax.reload(null, false);
			}else{
				alertToust('info', 'Oops, something went wrong...');
			}
		});
	}
</script>