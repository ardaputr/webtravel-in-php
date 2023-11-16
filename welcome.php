<?php
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: login.php');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h2 class="display-5">Welcome home <?php echo $_SESSION['username']; ?></h2>
			</div>

			<a href="password_reset.php" class="btn btn-block btn-outline-warning">Reset Password</a>
			<a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
		</section>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>