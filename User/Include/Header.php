<?php

$queryAccess = mysqli_query($con,"SELECT a.name,a.user_id,a.member_id,a.topup_flag,a.wallet,a.fundWallet,a.email_id,a.phone ,b.user_id  AS sponser_id FROM  meddolic_user_details a,meddolic_user_details b WHERE a.user_id='$_SESSION[member_user_id]'  AND a.sponser_id=b.member_id ");
if ($valAccess = mysqli_fetch_array($queryAccess)) {
	$userName = $valAccess['name'];
	$userId = $valAccess['user_id'];
	$memberId = $valAccess['member_id'];
	$topupFlag = $valAccess['topup_flag'];
	$incomeWallet = $valAccess['wallet'];
	$fundWallet = $valAccess['fundWallet'];
	$emailId = $valAccess['email_id'];
	$phone = $valAccess['phone'];
	  $sponser_id=$valAccess['sponser_id'];
	
	
} ?>


<body class="hold-transition dark-skin sidebar-mini theme-warning fixed">

	<div class="wrapper">
		<div id="loader"></div>

		<header class="main-header" style="background: #0c1a32;">
			<div class="d-flex align-items-center logo-box justify-content-start">
				<!-- Logo -->
				<a href="Dashboard" class="logo">
					<!-- logo-->
					<div class="logo-mini w-30">
						<!-- <span class="light-logo"><img src="./images/logo.png" alt="logo"></span> -->
						<span class="dark-logo"><img src="assets/preloader1.png" alt="logo"></span>
					</div>
					<div class="logo-lg">

						<span class="dark-logo"><img class="logoo" src="assets/preloader1.png" alt="logo" style="height:70px"></span>
					</div>
				</a>
			</div>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<div class="app-menu">
					<ul class="header-megamenu nav">
						<li class="btn-group nav-item">
							<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
								<i data-feather="align-left"></i>
							</a>
						</li>
					</ul>
				</div>

				<div class="navbar-custom-menu r-side">
					<ul class="nav navbar-nav">
						<li class="btn-group nav-item d-lg-inline-flex d-none">
							<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen btn-primary-light" title="Full Screen">
								<i data-feather="maximize"></i>
							</a>
						</li>
						<!-- Notifications -->
						<li class="dropdown notifications-menu">
							<a href="#" class="waves-effect waves-light dropdown-toggle btn-primary-light" data-bs-toggle="dropdown" title="Notifications">
								<i data-feather="bell"></i>
							</a>
							<ul class="dropdown-menu animated bounceIn">

								<li class="header">
									<div class="p-20">
										<div class="flexbox">
											<div>
												<h4 class="mb-0 mt-0">Notifications</h4>
											</div>
										</div>
									</div>
								</li>

								<li>
									<!-- inner menu: contains the actual data -->
								</li>
								<li class="footer">
									<a href="#">View all</a>
								</li>
							</ul>
						</li>

						<!-- User Account-->
						<li class="dropdown user user-menu">
							<a href="#" class="waves-effect waves-light dropdown-toggle btn-primary-light" data-bs-toggle="dropdown" title="User">
								<i data-feather="user"></i>
							</a>
							<ul class="dropdown-menu animated flipInX">
								<li class="user-body">
									<a class="dropdown-item" href="userProfileAuth.php"><i class="ti-user text-muted me-2"></i> Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="authSignDash"><i class="ti-lock text-muted me-2"></i> Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>