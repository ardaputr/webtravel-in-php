<?php
require_once 'config/config.php';
$username = $password = $confirm_password = "";

$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (empty(trim($_POST['username']))) {
		$username_err = "Please enter a username.";
	} else {
		$sql = 'SELECT id FROM users WHERE username = ?';

		if ($stmt = $mysql_db->prepare($sql)) {
			$param_username = trim($_POST['username']);
			$stmt->bind_param('s', $param_username);
			if ($stmt->execute()) {
				$stmt->store_result();
				if ($stmt->num_rows == 1) {
					$username_err = 'This username is already taken.';
				} else {
					$username = trim($_POST['username']);
				}
			} else {
				echo "Oops! ${$username}, something went wrong. Please try again later.";
			}
			$stmt->close();
		} else {
			$mysql_db->close();
		}
	}

	if (empty(trim($_POST["password"]))) {
		$password_err = "Please enter a password.";
	} elseif (strlen(trim($_POST["password"])) < 6) {
		$password_err = "Password must have atleast 6 characters.";
	} else {
		$password = trim($_POST["password"]);
	}

	if (empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err = "Please confirm password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if (empty($password_err) && ($password != $confirm_password)) {
			$confirm_password_err = "Password did not match.";
		}
	}

	if (empty($username_err) && empty($password_err) && empty($confirm_err)) {

		$sql = 'INSERT INTO users (username, password) VALUES (?,?)';

		if ($stmt = $mysql_db->prepare($sql)) {

			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT);

			$stmt->bind_param('ss', $param_username, $param_password);

			if ($stmt->execute()) {
				header('location: ./login.php');
				// echo "Will  redirect to login page";
			} else {
				echo "Something went wrong. Try signing in again.";
			}
			$stmt->close();
		}
		$mysql_db->close();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Sign in</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			background: seagreen;
			background: url(image/bg1.jpg) no-repeat;
			background-size: cover;
			background-position: center;
		}

		.wrapper {
			width: 420px;
			color: #ffff;
			padding: 30px 40px;
			border: 1px solid;
			border-radius: 20px;
			backdrop-filter: blur(2px);
		}

		.wrapper h2 {
			font-size: 36px;
			text-align: center;
		}

		.form-group {
			padding: 5px;
		}
	</style>

</head>

<body>
	<main>
		<section class="container wrapper">
			<h2 class="display-4 pt-3">Sign Up</h2>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<div class="form-group <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" placeholder="Create Username" value="<?php echo $username ?>">
					<span class="help-block"><?php echo $username_err; ?></span>
				</div>

				<div class="form-group <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Create Password" value="<?php echo $password ?>">
					<span class="help-block"><?php echo $password_err; ?></span>
				</div>

				<div class="form-group <?php (!empty($confirm_password_err)) ? 'has_error' : ''; ?>">
					<label for="confirm_password">Confirm Password</label>
					<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
					<span class="help-block"><?php echo $confirm_password_err; ?></span>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success" value="submit">Submit</button>
					<button type="reset" class="btn btn-warning" value="reset">Reset</button>
				</div>
				<p>Already have an account? <a href="login.php">Login here</a>.</p>
			</form>
		</section>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>