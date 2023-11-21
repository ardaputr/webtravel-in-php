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
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

  <div class="navbar">
      <a href="admin_home.php">
        <span class="nav-text">Dashboard</span>
      </a>
      <a href="data_admin.php">
        <iconify-icon icon="ri:admin-line" style="color: white;"></iconify-icon>
        <span class="nav-text">Admin Data</span>
      </a>
      <a href="data_user.php">
          <iconify-icon icon="ri:user-line" style="color: white;"></iconify-icon>
          <span class="nav-text">User Data</span>
      </a>
      <a href="#">
          <iconify-icon icon="carbon:location" style="color: white;"></iconify-icon>
          <span class="nav-text">Destination List</span>
      </a>
      <a href="#">
          <iconify-icon icon="gg:add" style="color: white;"></iconify-icon>
          <span class="nav-text">Add Destination</span>
      </a>
      <a href="logout.php">
          <iconify-icon icon="tabler:logout" style="color: white;"></iconify-icon>
          <span class="nav-text">Sign Out</span>
      </a>
  </div>


  <div class="content">
  <?php
								if (isset($_SESSION['username'])) {
									echo '<h1 class="offcanvas-title" id="offcanvasLightNavbarLabel">Hai, ' . $_SESSION['username'] . '</h1>';
								} else {
									echo '<h1 class="offcanvas-title" id="offcanvasLightNavbarLabel">Please login</h1>';
								}
								?>
  </div>

  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>