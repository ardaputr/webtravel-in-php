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
	<title>Boole - Explore, Discover, Enjoy!</title>
	<link rel="shortcut icon" href="image/icon.png">
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
						<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
							echo '
								<li class="nav-item">
									<a class="nav-link" href="explore.php" style="color: #FFFFFF;" id="hover">Explore</a>
								</li>';
						} else {
							echo '
								<li class="nav-item">
									<a class="nav-link" href="login.php" style="color: #FFFFFF;" id="hover">Explore</a>
								</li>';
						}
						?>

						<li class="nav-item">
							<a class="nav-link" href="about.php" style="color: #FFFFFF;" id="hover">About Us</a>
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

			<div class="intro">
				<h1 style="font-weight:800;">Your Doorway <br>To Endless Travel Wonders</h1>
				<p>Ready to redefine your travel experience? Boole is your guide <br>to extraordinary destinations. Click, discover, and wander!</p>
			</div>
		</section>

		<section class="ads-explore">
			<div class="container px-4">
				<div class="row gx-5 align-items-center">
					<div class="col">
						<div class="p-3" style="max-width:500px;">
							<h2 style="font-weight:600;">Explore all corners of <br> The World with us</h2> <br>
							<p>Let's embark on an unforgettable journey around the globe, discovering hidden beauties and experiencing the mesmerizing diversity of cultures together!</p>
						</div>
					</div>
					<div class="col">
						<img src="image/grp1.jpg" alt="explorepic" style="width: 100%; max-width: 100%; height: auto;"> <!-- Tambahkan gaya CSS untuk memastikan gambar berukuran responsif -->
					</div>
				</div>
			</div>
		</section>

		<section class="explore">
			<h1 style="font-weight:600;">Explore to Destination</h1>
			<div class="category">
				<ul class="nav justify-content-center">
					<li class="nav-item">
						<a class="nav-link" href="user_home.php?type=Beach" style="color: #000000;" id="hover">Beach</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="user_home.php?type=Culinary" style="color: #000000;" id="hover">Culinary</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="user_home.php?type=Culture" style="color: #000000;" id="hover">Culture</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="user_home.php?type=Nature" style="color: #000000;" id="hover">Nature</a>
					</li>
					<?php
					if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
						echo '<li class="nav-item">
						<a class="nav-link" href="explore.php" style="color: #000000;" id="hover">View All</a>
						</li>';
					} else {
						echo '<li class="nav-item">
						<a class="nav-link" href="login.php" style="color: #000000;" id="hover">View All</a>
						</li>';
					}
					?>

				</ul>
			</div>

			<section class="card-destination">
				<div class="container" style="margin-top: 10px;">
					<div class="row">
						<?php
						$categoryFilter = isset($_GET['type']) ? $_GET['type'] : 'All';

						$sql = "SELECT * FROM destination";
						if ($categoryFilter !== 'All') {
							$sql .= " WHERE category = '{$categoryFilter}'";
						}

						$sql .= " LIMIT 3";
						$query = mysqli_query($mysql_db, $sql);

						while ($row = mysqli_fetch_assoc($query)) {
						?>
							<div class="col-md-4">
								<div class="kartu" style="margin-top: 10px; margin-bottom: 10px;">
									<?php
									$categoryFolder = $row['category'];
									$imagePath = "image/{$categoryFolder}/" . $row['picture'];
									?>
									<a style="text-decoration: none; color: black;" href="detail2.php?destination_id=<?php echo $row['id']; ?>">
										<img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: 200px;">
										<div class="card-body">
											<h5 style="font-family: 'Montserrat', sans-serif; font-weight:600;"><?php echo $row['place']; ?></h5>
											<p class="card-text">
												<iconify-icon icon="carbon:location"></iconify-icon>
												<?php echo $row['address']; ?>
											</p>
										</div>
									</a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		</section>
		<section style="position: relative; height: 300px; overflow: hidden; border-radius:40px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; margin: 0px 60px 60px 60px; padding: auto;">
			<h2 style="color: black; font-family: 'Montserrat', sans-serif; font-weight:600;">
				Prepare Yourself & Let's Explore <br> The Beauty Of The World
			</h2> <br>
			<a href="explore.php" class="kartu" style=" background: linear-gradient(to right, #0074cc, #00cc6a); color: white; width: 200px; text-decoration: none; padding: 10px; border-radius: 50px;">Get Started</a>
		</section>

	</header>

	<footer>
		<!-- <ul class="list-footer">
			<li><a href="user_home.php">Home</a></li>
			<li><a href="explore.php">Explore</a></li>
			<li><a href="about.php">About Us</a></li>
		</ul> -->
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