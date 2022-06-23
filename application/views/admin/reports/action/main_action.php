


<script type="text/javascript">
  function blockSpecialChars(x){
    var z;
    document.all ? z = x.keyCode : z = x.which;
    return ((z > 64 && z < 91) || (z > 96 && z < 123) || z == 46 || z == 44 || z == 8 || z == 32 || (z >= 48 && z <= 57));
  }
  function nameOnly(x){
    var z;
    document.all ? z = x.keyCode : z = x.which;
    return ((z > 64 && z < 91) || (z > 96 && z < 123) || z == 8 || z == 32);
  }
  function numbersOnly(x){
    var z;
    document.all ? z = x.keyCode : z = x.which;
    return (z >= 48 && z <= 57);
  }
  function blockSpecialCharsAdd(x){
    var z;
    document.all ? z = x.keyCode : z = x.which;
    return ((z > 64 && z < 91) || (z > 96 && z < 123) || z == 46 || z == 35 || z == 44 || z == 8 || z == 32 || (z >= 48 && z <= 57));
  }
  $(document).ready(function() {   
    $('.dropify').dropify();
    $('.dropify-fr').dropify({
      messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
      }
    });
    var drEvent = $('#input-file-events').dropify();
    drEvent.on('dropify.beforeClear', function(event, element) {
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });
    drEvent.on('dropify.afterClear', function(event, element) {
      alert('File deleted');
    });
    drEvent.on('dropify.errors', function(event, element) {
      console.log('Has Errors');
    });
    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
      e.preventDefault();
      if (drDestroy.isDropified()) {
        drDestroy.destroy();
      } else {
        drDestroy.init();
      }
    })
    $('form#fileUploadForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      console.log(formData);
      $.ajax({
        url:'save_user_pp',
        method:'POST',
        data:formData,
        success:function(msg){
          if(msg == 'success'){
           alertToust('success', 'Profile picture is successfully changed.');
           setTimeout('window.location.reload();', 3000);
         }else{
           alertToust('info', msg);
         }
       },
       async: false,
       cache: false,
       contentType: false,
       processData: false
     });
    });
  });
  var myVar = setInterval(myTimer22, 1000);
  function myTimer22() {
    var d = new Date();
    day = d.getDate();
    dd = d.getDay();
    days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    month = d.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    year = d.getFullYear();
    time = d.toLocaleTimeString()
    date = days[dd] + " " + months[month] + " " + day+", "+year;
    TimeDate =date +' '+time;
    document.getElementById('currentTimer').innerHTML = TimeDate;
  }     
  function alertToust(stat, msg){
    if(stat == 'info'){
     $.toast({
      heading: 'Information',
      text: msg,
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'info',
      hideAfter: 3000, 
      stack: 6
    });
   }
   if(stat == 'warning'){
     $.toast({
      heading: 'Warning',
      text: msg,
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'info',
      hideAfter: 3000, 
      stack: 6
    });
   }
   if(stat == 'success'){
     $.toast({
      heading: 'Success',
      text: msg,
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'info',
      hideAfter: 3000, 
      stack: 6
    });
   }
   if(stat == 'danger'){
     $.toast({
      heading: 'Danger',
      text: msg,
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'info',
      hideAfter: 3000, 
      stack: 6
    });
   }
 }   
 function e_park(){
  window.location.reload();
}
function cancel_change_pp(){
  $('#pp_div').show();
  $('#change_pp_div').hide();
}
function changepp(){
 $('#pp_div').hide();
 $('#change_pp_div').show();
}
function myprofile(id){
  $('#profile_modal').modal('show');
  $('#pp_div').show();
  $('#change_pp_div').hide();
}
function hide_m(){
  $('#profile_modal').modal('hide');
}
function logout_user(){
  $('#logoutModal').modal('show');
}

function logoutNako()
{
  $('#logoutModal').modal('hide');
  $(".preloader").fadeOut();

   /*Swal.fire({
    position: 'inherit',
    type: 'success',
    title: 'Logout Confirmed!',
    showConfirmButton: false,
    timer: 3000
  })*/
  Swal.fire('Successfully Logout', '', 'success')
  setTimeout("window.location.href ='../../LogOut';", 2000) ;
}

