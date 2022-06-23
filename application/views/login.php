<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/university/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Oct 2019 02:23:45 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">

    <title>E-Parking System | ASC</title>

    <!-- page css -->
    <link href="assets/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/dist/css/style.min.css" rel="stylesheet">
</head>

<body class="skin-default card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">E-Parking System | ASC</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?php base_url(); ?>assets/images/alta-citta.jpg);">
            <!-- clock ticking -->
            <div class=" card" style="float: left;">
                <canvas id="canvas" width="200" height="200" style="background-color:#333; border-radius: 60%; position: fixed; margin-left: 10px;"></canvas>
                <div style="position: fixed; background-image: url('assets/images/yellow.jpg'); background-size: cover, contain; margin-top: 14.7%; color: #123; border-radius: 10%; position: fixed; margin-left: 25px; padding: 20px;">


                    <b><label id="greet"></label><br>
                        <label id="week"></label><br>
                        <label id="date"></label><br>
                        <label id="time"></label></b>
                </div>
                <div>

                </div>
            </div>

            <div class="login-box card">
                <div class="card-body">
                    <!-- <form class="form-horizontal form-material" id="loginform"> -->
                    <h3 class="text-center m-b-20" style="font-family: adobe hebrew; font-weight: bold;"><img src="assets/images/E-Parking-System.png" alt="Logo" width="200px" height="40px"><br><small> Sign In </small></h3>
                    <span id="msg_log"></span>
                    <div class="form-group ">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon11" autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon33"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon33">
                        </div>

                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <input class="btn btn-block btn-lg btn-info btn-rounded" id="log_btn" onclick="loginform_action()" type="button" value="Log In" />
                            </div>
                        </div>

                        <!-- </form> -->
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
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });

        function loginform_action() {
            var username = $('#username').val();
            var password = $('#password').val();

            if (username.replace(/\s/g, '') == '' || password.replace(/\s/g, '') == '') {

                if (username.replace(/\s/g, '') == '') {
                    $('#username').css({
                        'border-color': 'red'
                    });
                    $('#username').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                        $('#msg_log').removeAttr('style');
                        $('#msg_log').html('');
                    });
                }
                if (password.replace(/\s/g, '') == '') {
                    $('#password').css({
                        'border-color': 'red'
                    });
                    $('#password').unbind('focus').bind('focus', function() {
                        $(this).removeAttr('style');
                        $('#msg_log').removeAttr('style');
                        $('#msg_log').html('');
                    });

                }
                $('#msg_log').html('Please input username & password...');
                $('#msg_log').css({
                    'color': 'red',
                    'font-family': 'adobe hebrew'
                });
            } else 
            {
                $.ajax({
                    url: 'validate_login',
                    method: 'POST',
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        if (data == 'invalid') 
                        {
                            $('#msg_log').html('Invalid, username or password...');
                            $('#msg_log').css({
                                'color': 'red',
                                'font-family': 'adobe hebrew'
                            });
                            $('#username').css({
                                'border-color': 'red'
                            });
                            $('#username').unbind('focus').bind('focus', function() {
                                $(this).removeAttr('style');
                                $('#msg_log').removeAttr('style');
                                $('#msg_log').html('');
                            });
                            $('#password').css({
                                'border-color': 'red'
                            });
                            $('#password').unbind('focus').bind('focus', function() {
                                $(this).removeAttr('style');
                                $('#msg_log').removeAttr('style');
                                $('#msg_log').html('');
                            });
                        }
                        else 
                        {
                            $('#password').removeAttr('style');
                            $('#username').removeAttr('style');

                            $('#msg_log').html('');
                            $('#log_btn').val('Please wait...');
                            setTimeout('window.location.href = "' + data + '";', 4000);

                        }

                    }
                });

            }
        }

        //display  clock
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
            //hour
            hour = hour % 12;
            hour = (hour * Math.PI / 6) +
                (minute * Math.PI / (6 * 60)) +
                (second * Math.PI / (360 * 60));
            drawHand(ctx, hour, radius * 0.5, radius * 0.07);
            //minute
            minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
            drawHand(ctx, minute, radius * 0.8, radius * 0.07);
            // second
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
            // add a zero in front of numbers<10

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
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;
        document.getElementById('date').innerHTML = today;
    </script>




</body>




<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/university/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Oct 2019 02:24:00 GMT -->

</html>