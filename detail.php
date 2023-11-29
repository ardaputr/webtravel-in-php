<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    header('location: login.php');
    exit;
}
$destination_id = isset($_GET['destination_id']) ? $_GET['destination_id'] : '';

$sql = "SELECT * FROM destination WHERE id = '{$destination_id}'";
$query = mysqli_query($mysql_db, $sql);
$destination = mysqli_fetch_assoc($query);

if (!$destination) {
    header('Location: error.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header class="header" id="header">
        <section style="position: relative; height: 595px; overflow: hidden;">
            <img src="image/<?php echo $destination['category']; ?>/<?php echo $destination['picture']; ?>" alt="Destination Image" class="card-img-top" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -1;">
            <nav>
                <div>
                    <ul class="nav justify-content-center navbar" style="padding-top: 20px; font-family: 'Montserrat', sans-serif; padding-right: 60px; padding-left: 60px;">
                        <a class="navbar-brand me-auto" style="font-weight:600; color: #ffffff; font-size:30px;">Boole</a>
                        <li class="nav-item">
                            <a class="nav-link" href="user_home.php" style="color: #FFFFFF;" id="hover">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="explore.php" style="color: #FFFFFF;" id="hover">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: #FFFFFF;" id="hover">About Us</a>
                        </li>

                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
                            <span>
                                <iconify-icon icon="iconamoon:profile-circle-fill" style="color: white;" width="40" height="40"></iconify-icon>
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
												<a class="nav-link" href="#">Wishlist</a>
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
            <section class="desc">
                <div class="row g-0">
                    <div class="col-6 col-md-8" style="padding-left: 50px; padding-top: 25px">
                        <div class="container mt-0" style="backdrop-filter: blur(3px); color: wheat; background-color: white; 
                    color: black; background: rgb(189, 189, 0); background: rgba(189, 189, 189, 0.5); padding: 10px 20px; border: 1px solid; border-radius: 20px;">
                            <center>
                                <h1 style="color: white; padding-bottom: 10px;">
                                    <?php echo $destination['place']; ?>
                                </h1>
                            </center>
                            <div>
                                <p><strong style="color: white;">Address:
                                    </strong>
                                    <?php echo $destination['address']; ?>
                                </p>
                                <p><strong style="color: white;">Description:
                                    </strong>
                                    <?php echo $destination['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4" style="padding-left: 20px; padding-right: 50px; padding-top: 25px">
                        <div class="container mt-0" style="backdrop-filter: blur(3px); color: wheat; background-color: white; 
                    color: black; background: rgb(189, 189, 0); background: rgba(189, 189, 189, 0.5); padding: 10px 20px; border: 1px solid; border-radius: 20px;">
                            <img style="width: 100%; height: 50%; margin-bottom: 10px; margin-top: 10px; border-radius: 15px;" src="image/<?php echo $destination['category']; ?>/<?php echo $destination['picture']; ?>">
                            <a href="<?php echo $destination['link_maps']; ?>" style="margin-top: 10px; margin-bottom: 10px;" class="btn btn-primary" target="_blank">View on Maps</a>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </section>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eUqfzAlFQr1u1KZZ2fKWEeDjR5Fa1l9ajRvABoIXiSAB7DQp6OAp3bI5pG5KkrD" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>