function AccSettings(){
  $('#myModalAccountSettings').modal('show');
}
$('#change_div1').hide();
$('#change_div2').hide();
var paramz = '';
function changeSettings(param){
  paramz = param;
  if(param == 1){
    $('#myModalLabel101').html('Change Username');
    $('#change_div1').show();
    $('#change_div2').hide();
  }
  if(param == 2){
    $('#change_div1').hide();
    $('#change_div2').show();
    $('#myModalLabel101').html('Change Password');
  }
  $('#myModalAccountSettings').modal('hide');
  $('#ChangeSettingModal').modal('show');
}
function submitChange(paz){
  var param = paramz;
  if(param == '1'){
    var user = $('#change_user').val();
    if(user == ''){
      $('#change_user').css({ 'border-color': 'red' });
      $('#change_user').unbind('focus').bind('focus', function() {
        $(this).removeAttr('style');
      });
      // alertToust('info', 'Field must not be empty.');
      Swal.fire('Empty', 'Field must not be empty', 'error')
    }else if(!/^[a-zA-Z0-9\s]*$/g.test(user)){
      $('#change_user').css({ 'border-color': 'red' });
      $('#change_user').unbind('focus').bind('focus', function() {
        $(this).removeAttr('style');
      });
      // alertToust('warning', 'Invali input, please input letters and numbers only.');
      Swal.fire('Empty', 'Please input letters and numbers only', 'error')

    }else{
      $.post('../../change_username', {user: user}, function(msg) {
        if(msg == 'success'){
          // alertToust('success', 'Username is successfully changed.');
          Swal.fire('Username is successfully changed', '', 'success')
          closeChange();
          setTimeout("window.location.href='<?php echo base_url() ?>LogOut'", 2000);
        }else if(msg == 'duplicate'){
          // alertToust('info', 'Please enter other username.');
          Swal.fire('Already Exist', 'Please enter another username', 'success')
          $('#change_user').val('');
        }
        else{
          // alertToust('info', msg);
          Swal.fire(msg, '', 'error')
        }
      });
    }
  }
  if(param == '2'){
    var op = $('#old_pass').val();
    var np = $('#new_pass').val();
    var cnp = $('#con_new_pass').val();

    if(op == '' || np == '' || cnp == ''){
      if(op == ''){
        $('#old_pass').css({ 'border-color': 'red' });
        $('#old_pass').unbind('focus').bind('focus', function() {
          $(this).removeAttr('style');
        });
      }
      if(np == ''){
        $('#new_pass').css({ 'border-color': 'red' });
        $('#new_pass').unbind('focus').bind('focus', function() {
          $(this).removeAttr('style');
        });
      }
      if(cnp == ''){
        $('#con_new_pass').css({ 'border-color': 'red' });
        $('#con_new_pass').unbind('focus').bind('focus', function() {
          $(this).removeAttr('style');
        });
      }
      // alertToust('info', 'Fields must not be empty.');
      Swal.fire('Empty', 'Fields must not be empty', 'error')

    }else if(!/^[a-zA-Z0-9\s]*$/g.test(op) || !/^[a-zA-Z0-9\s]*$/g.test(np) || !/^[a-zA-Z0-9\s]*$/g.test(cnp)){
      if(!/^[a-zA-Z0-9\s]*$/g.test(op)){
       $('#old_pass').css({ 'border-color': 'red' });
       $('#old_pass').unbind('focus').bind('focus', function() {
        $(this).removeAttr('style');
      });
     }
     if(!/^[a-zA-Z0-9\s]*$/g.test(np)){
      $('#new_pass').css({ 'border-color': 'red' });
      $('#new_pass').unbind('focus').bind('focus', function() {
        $(this).removeAttr('style');
      });
    }
    if(!/^[a-zA-Z0-9\s]*$/g.test(cnp)){
      $('#con_new_pass').css({ 'border-color': 'red' });
      $('#con_new_pass').unbind('focus').bind('focus', function() {
        $(this).removeAttr('style');
      });
    }
  }else if(np != cnp){
    $('#new_pass').css({ 'border-color': 'red' });
    $('#new_pass').unbind('focus').bind('focus', function() {
      $(this).removeAttr('style');
    });
    $('#con_new_pass').css({ 'border-color': 'red' });
    $('#con_new_pass').unbind('focus').bind('focus', function() {
      $(this).removeAttr('style');
    });
    Swal.fire('Mismatch', 'Please check your new and confirm password', 'error')
    // alertToust('info', "Oops, new password & confirm new password doesn't match.");
  }
  else{
   $.post('../../change_password',{paz:paz, op:op, np:np},function(msg){
    if(msg == 'success'){
      // alertToust('success', 'Password is successfully changed.');
      Swal.fire('Password is successfully changed', '', 'success')
      closeChange();
      setTimeout("window.location.href='<?php echo base_url() ?>LogOut'", 2000);
    }else if(msg == 'error'){
     $('#old_pass').val('');
     $('#new_pass').val('');
     $('#con_new_pass').val('');
     // alertToust('info', 'Oops, old password input is incorrect.');
    Swal.fire('Incorrect', 'Old password is incorrect', 'error')
   }else{
    // alertToust('info', msg);
    Swal.fire(msg, '', 'error')
  }
});
 }
}
}
function closeChange(){
  paramz = '';
  $('#change_user').val('');
  $('#old_pass').val('');
  $('#new_pass').val('');
  $('#con_new_pass').val('');
  $('#ChangeSettingModal').modal('hide');

  $('#change_user').removeAttr('style');
  $('#old_pass').removeAttr('style');
  $('#new_pass').removeAttr('style');
  $('#con_new_pass').removeAttr('style');
}

</script>