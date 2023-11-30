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
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<style>
		footer {
			width: 100%;
			bottom: 0;
			background: linear-gradient(to right, #0074cc, #00cc6a);
			display: flex;
			align-items: center;
			flex-direction: column;
			text-align: center;
			color: #fff;
			padding: 20px;
		}

		.list-footer {
			margin: 10px auto;
			display: flex;
			list-style-type: none;
		}

		.list-footer li a {
			text-decoration: none;
			color: #fff;
			font-size: 20px;
			font-weight: bold;
			padding: 10px;
		}

		.list-footer li a:hover {
			color: var(--mycolor);
		}

		.social-media {
			margin: 10px auto;
		}

		.social-media i {
			padding: 10px;
			font-size: 25px;
			color: #fff;
		}

		.social-media i:hover {
			color: rgb(2, 255, 171);
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
	<footer>
		<ul class="list-footer">
			<li><a href="user_home.php">Home</a></li>
			<li><a href="explore.php">Explore</a></li>
			<li><a href="about.php">About Us</a></li>
		</ul>
		<div class="social-media">
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-linkedin"></i></a>
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#"><i class="fab fa-youtube"></i></a>
		</div>
		<p class="copyrights">&copy; 2023 Boole</p>
	</footer>
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>