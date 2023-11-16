<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}

require_once "config/config.php";

$username = $password = '';
$username_err = $password_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty(trim($_POST['username']))) {
    $username_err = 'Please enter username.';
  } else {
    $username = trim($_POST['username']);
  }

  if (empty(trim($_POST['password']))) {
    $password_err = 'Please enter your password.';
  } else {
    $password = trim($_POST['password']);
  }

  if (empty($username_err) && empty($password_err)) {
    $sql = 'SELECT id, username, password FROM users WHERE username = ?';
    if ($stmt = $mysql_db->prepare($sql)) {
      $param_username = $username;
      $stmt->bind_param('s', $param_username);
      if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
          $stmt->bind_result($id, $username, $hashed_password);
          if ($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $username;
              header('location: welcome.php');
            } else {
              $password_err = 'Invalid password';
            }
          }
        } else {
          $username_err = "Username does not exists.";
        }
      } else {
        echo "Oops! Something went wrong please try again";
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
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <main>
    <section class="container wrapper">
      <h2 class="display-4 pt-3">Login</h2>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-block btn-outline-primary" value="login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign in</a>.</p>
      </form>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>