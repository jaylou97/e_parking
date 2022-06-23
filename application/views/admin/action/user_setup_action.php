 

<!-- swal alert -->
 <script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2@11.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2.all.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>


 <script type="text/javascript">
    tbl_user = $('#myTable').DataTable({
        destroy: true,
        'ajax':'<?php echo base_url('getUserlist_tbl_admin')?>' ,
        "columnDefs": [
    { "width": "15%", "targets": 5 }
  ]
    });
    function btn_add_user(){
      $('#myModal').modal('show');
  }
  $('input.typeahead').typeahead({
    source: function(query, process) {
        objects = [];
        map = {};
        return $.post('getEmpNames_usersetup_admin', { query: query }, function (data) {
            data = $.parseJSON(data);
            $.each(data, function(i, object) {
                map[object.label] = object;
                objects.push(object.label);
            });
            process(objects);
        });
    },
    updater: function(item) {
        $('#hiddenInputElement').val(map[item].id);
        $('#username').val(map[item].id);
        $('#password').val(map[item].pass);
        return item;
    }
});                    
  function close_btn(){
    namex = ['name', 'hiddenInputElement', 'username', 'password', 'confirmpassword', 'usertype']; 
    for (var i = 0; i < 6; i++) {
        $('#'+namex[i]).val('');
        $('#'+namex[i]).removeAttr('style');
    }
}
function btn_enterdata(){
    var name = $('#name').val();
    var name_id = $('#hiddenInputElement').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var usertype = $('#usertype').val();
    if(name == "" || name_id == "" || username == "" || password == "" || usertype == ""){
        if(username == ""){
            $('#username').css({ 'border-color': 'red' });
            $('#username').unbind('focus').bind('focus', function() {
                $(this).removeAttr('style');
            });
        }
        if(password == ""){
            $('#password').css({ 'border-color': 'red' });
            $('#password').unbind('focus').bind('focus', function() {
                $(this).removeAttr('style');
            });
        }
        if(usertype == ""){
            $('#usertype').css({ 'border-color': 'red' });
            $('#usertype').unbind('focus').bind('focus', function() {
                $(this).removeAttr('style');
            });
        }
        if(name == "" || name_id == ""){
            $('#name').css({ 'border-color': 'red' });
            $('#name').unbind('focus').bind('focus', function() {
                $(this).removeAttr('style');
            });
        }
        alertToust('info', 'Fields must not be empty...');
    }else{
        $.ajax({
            url:'save_user_admin',
            method:'POST',
            data:{
                name_id:name_id,
                username:username,
                password:password,
                usertype:usertype
            },
            dataType:'json',
            success:function(msg){
                if(msg == 'success'){
                    alertToust('success', 'User is successfully save...');
                    close_btn();
                    $('#myModal').modal('hide');
                    tbl_user.ajax.reload(null, false);
                }
                else{
                    alertToust('info', msg);
                }
            }
        });
    }
}
$('#name').on('keyup', function(event){
    if($(this).val() == ''){
     close_btn();
 }
});
function btn_action(x, id, ut){
    $.ajax({
        url:'update_user_stat_admin',
        method:'POST',
        data:{
            ut:ut,
            x:x,
            id:id
        },
        dataType:'json',
        success:function(msg){
            if(msg == 'success'){
                if(x == '1'){
                    alertToust('success', 'The user is now Active.');
                }
                if(x == '0'){
                    alertToust('success', 'The user is now Inactive.');
                }
                tbl_user.ajax.reload(null, false);
            }else{
                alertToust('info', msg);
            }
        }
    });
}
function btn_view(id, ut){
    $.ajax({
        url:'getuser_info_admin',
        method:'POST',
        data:{
            id:id,
            ut:ut
        },
        dataType:'json',
        success:function(data){
            $.each(data, function(i, d) {
             $('#empno').val(d.emp_no); 
             $('#empid').val(d.emp_id); 
             $('#payno').val(d.payroll_no); 
             $('#empname').val(d.department); 
             $('#emptype').val(d.emp_type); 
             $('#empposition').val(d.position); 
             $('#empstat').val(d.current_status); 
             $('#uname').html(d.name);
             $("#user_profile_pic").attr("src",d.profile_pic);
             $("#href_pp").attr("href",d.profile_pic);
             $('#position_area').html(d.position);
         }); 
            $('#largeModal_user_setup').modal('show');
        }
    });   
}
$('#href_pp').on('click', function(){
   $('#largeModal_user_setup').modal('hide');
});
function setup_location(id, emp_id){
    $('#myModal_location').modal('show');
    $('#hide_user_id').val(id);
    $('#hide_emp_id').val(emp_id);
    $('#tbl_location').DataTable({
        destroy:true,
        'ajax':'<?php echo base_url()?>get_emp_location/'+id,
        "paging" :        false,
        "searching" :     false,
        "bInfo" :         false,
        "oLanguage" : {"sZeroRecords": "", "sEmptyTable": ""},  
        "columnDefs" : [ { orderable: false, targets: '_all'} ]
    });
}
function btn_locationsetup(){
    $('#myModal_location22').modal('show');
    $('#myModal_location').modal('hide');
    id = $('#hide_user_id').val();
    $('#tbl_lsetup').DataTable({
        destroy:true,
        'ajax':'<?php echo base_url()?>set_emp_location/'+id,
        "paging" :        false,
        "searching" :     false,
        "bInfo" :         false,
        "oLanguage" : {"sZeroRecords": "", "sEmptyTable": ""},  
        "columnDefs" : [ { orderable: false, targets: '_all'} ]
    });
}
function showDSinput(id){
  if ($('#check_box'+id).is(":checked"))
  {
      $('#btn_id_sub').prop('disabled', false);
  }else{
    if ($(".check_box:checked").not(":disabled").length == 0)
    {
       $('#btn_id_sub').prop('disabled', true);
   }
}
}
function setup_user_location(){
    uid = $('#hide_user_id').val();
    eid = $('#hide_emp_id').val();
    var check = $("input[class='check_box']:checked").not(":disabled").map(function() {
        return this.value;
    }).get();
    $.each(check, function(i, d) {
        var x = check[i];
        $.ajax({
            url:'SetupUserLocationz',
            method:'POST',
            data:{
                uid:uid,
                eid:eid,
                x:x
            },
            dataType:'json',
            success:function(data){
                if(data == 'error2'){
                    alertToust('info', 'Location is already setup.');
                }else if(data == 'error'){
                    alertToust('info', 'Oops, something went wrong...');
                }else{
                    alertToust('success', data);
                    $('#myModal_location22').modal('hide');
                    $('#myModal_location').modal('show');
                    $('#tbl_location').DataTable({
                        destroy:true,
                        'ajax':'<?php echo base_url()?>get_emp_location/'+uid,
                        "paging" :        false,
                        "searching" :     false,
                        "bInfo" :         false,
                        "oLanguage" : {"sZeroRecords": "", "sEmptyTable": ""},  
                        "columnDefs" : [ { orderable: false, targets: '_all'} ]
                    });
                    $('#btn_id_sub').prop('disabled', true);
                }
            }
        });
    });
}
function delete_loc(id){
    idz = $('#hide_user_id').val();
    $.ajax({
        url:'delete_loc_user',
        method:'POST',
        data:{
            id:id
        },
        dataType:'json',
        success:function(msg){
            if(msg == 'success'){
                alertToust('success', 'Location assigned is successfully deleted.');
                $('#tbl_location').DataTable({
                    destroy:true,
                    'ajax':'<?php echo base_url()?>get_emp_location/'+idz,
                    "paging" :        false,
                    "searching" :     false,
                    "bInfo" :         false,
                    "oLanguage" : {"sZeroRecords": "", "sEmptyTable": ""},  
                    "columnDefs" : [ { orderable: false, targets: '_all'} ]
                });
            }else{
                alertToust('info', msg);
            }
        }
    });
}
$(document).ready(function(){
  $('form#fileUploadForm2').submit(function(e) {

    if($('#password').val() != $('#confirmpassword').val())
     {
      Swal.fire('Mismatch Password', 'Please check your password!', 'error')
      e.preventDefault();
     }

     else 
{
  e.preventDefault();
    Swal.fire({
        title: 'Are you sure you want to Submit?',
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
        if (result.isConfirmed) {

     e.preventDefault();
     var formData = new FormData(this);
     $.ajax({
        url:'save_user_adminv2',
        method:'POST',
        data:formData,
        dataType:'json',
        success:function(msg){
            if(msg.trim() == 'success'){
                // alertToust('success', 'User is successfully save...');
                Swal.fire('Successfully Added', '', 'success')
                close_btn();
                $('#myModal').modal('hide');
                tbl_user.ajax.reload(null, false);
            }else{
                if(msg.trim() == 'error1'){
                  if($('#username').val() == ''){
                      $('#username').css({ 'border-color': 'red' });
                      $('#username').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                    });
                  }
                  if($('#password').val() == ''){
                      $('#password').css({ 'border-color': 'red' });
                      $('#password').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                    });
                  }
                  if($('#confirmpassword').val() == ''){
                      $('#confirmpassword').css({ 'border-color': 'red' });
                      $('#confirmpassword').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                    });
                  }
                  /*if($('#password').val() != $('#confirmpassword').val()){
                      $('#password').css({ 'border-color': 'red' });
                      $('#password').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                    });
                      $('#confirmpassword').css({ 'border-color': 'red' });
                      $('#confirmpassword').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                    });
                  }*/
                  if($('#usertype').val() == ''){
                      $('#usertype').css({ 'border-color': 'red' });
                      $('#usertype').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                    });
                  }
                  if($('#hiddenInputElement').val() == ''){
                    $('#name').css({ 'border-color': 'red' });
                    $('#name').unbind('focus').bind('focus', function() {
                        $('#name').removeAttr('style');
                    });
                }
                // alertToust('info', 'Fields must not be empty...');
                 Swal.fire('All fields must not be empty...', '', 'error')

            }else{
                if(msg.trim() == 'error2'){
                   $('#username').css({ 'border-color': 'red' });
                   $('#username').unbind('focus').bind('focus', function() {
                    $(this).removeAttr('style');
                });
                   $('#password').css({ 'border-color': 'red' });
                   $('#password').unbind('focus').bind('focus', function() {
                    $(this).removeAttr('style');
                });
                   $('#confirmpassword').css({ 'border-color': 'red' });
                   $('#confirmpassword').unbind('focus').bind('focus', function() {
                    $(this).removeAttr('style');
                });

                   // alertToust('info', 'Invalid Username and/or Password, please try again.');
                    Swal.fire('Invalid Username and/or Password, please try again...', '', 'error')
               }
               else{
                // alertToust('info', msg);
                Swal.fire(msg, 'Please try another employee', 'error')
                    }
                }
            }
        },
        async: false,
        cache: false,
        contentType: false,
        processData: false
        });

                } else if (result.isDenied) {
                  Swal.fire('Cancel Submit', '', 'info')
                }
              })
  }
 });
});

$('#closebtn_id').on('click', function(){
    $('#btn_id_sub').prop('disabled', true);
});

function show_password_js() {
    var x = document.getElementById("password");
    var y = document.getElementById("confirmpassword");

    if (x.type === "password" && y.type === "password") {
      x.type = "text";
      y.type = "text";
    } else {
      x.type = "password";
      y.type = "password";
    }
  }

</script>