<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	// header('location: login.php');
	// exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- <link rel="stylesheet" href="css/dashboard.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body{
      font-family: 'Montserrat', sans-serif;
    }

    .navbar{
      padding-top: 20px;
      padding-right: 60px;
      padding-left: 60px;
    }

    .navbar-toggler{
        border: none;
    }

    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        text-align: center;
    }
  </style>
</head>

<body>
<nav style="border-bottom:2px #e4e4e4 solid;">
				<div>
					<ul class="nav justify-content-center navbar">
						<a class="navbar-brand me-auto" style="font-weight:600; color: #0174BE; font-size:30px;">Boole</a>
						<li class="nav-item">
							<a class="nav-link" href="#" style="color: #0174BE;" id="hover">Home</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0174BE;" id="hover">Data</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="data_admin.php">Admin Data</a></li>
                  <li><a class="dropdown-item" href="data_user.php">User Data</a></li>
                </ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0174BE;" id="hover">Destination</a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Edit Destination</a></li>
                  <li><a class="dropdown-item" href="#">Add Destination</a></li>
                </ul>
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


  <div class="content">
  <?php
								if (isset($_SESSION['username'])) {
									echo '<h1 class="offcanvas-title" id="offcanvasLightNavbarLabel">Hai, ' . $_SESSION['username'] . '</h1>';
                  echo '<p>Sorry ya aku mabok, this is Cogil ;D </p>';
								} else {
									echo '<h1 class="offcanvas-title" id="offcanvasLightNavbarLabel">Please login</h1>';
								}
								?>
  </div>

  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>