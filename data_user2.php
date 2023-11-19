<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boole_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $delete_sql = "DELETE FROM users WHERE id='$id'";
    $conn->query($delete_sql);
}

$sql = "SELECT id, username, password, role, created_at FROM users WHERE role='user'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar di Pinggir Kiri</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

</head>
<body>

<div class="navbar">
  <a href="data_admin2.php">Admin Data</a>
  <a href="data_user.php" class="active">User Data</a>
  <a href="#">Destination List</a>
  <a href="#">Add Destination</a>
</div>

<div class="content">
    <section class="container">
        <title>User Data</title>
        <?php
        if ($result->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>Username</th><th>Password</th><th>User Type</th><th>Sign Up Date</th><th>Action</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['password'] . '</td>';
                echo '<td>' . $row['role'] . '</td>';
                echo '<td>' . $row['created_at'] . '</td>';
                echo '<td><form method="post"><input type="hidden" name="id" value="' . $row['id'] . '"><button type="submit" class="btn btn-danger">Delete</button></form></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "No records found";
        }
        $conn->close();
        ?>
    </section>
</div>

</body>
</html>
