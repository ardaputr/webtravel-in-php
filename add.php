<?php
session_start();
include('config/config.php');

$sql = "SELECT username, password, id, created_at FROM users WHERE role='admin'";
$result = $mysql_db->query($sql);

if (isset($_POST['add'])) {
    $place = mysqli_real_escape_string($mysql_db, $_POST['place']);
    $category = mysqli_real_escape_string($mysql_db, $_POST['category']);
    $description = mysqli_real_escape_string($mysql_db, $_POST['description']);
    $address = mysqli_real_escape_string($mysql_db, $_POST['address']);
    $link_maps = mysqli_real_escape_string($mysql_db, $_POST['link_maps']);

    $query = "INSERT INTO destination (place, category, description, address, link_maps) VALUES ('$place', '$category', '$description', '$address', '$link_maps')";
    $result = mysqli_query($mysql_db, $query);

    if ($result) {
        $id = mysqli_insert_id($mysql_db);

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $uploadDirectory = 'image/' . strtolower($category) . '/';
            $imageName = uniqid($category . '_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileDestination = $uploadDirectory . $imageName;

            if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true)) {
                die("Error creating directory: $uploadDirectory");
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $fileDestination)) {
                $query = "UPDATE destination SET picture = '$imageName' WHERE id = $id";
                $result = mysqli_query($mysql_db, $query);

                if ($result) {
                    header("Location: edit.php?message=$place has been added successfully");
                } else {
                    header("Location: edit.php?message=Error updating database");
                }
            } else {
                header("Location: edit.php?message=Error uploading image");
            }
        } else {
            header("Location: edit.php?message=$place has been added successfully");
        }
    } else {
        header("Location: edit.php?message=Failed to add destination");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boole Admin - Add Destination</title>
    <link rel="shortcut icon" href="image/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            padding-top: 20px;
            padding-right: 60px;
            padding-left: 60px;
        }

        .navbar-toggler {
            border: none;
        }

        .data {
            margin: 100px 100px 100px 100px;
            padding: 20px;
            border: 1px #e4e4e4 solid;
            border-radius: 15px;
        }
    </style>
</head>

<body>

    <nav style="border-bottom:2px #e4e4e4 solid;">
        <div>
            <ul class="nav justify-content-center navbar">
                <a class="navbar-brand me-auto" style="font-weight:600; color: #0174BE; font-size:30px;">Boole</a>
                <li class="nav-item">
                    <a class="nav-link" href="admin_home.php" style="color: #0174BE;" id="hover">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0174BE;" id="hover">Data</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="data_admin.php">Admin Data</a></li>
                        <li><a class="dropdown-item" href="data_user.php">User Data</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0174BE;" id="hover">Destination</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="edit.php">Edit Destination</a></li>
                        <li><a class="dropdown-item" href="add.php">Add Destination</a></li>
                    </ul>
                </li>

                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
                    <span>
                        <iconify-icon icon="iconamoon:profile-circle-fill" style="color: #0174BE;" width="40" height="40"></iconify-icon>
                    </span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
                    <div class="offcanvas-header">

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Hai, ' . $_SESSION['username'] . '</h5>';
                        } else {
                            echo '<h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Please login</h5>';
                        }
                        ?>

                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                            </li>
                            <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                echo '
                                            <li>
                                                <a class="nav-link" href="user_home.php">Go to website</a>
                                            </li>
											<li>
												<a class="nav-link" href="password_reset.php">Reset Password</a>
											</li>
											<li style="text-align: center;">
												<a class="nav-link" href="logout.php">Sign Out</a>
											</li>
										';
                            } else {
                                echo '
											<li style="text-align: center;">
												<a class="nav-link" href="login.php">Login</a>
											</li>
										';
                            }
                            ?>

                        </ul>
                    </div>
                </div>
        </div>
    </nav>

    <center>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <h1 style="padding-top: 10px;">Add Destination</h1>
            <div class="container">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label class="mt-3">Place Name</label>
                        <input type="text" class="form-control" id="place" name="place" placeholder="Enter Place Name" required>
                        <label class="mt-3">Category</label>
                        <select class="form-select border-dark" aria-label="default select example" name="category" required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="Beach">Beach</option>
                            <option value="Culinary">Culinary</option>
                            <option value="Culture">Culture</option>
                            <option value="Nature">Nature</option>
                        </select>
                        <label class="mt-3">Description</label>
                        <textarea class="form-control border-dark" rows="3" value="descripton" placeholder="Enter Description" aria-label="default input example" name="description" id="description"></textarea>
                        <label class="mt-3">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                        <label for="Image" class="form-label" style="margin-top: 20px;">Image (Optional)</label>
                        <input type="file" class="form-control" id="Image" name="image" accept="image/*">
                        <label class="mt-3">Link Maps</label>
                        <input type="text" class="form-control" id="link_maps" name="link_maps" placeholder="Enter link Maps" required><br><br>
                        <!-- <input type="hidden" name="id" value="<?= $row['id']; ?>"> -->
                        <div class="mb-3 mt-1 w-100">
                            <input type="submit" name="add" class="btn btn-primary w-100">
                        </div>
                        <div class="mb-3 mt-1 w-100">
                            <a href="edit.php" class="btn btn-secondary w-100">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            </div>
        </form>
    </center>
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">© 2023 Boole Dashboard</span>
        </div>
    </footer>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>