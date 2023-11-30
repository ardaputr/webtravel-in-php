<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	header('location: login.php');
	exit;
}
$destination_id = isset($_GET['destination_id']) ? $_GET['destination_id'] : '';

$sql = "SELECT * FROM destination WHERE id = '{$destination_id}'";
$query = mysqli_query($mysql_db, $sql);
$destination = mysqli_fetch_assoc($query);

if (!$destination) {
	header('Location: error.php');
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Boole - <?php echo $destination['place']; ?></title>
    <link rel="shortcut icon" href="image/icon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>
	<nav style="padding-bottom:20px;">
		<div>
			<ul class="nav justify-content-center navbar" style="padding-top: 20px; font-family: 'Montserrat', sans-serif; padding-right: 60px; padding-left: 60px;">
				<a class="navbar-brand me-auto" style="font-weight:600; color: #0174BE; font-size:30px;" href="user_home.php">Boole</a>
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
					<a class="nav-link" href="about.php" style="color: #0174BE;" id="hover">About Us</a>
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
			</ul>
		</div>
	</nav>
	<section style="position: relative; height: 595px; overflow: hidden; border-radius:40px; display: flex; flex-direction: column; justify-content: center; text-align: center; margin: 0px 60px 0px 60px;">
		<img src="image/<?php echo $destination['category']; ?>/<?php echo $destination['picture']; ?>" alt="Destination Image" class="img-fluid" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -1;">
		<div class="title">
			<h1 style="color: white; font-family: 'Montserrat', sans-serif; font-weight:600;">
				<?php echo $destination['place']; ?>
			</h1>
			<p style="color: white; font-family: 'Montserrat', sans-serif; font-weight:400;"><iconify-icon icon="carbon:location"></iconify-icon><?php echo $destination['address']; ?></p>
		</div>
	</section>
	<section class="desc">
		<div style="padding: 40px 60px 20px 60px">
			<h2 style="font-family: 'Montserrat', sans-serif; font-weight:600;">
				Description
			</h2>
			<p style="font-family: 'Montserrat', sans-serif; font-weight:400;  text-align: justify;">
				<?php echo $destination['description']; ?>
			</p>
			<div class="d-grid gap-2">
				<a href="<?php echo $destination['link_maps']; ?>" class="btn btn-primary" type="button">Open Map</a>
			</div>
		</div>
	</section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>