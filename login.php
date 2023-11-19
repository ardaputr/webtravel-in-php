<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  if ($_SESSION['role'] === 'admin') {
    header("location: admin_home.php");
  } elseif ($_SESSION['role'] === 'user') {
    header("location: user_home.php");
  }
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
    $sql = 'SELECT id, username, password, role FROM users WHERE username = ?';
    if ($stmt = $mysql_db->prepare($sql)) {
      $param_username = $username;
      $stmt->bind_param('s', $param_username);
      if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
          $stmt->bind_result($id, $username, $stored_password, $role);
          if ($stmt->fetch()) {
            if ($password == $stored_password) {
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $username;
              $_SESSION['role'] = $role;

              if ($role === 'admin') {
                header('location: admin_home.php');
              } elseif ($role === 'user') {
                header('location: user_home.php');
              }
              exit;
            } else {
              $password_err = 'Invalid password';
            }
          }
        } else {
          $username_err = "Username does not exist.";
        }
      } else {
        echo "Oops! Something went wrong, please try again.";
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
      backdrop-filter: blur(5px);
    }

    .wrapper h2 {
      font-size: 36px;
      text-align: center;
    }

    label {
      margin-right: 5px;
    }

    .form-group {
      padding: 5px;
    }

    .show-password {
      cursor: pointer;
      position: absolute;
      right: 20px;
      top: 59%;
      transform: translateY(-50%);
    }
  </style>

</head>

<body>
  <main>
    <section class="wrapper">
      <h2>Login</h2>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Username</label>
          <i class='bx bxs-user'></i>
          <input type="text" name="username" id="username" class="form-control" placeholder="Input Username">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Password</label>
          <i class='bx bxs-key'></i>
          <input type="password" name="password" id="password" class="form-control" placeholder="Input Password">
          <i class="bx bx-hide show-password" onclick="togglePasswordVisibility('password')"></i>
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary" value="login">Login</button>
        </div>
        <p>Don't have an account? <a href="register.php" style="color:#0174BE; text-decoration:none; font-weight:bold;">Sign up</a>.</p>
      </form>
    </section>
  </main>

  <script>
    function togglePasswordVisibility(inputId) {
      var passwordInput = document.getElementById(inputId);
      var icon = document.querySelector('.show-password');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bx-hide');
        icon.classList.add('bx-show');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bx-show');
        icon.classList.add('bx-hide');
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>