<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/university/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Oct 2019 02:17:54 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/favicon.png">
	<title><?php if($page_title != '' || $page_title != NULL){ echo $page_title; }else{ echo 'E-Parking System | ASC';} ?></title>
	<link rel="stylesheet" type="text/css"
	href="<?php echo base_url()?>assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css"
	href="<?php echo base_url()?>assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
	<link href="<?php echo base_url()?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/dist/css/style.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/dist/css/pages/dashboard1.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/node_modules/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/node_modules/dropify/dist/css/dropify.min.css">
	<link href="<?php echo base_url()?>assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/dist/css/pages/user-card.css" rel="stylesheet">
</head>
<body class="skin-blue fixed-layout" >
	<div class="preloader">
		<div class="loader">
			<div class="spinner-border text-success" role="status">
				<span class="sr-only"></span>
			</div>
			<p class="loader__label">E-Parking System | ASC</p>
		</div>
	</div>
	<div id="main-wrapper">
		<header class="topbar animated bounceInDown">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header">
					<a class="navbar-brand" href="javascript:void(0)" onclick="e_park()">
						<b>
							<img src="<?php echo base_url()?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
						</b>
						<!--End Logo icon -->
						<span class="hidden-xs"><span class="font-bold">E-Parking</span>System</span>
					</a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav mr-auto">
						<!-- This is  -->
						<li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
						<li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
						<!-- ============================================================== -->
						<!-- Search -->
						<!-- ============================================================== -->
						<li class="nav-item">
						</li>
					</ul>
					<ul class="navbar-nav my-lg-0">
						<li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="<?php echo base_url(); ?>About" ><i class="icons-Information"></i> <small>About</small></a>

						</li>
						<li class="nav-item dropdown u-pro">
							<a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $this->session->userdata('profile_pic');?>" alt="user" class=""> <span class="hidden-md-down"><?php echo $this->session->userdata('usertype')?> &nbsp;</span> </a>
							<div class="dropdown-menu dropdown-menu-right animated flipInY">
								<a href="javascript:void(0)" onclick="myprofile('<?php echo $this->session->userdata('name')?>')" class="dropdown-item"><i class="ti-user"></i> My Profile</a>                
								<a href="javascript:void(0)" class="dropdown-item" onclick="AccSettings()"><i class="ti-settings"></i> Account Setting</a>
								<a href="javascript:void(0)" onclick="logout_user()" class="dropdown-item"><i class=" icons-Power-3 "></i> Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- modal profile -->
		<style type="text/css">
			#usertbl101 {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}
			#usertbl101 td, #usertbl101 th {
				border: 1px solid #ddd;
				padding: 6px;
				background-color: #f2f2f2;
			}
			#usertbl101 th {
				padding-top: 10px;
				padding-bottom: 10px;
				text-align: left;
				background-color: #3399ff;
				color: white;
			}
		</style>
		<div id="profile_modal" class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel"><i class="icon-user"></i> User Profile</h4>
						<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="card" id="pp_div">
									<div class="card-body">
										<center class="m-t-30"> <a class="image-popup-vertical-fit" onclick="hide_m()" href="<?php echo $this->session->userdata('profile_pic');?>"><img src="<?php echo $this->session->userdata('profile_pic');?>" class="img-circle" width="150" /></a>
											<h4 class="card-title m-t-10"><?php echo $user_data->name?></h4>
											<h6 class="card-subtitle"><?php echo $user_data->position?></h6>
										</center>
									</div>
								</div>
								<div class="col-md-12" id="change_pp_div">
									<div class="card">
										<div class="card-body">
											<form method="POST" enctype="multipart/form-data" id="fileUploadForm">
												<input type="file" id="input-file-max-fs" name="userfile" class="dropify" data-max-file-size="2M" />
												<div class="row" style="margin-top: 20px;">

													<input type="submit" class="btn btn-md btn-info" value="Save"  style="width: 40%; margin: 0 2% 0 8%;">
													<input type="button" class="btn btn-md btn-secondary" value="Cancel" style="width: 40%; margin: 0 8% 0 2%;" onclick="cancel_change_pp()">

												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<table id="usertbl101">
									<thead>
										<tr>
											<th colspan="2"><center><h4 style="font-weight: bold; font-family: adobe hebrew;">User Information</h4></center></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-right"><label style="font-weight: bold;">Employee No:</label></td>
											<td><input type="text" value="<?php echo $user_data->emp_no ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>
										<tr>
											<td class="text-right"><label style="font-weight: bold;">Employee ID:</label></td>
											<td><input type="text" value="<?php echo $user_data->emp_id ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>
										<tr>
											<td class="text-right"><label style="font-weight: bold;">Payroll No:</label></td>
											<td><input type="text" value="<?php echo $user_data->payroll_no ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>
										<tr>
											<td class="text-right"><label style="font-weight: bold;">Department:</label></td>
											<td><input type="text" value="<?php echo $department->dept_name; ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>
										<tr>
											<td class="text-right"><label style="font-weight: bold;">Position:</label></td>
											<td><input type="text" value="<?php echo $user_data->position ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>
										<tr>
											<td class="text-right"><label style="font-weight: bold;">Employee Type:</label></td>
											<td><input type="text" value="<?php echo $user_data->emp_type ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>

										<tr>
											<td class="text-right"><label style="font-weight: bold;">Status:</label></td>
											<td><input type="text" value="<?php echo $user_data->current_status ?>" style="width: 100%; border-radius: 5px;" readonly></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect text-left" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>