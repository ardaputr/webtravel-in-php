<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    header('location: login.php');
    exit;
}

// Include your database connection file here
// Example: include 'db_connection.php';

// Assuming you have a $mysql_db connection established

// Retrieve destination_id from the query parameters
$destination_id = isset($_GET['destination_id']) ? $_GET['destination_id'] : '';

// Validate and sanitize the input if needed

// Fetch destination details from the database based on the destination_id
$sql = "SELECT * FROM destination WHERE id = '{$destination_id}'";
$query = mysqli_query($mysql_db, $sql);
$destination = mysqli_fetch_assoc($query);

// Check if the destination exists
if (!$destination) {
    // Redirect to an error page or handle accordingly
    header('Location: error.php');
    exit();
}

// Display destination details
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Details</title>
    <!-- Add your CSS styling if needed -->
</head>

<body>
    <h1><?php echo $destination['place']; ?></h1>
    <img src="image/<?php echo $destination['category']; ?>/<?php echo $destination['picture']; ?>" alt="Destination Image" style="width: 100%; height: auto;">
    <p><strong>Address:</strong> <?php echo $destination['address']; ?></p>
    <p><strong>Description:</strong> <?php echo $destination['description']; ?></p>
    <!-- Add more details as needed -->

    <!-- Add a link back to the home page or wherever you want -->
    <a href="index.php">Back to Home</a>

    <!-- Add your JavaScript or other functionality if needed -->
</body>

</html>