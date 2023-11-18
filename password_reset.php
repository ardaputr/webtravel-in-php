<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

require_once 'config/config.php';
$new_password = $confirm_password = '';
$new_password_err = $confirm_password_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty(trim($_POST['new_password']))) {
        $new_password_err = 'Please enter the new password.';
    } elseif (strlen(trim($_POST['new_password'])) < 6) {
        $new_password_err = 'Password must have at least 6 characters.';
    } else {
        $new_password = trim($_POST['new_password']);
    }

    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = 'Please confirm the password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = 'Password did not match.';
        }
    }

    if (empty($new_password_err) && empty($confirm_password_err)) {
        $sql = 'UPDATE users SET password = ? WHERE id = ?';

        if ($stmt = $mysql_db->prepare($sql)) {
            $param_password = $new_password;
            $param_id = $_SESSION["id"];

            $stmt->bind_param("si", $param_password, $param_id);

            if ($stmt->execute()) {
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Reset Password</title>
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
    <main class="container wrapper">
        <section>
            <h2>Reset Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Input New Password" value="<?php echo $new_password; ?>">
                    <span class="help-block"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                    <a class="btn btn-primary" href="home.php" role="button" style="background-color: red; color: white; border:none">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>