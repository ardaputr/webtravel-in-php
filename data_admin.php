<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boole_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, password, role, created_at FROM users WHERE role='admin'";
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
        <a href="data_admin.php" class="active">Admin Data</a>
        <a href="data_user.php">User Data</a>
        <a href="#">Destination List</a>
        <a href="#">Add Destination</a>
        <a href="logout.php">Sign Out</a>
    </div>

    <div class="content">
        <section class="container">
            <title>User Data</title>
            <?php
            if ($result->num_rows > 0) {
                echo '<table border="1">';
                echo '<tr><th>Username</th><th>Password</th><th>User Type</th><th>Sign Up Date</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td>' . $row['created_at'] . '</td>';
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