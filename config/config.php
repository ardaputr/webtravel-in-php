<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boole_db";

$mysql_db = new mysqli($servername, $username, $password, $dbname);

if ($mysql_db->connect_error) {
    die("Connection failed: " . $mysql_db->connect_error);
}
?>