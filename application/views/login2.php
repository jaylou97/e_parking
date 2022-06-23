<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
  <title>E-Parking System | Login Page</title>
  <link href="<?php echo base_url(); ?>assets/dist/css/pages/login-register-lock.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">
  <style type="text/css">
    .ins:hover {
      color: white;
    }

    .ins {
      color: white;
      text-align: center;
    }

    #canvas {
      background-color: #333;
      border-radius: 60%;
      margin-left: 20px;
      margin-top: 20px;
    }

    #note {
      margin-top: 5%;
      margin-left: 10px;
      height: 400px;
      width: 250px;
    }

    #pad {
      background-image: url('assets/images/yellow.jpg');
      background-size: cover, contain;
      border-radius: 10%;
      padding: 10px;
      height: 150px;
      width: 150px;
      margin-top: 250px;
      text-align: center;
      margin-left: 40px;
    }

    #msg_log {
      color: red;
      background-color: white;
      font-size: 15px;
      font-style: bold;
    }
  </style>
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="loader">
      <div class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <p class="loader__label">Please Wait...</p>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <section id="wrapper" class="login-register login-sidebar" style="background-image: url('<?php echo base_url(); ?>assets/images/users/pm.jpg'); background-size: cover, contain; ">

    <div id="note" style="position: fixed; ">
      <canvas class="animated rollIn" id="canvas" width="200" height="200" style="position: fixed;"></canvas>
      <div id="pad" class="animated rollIn">
        <b><label id="greet"></label><br>
          <label id="week"></label><br>
          <label id="date"></label><br>
          <label id="time"></label></b>
      </div>
    </div>


    <div class="login-box card animated bounceInLeft" style="background-color: #333; opacity: 0.87;">
      <div class="card-body">
        <div class="form-horizontal form-material text-center" id="loginform">
          <div><img src="<?php echo base_url(); ?>assets/images/E-Parking-System.png" alt="Alta Citta" style="border-radius: 20%; height: 35px; width: 140px; margin-top:60px;"> <!-- <img src="<?php echo base_url(); ?>assets/images/users/alturas.jpg" alt="Alta Citta" style="border-radius: 20%; height: 60px; width: 120px; opacity: 0.75;"> -->
          </div>
          <div>
            <p id="msg_log"></p>
          </div>
          <div class="form-group m-t-40">
            <div class="col-xs-12">
              <input class="form-control ins" autofocus="" style="color:white ;" type="text" required="" autocomplete="off" placeholder="Username" id="username">
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control ins" style="color:white ;" type="password" required="" placeholder="Password" id="password">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
            </div>
          </div>
          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <input type="button" class="btn btn-outline-info btn-md btn-block text-uppercase btn-rounded" onclick="loginform_action()" id="log_btn" value="Log In">

            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">

            </div>
          </div>
          <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
              <p class="text-info m-l-5">@<?php echo date('Y'); ?> E-Parking System | ASC.</p>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="<?php echo base_url(); ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Sweet-Alert  -->
  <script src="<?php echo base_url(); ?>assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <!--Custom JavaScript -->
  <script type="text/javascript">
    $(function() {
      $(".preloader").fadeOut();
    });
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    });
    $('#to-recover').on("click", function() {
      $("#loginform").slideUp();
      $("#recoverform").fadeIn();
    });
    $('#username,#password').on("keyup", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        loginform_action();
      }
    });

    function loginform_action() {
      var username = $('#username').val();
      var password = $('#password').val();
      if (username.replace(/\s/g, '') == '' || password.replace(/\s/g, '') == '') {
        $('#username').css({
          'background-color': 'transparent'
        });
        $('#password').css({
          'background-color': 'transparent'
        });
        if (username.replace(/\s/g, '') == '') {
          $('#username').css({
            'background-color': '#a74b4ba6'
          });
          $('#username').unbind('focus').bind('focus', function() {
            $(this).removeAttr('style');
            $(this).css({
              'color': '#fff'
            });
            $('#msg_log').removeAttr('style');
            $('#msg_log').html('');
          });
        }
        if (password.replace(/\s/g, '') == '') {
          $('#password').css({
            'background-color': '#a74b4ba6'
          });
          $('#password').unbind('focus').bind('focus', function() {
            $(this).removeAttr('style');
            $(this).css({
              'color': '#fff'
            });
            $('#msg_log').removeAttr('style');
            $('#msg_log').html('');
          });

        }
        $('#msg_log').html('Please input username & password...');
        $('#msg_log').css({
          'color': 'red',
          'font-family': 'adobe hebrew'
        });
      } else {
        $.ajax({
          url: 'validate_login',
          method: 'POST',
          data: {
            username: username,
            password: password
          },
          dataType: 'json',
          success: function(data) {
            if (data == 'invalid') {
              $('#msg_log').html('Invalid, username and/or password...');
              $('#msg_log').css({
                'color': 'red',
                'font-family': 'adobe hebrew'
              });
              $('#username').css({
                'background-color': 'transparent'
              });
              $('#password').css({
                'background-color': 'transparent'
              });
              $('#username').unbind('focus').bind('focus', function() {
                $(this).removeAttr('style');
                $(this).css({
                  'color': '#fff'
                });
                $('#msg_log').removeAttr('style');
                $('#msg_log').html('');
              });
              $('#password').unbind('focus').bind('focus', function() {
                $(this).removeAttr('style');
                $(this).css({
                  'color': '#fff'
                });
                $('#msg_log').removeAttr('style');
                $('#msg_log').html('');
              });
            } else {
              $('#password').removeAttr('style');
              $('#username').removeAttr('style');
              $('#msg_log').html('');
              $('#log_btn').val('Loading.....');
              $(".preloader").fadeOut();
              setTimeout('window.location.href = "' + data + '";', 1000);

            }

          }
        });
      }
    }
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
      drawFace(ctx, radius);
      drawNumbers(ctx, radius);
      drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
      var grad;
      ctx.beginPath();
      ctx.arc(0, 0, radius, 0, 2 * Math.PI);
      ctx.fillStyle = 'white';
      ctx.fill();
      grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
      grad.addColorStop(0, '#333');
      grad.addColorStop(0.5, 'white');
      grad.addColorStop(1, '#333');
      ctx.strokeStyle = grad;
      ctx.lineWidth = radius * 0.1;
      ctx.stroke();
      ctx.beginPath();
      ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
      ctx.fillStyle = '#333';
      ctx.fill();
    }

    function drawNumbers(ctx, radius) {
      var ang;
      var num;
      ctx.font = radius * 0.15 + "px arial";
      ctx.textBaseline = "middle";
      ctx.textAlign = "center";
      for (num = 1; num < 13; num++) {
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius * 0.85);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius * 0.85);
        ctx.rotate(-ang);
      }
    }

    function drawTime(ctx, radius) {
      var now = new Date();
      var hour = now.getHours();
      var minute = now.getMinutes();
      var second = now.getSeconds();

      hour = hour % 12;
      hour = (hour * Math.PI / 6) +
        (minute * Math.PI / (6 * 60)) +
        (second * Math.PI / (360 * 60));
      drawHand(ctx, hour, radius * 0.5, radius * 0.07);

      minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
      drawHand(ctx, minute, radius * 0.8, radius * 0.07);

      second = (second * Math.PI / 30);
      drawHand(ctx, second, radius * 0.9, radius * 0.02);
    }

    function drawHand(ctx, pos, length, width) {
      ctx.beginPath();
      ctx.lineWidth = width;
      ctx.lineCap = "round";
      ctx.moveTo(0, 0);
      ctx.rotate(pos);
      ctx.lineTo(0, -length);
      ctx.stroke();
      ctx.rotate(-pos);
    }
  </script>
  <script type="text/javascript">
    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    function startTime() {
      var today = new Date();
      var wdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      var wn = wdays[today.getDay()];
      var g;
      var greet;
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      if (h > 11 && h < 24) {
        g = 'PM';
      } else {
        g = 'AM';
      }


      if (h > 12) {
        h -= 12;

        if (h >= 1 && h < 6) {
          greet = 'Good Afternoon';
        } else if (h >= 6 && h < 12) {
          greet = 'Good Evening';
        } else {
          greet = 'Its Midnight';
        }

        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('greet').innerHTML = greet;
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s + " " + g;
        document.getElementById('week').innerHTML = "Today is " + wn;
      } else {
        if (h > 0 && h < 4) {
          greet = 'Good Evening';
        } else if (h == 12) {
          greet = 'Good Noon';
        } else {
          greet = 'Good Morning';
        }
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('greet').innerHTML = greet;
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s + " " + g;
        document.getElementById('week').innerHTML = "Today is " + wn;
      }
      t = setTimeout(function() {
        startTime()
      }, 500);
    }
    startTime();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var mot = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var yyyy = today.getFullYear();
    today = mot[mm - 1] + ' ' + dd + ', ' + yyyy;
    document.getElementById('date').innerHTML = today;
  </script>
</body>

</html>