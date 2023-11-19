<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	// header('location: login.php');
	// exit;
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
</head>

<body>
	<header class="header" id="header">
		<section style="position: relative; height: 550px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; overflow: hidden;">
			<video autoplay loop muted style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -1;">
				<source src="video/vidbg.mp4" type="video/mp4">
			</video>
			<nav>
				<div>
					<ul class="nav justify-content-center navbar">
						<a class="navbar-brand me-auto" style="font-weight:600; color: #ffffff; font-size:30px;">Boole</a>
						<li class="nav-item">
							<a class="nav-link" href="user_home.php" style="color: #FFFFFF;" id="hover">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" style="color: #FFFFFF;" id="hover">category</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" style="color: #FFFFFF;" id="hover">Blog</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" style="color: #FFFFFF;" id="hover">Abous Us</a>
						</li>

						<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
							<span>
								<iconify-icon icon="iconamoon:profile-circle-fill" style="color: white;" width="40" height="40"></iconify-icon>
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
										<a class="nav-link active" aria-current="page" href="home.php">Home</a>
									</li>
									<?php
									if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
										// Jika udah login maka nampil reset sama sign out
										echo '
											<li>
												<a class="nav-link" href="#">Wishlist</a>
											</li>
											<li>
												<a class="nav-link" href="password_reset.php">Reset Password</a>
											</li>
											<li style="text-align: center;">
												<a class="nav-link" href="logout.php">Sign Out</a>
											</li>
										';
									} else {
										// Jika belum login cuman tampil login ajahhh
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

			<div class="intro">
				<h1 style="font-weight:800;">Your Doorway <br>To Endless Travel Wonders</h1>
				<p>Ready to redefine your travel experience? Boole is your guide <br>to extraordinary destinations. Click, discover, and wander!</p>
			</div>
		</section>

		<section class="explore">
			<h1 style="font-weight:600;">Explore to Destination</h1>
			<div class="container text-center" style="padding-top:20px;">
				<div class="row align-items-start">
					<div class="col">
						<div class="card" style="width: 18rem;">
							<img src="..." class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Card title</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card" style="width: 18rem;">
							<img src="..." class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Card title</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card" style="width: 18rem;">
							<img src="..." class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Card title</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ads-explore">
			<h2>Explore all corners of</h2>
			<h2>The world with us</h2>
			<br>
			<p>Travel is fatal to prejudice, and narrow mindedness,Travel is fatal to prejudice, and narrow mindedness</p>
		</section>
	</header>
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>