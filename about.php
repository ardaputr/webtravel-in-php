<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	// header('location: login.php');
	// exit;
}
if (!isset($_GET['category'])) {
	$query = mysqli_query($mysql_db, "SELECT * FROM destination");
} else {
	$type = $_GET['category'];
	$query = mysqli_query($mysql_db, "SELECT * FROM  destination WHERE type = '$type'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/home.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
	<style>
		h1 {
			text-align: center;
			color: #ffffff;
		}

		.row {
			display: flex;
			flex-wrap: wrap;
			max-width: 1170px;
			margin: auto;
		}

		ul {
			list-style: none;
		}

		.footer {
			background-image: linear-gradient(#22577a, #38a3a5);
			padding: 70px 0;
			position: relative;
			bottom: 0;
			width: 100%;
		}

		.footer-col {
			width: 25%;
			padding: 0 15px;
		}

		.footer-col h4 {
			font-size: 18px;
			color: #ffffff;
			text-transform: capitalize;
			margin-bottom: 35px;
			font-weight: 500;
			position: relative;
		}


		.footer-col h4::before {
			content: "";
			position: absolute;
			left: 0;
			bottom: -10;
			background-color: #e91e63;
			height: 2px;
			box-sizing: border-box;
			width: 50px;
		}

		.footer-col ul li:not(:last-child) {
			margin-bottom: 10px;
		}

		.footer-col ul li a {
			font-size: 16px;
			text-transform: capitalize;
			color: #ffffff;
			text-decoration: none;
			font-weight: 300;
			color: #ffffff;
			display: block;
			transition: all 0.3s ease;
		}

		.footer-col ul li a:hover {
			color: #020202;
			padding-left: 8px;
		}

		.footer-col .social-links a {
			display: inline-block;
			height: 40px;
			width: 40px;
			background-color: rgba(255, 255, 255, 0.2);
			margin: 0 10px 10px 0;
			text-align: center;
			line-height: 40px;
			border-radius: 50%;
			color: #ffffff;
			transition: all 0.5s ease;
		}

		.footer-col .social-links a:hover {
			color: #24262b;
			background-color: #ffffff;
		}
	</style>
</head>

<body>
	<header class="header" id="header">
		<section>
			<nav style="border-bottom:2px #e4e4e4 solid;">
				<div>
					<ul class="nav justify-content-center navbar">
						<a class="navbar-brand me-auto" style="font-weight:600; color: #0174BE; font-size:30px;">Boole</a>
						<li class="nav-item">
							<a class="nav-link" href="user_home.php" style="color: #0174BE;" id="hover">Home</a>
						</li>
						<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
							echo '
								<li class="nav-item">
									<a class="nav-link" href="explore.php" style="color: #0174BE;" id="hover">Explore</a>
								</li>';
						} else {
							echo '
								<li class="nav-item">
									<a class="nav-link" href="login.php" style="color: #0174BE;" id="hover">Explore</a>
								</li>';
						}
						?>

						<li class="nav-item">
							<a class="nav-link" href="#" style="color: #0174BE;" id="hover">About Us</a>
						</li>

						<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
							<span>
								<iconify-icon icon="iconamoon:profile-circle-fill" style="color: #0174BE;" width="40" height="40"></iconify-icon>
							</span>
						</button>
						<div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
							<div class="offcanvas-header">

								<?php
								if (isset($_SESSION['username'])) {
									echo '<h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Hai, ' . $_SESSION['username'] . '</h5>';
								} else {
									echo '<h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Please login</h5>';
								}
								?>

								<button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">
								<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
									<li class="nav-item">
										<a class="nav-link active" aria-current="page" href="user_home.php">Home</a>
									</li>
									<?php
									if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
										echo '
											<li>
												<a class="nav-link" href="explore.php">Explore</a>
											</li>
											<li>
												<a class="nav-link" href="password_reset.php">Reset Password</a>
											</li>
											<li style="text-align: center;">
												<a class="nav-link" href="logout.php">Sign Out</a>
											</li>
										';
									} else {
										echo '
											<li style="text-align: center;">
												<a class="nav-link" href="login.php">Login</a>
											</li>
										';
									}
									?>
								</ul>
							</div>
						</div>
				</div>
			</nav>
		</section>

		<section class="member">
			<center>
				<h2 style="color: #0174BE; font-family: 'Montserrat', sans-serif; font-weight:600; padding-top:50px;">About</h2>
			</center>
			<p style="color: #0174BE; font-family: 'Montserrat', sans-serif; font-weight:400; padding-top:20px; padding-left: 300px; padding-right: 300px;">Informatics students with a passion for programming, actively seeking new challenges to conquer. Ambitious individuals dedicated to mastering the world of coding and making a significant impact. Let's connect and explore the limitless possibilities of the digital realm together!</p>

			<center>
				<h2 style="color: #0174BE; font-family: 'Montserrat', sans-serif; font-weight:600; padding-top:50px;">Member</h2>
				<div class="container" style="padding-top:50px; padding-bottom:50px;">
					<div class="row">
						<div class="col">
							<div class="card" style="width: 18rem;">
								<img src="image/Member/Arda.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title">Waramatja Yuda Putra</h5>
									<p class="card-text">1232200163</p>
									<a href="#" class="btn" style="background-color:#E1306C; color: #ffffff">Instagram</a>
									<a href="https://www.linkedin.com/in/waramatja-yuda-putra?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" class="btn btn-primary">LinkedIn</a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="card" style="width: 18rem;">
								<img src="image/Member/Satria.jpeg" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title">Othman Satria Nirwasita</h5>
									<p class="card-text">1232200157</p>
									<a href="https://instagram.com/satriaa.man?igshid=OGQ5ZDc2ODk2ZA==" class="btn" style="background-color:#E1306C; color: #ffffff">Instagram</a>
									<a href="#" class="btn btn-primary">LinkedIn</a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="card" style="width: 18rem;">
								<img src="image/Member/Nolan.jpeg" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title">Nolan Tabina</h5>
									<p class="card-text">123220049</p>
									<a href="https://instagram.com/yeilahlan?igshid=OGQ5ZDc2ODk2ZA==" class="btn" style="background-color:#E1306C; color: #ffffff">Instagram</a>
									<a href="https://www.linkedin.com/in/nolan-tabina-aa598b249?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="btn btn-primary">LinkedIn</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</center>
		</section>
	</header>
	<div class="footer">
		<div class="row">
			<div class="footer-col">
				<h4>Boole</h4>
				<div class="social-links">
					<!-- <a href="#"><i class="fab fa-facebook"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a> -->
				</div>
			</div>
			<div class="footer-col">
				<h4>Home</h4>
				<ul>
					<li><a href="explore.php">Explore</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Explore</h4>
				<ul>
					<li>
						<a class="nav-link" href="explore.php?type=Beach" style="color: #ffffff;" id="hover">Beach</a>
					</li>
					<li>
						<a class="nav-link" href="explore.php?type=Culinary" style="color: #ffffff;" id="hover">Culinary</a>
					</li>
					<li>
						<a class="nav-link" href="explore.php?type=Culture" style="color: #ffffff;" id="hover">Culture</a>
					</li>
					<li>
						<a class="nav-link" href="explore.php?type=Nature" style="color: #ffffff;" id="hover">Nature</a>
					</li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>About Us</h4>
				<ul>
					<li><a href="#">rrrr</a></li>
				</ul>
			</div>
		</div>
	</div>
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>