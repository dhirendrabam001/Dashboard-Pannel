<?php
include "config/connection.php";
include "flash.php";
include "auth/auth.php";
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM  setting_table LIMIT 1";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {
    $name = $_POST['setting_name'];
    $email = $_POST['setting_email'];
    $phone = $_POST['setting_phone'];
    $password = $_POST['setting_password'];

    // all field are required
    if (!$name || !$email || !$phone || !$password) {
        flash("error", "Please All Field Are Required");
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <title>Setting</title>
</head>

<body>

    <!-- NAVBAR INFO -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-main shadow">
        <div class="container">
            <img src="img/dashboardicon.png" alt="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1 me-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>
                </ul>
                <form class="d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['user_id'])) {
                        echo '<a href="logout.php" class="btn btn-outline-danger text-decoration-none text-white">Logout</a>';
                    } else {
                        echo '<a href="register.php" class="btn btn-outline-primary text-decoration-none text-white">Register</a>
                        <a href="login.php" class="text-white btn btn-outline-success text-decoration-none">Login</a>';
                    } ?>
                </form>
            </div>
        </div>
    </nav>

    <!-- NAVBAR END -->

    <!-- HOME PAGESS START -->
    <section class="dashboard-main">
        <div class="container-info">
            <div class="row">
                <div class="col-12 col-md-2 col-lg-2">
                    <div class="dashbaord-content">
                        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light sidebar-info gap-2 ">
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a href="dashboard.php" class="nav-link active" aria-current="page">
                                        <i class="fa-solid fa-gauge me-2"></i>
                                        dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="addnewitem.php" class="nav-link link-dark">
                                        <i class="fa-solid fa-plus me-2"></i>
                                        Add New
                                    </a>
                                </li>
                                <li>
                                    <a href="orders.php" class="nav-link link-dark">
                                        <i class="fa-solid fa-bag-shopping me-2"></i>
                                        Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="setting.php" class="nav-link link-dark">
                                        <i class="fa-solid fa-gear me-2"></i>
                                        Settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 col-lg-9">
                    <form method="POST">
                        <div class="dashbaord-content-left">
                            <h2 class="fw-bold fs-3 mb-3">Settings</h2>
                            <div class="divider"></div>
                            <h5 class="fw-bold fs-5 my-3">Profile Setting</h5>
                            <div class="card-info-item-setting shadow">
                                <div class="card-info-item-content">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="setting_name" value="<?php echo $user['setting_name']; ?>" class="form-control" placeholder="Enter Name...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="setting_email" value="<?php echo $user['setting_email'] ?>" class="form-control" placeholder="Enter Your Email Address...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                    <input type="text" name="setting_phone" value="<?php echo $user['setting_phone']; ?>" class="form-control" placeholder="Enter Phone Number...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-item-btn text-center">
                                        <button type="submit" name="submit" class="btn btn-primary w-100">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- change password -->
                    <div class="change-password-content mt-3">
                        <h5 class="fw-bold fs-5 my-3">Change Password</h5>
                        <div class="card-info-item-setting shadow">
                            <form action="" method="POST">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="item-content">
                                            <div class="mb-3">
                                                <label class="form-label">Current Password<span class="text-danger">*</span></label>
                                                <input type="text" name="currentpass" class="form-control" placeholder="Enter Current Password...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="item-content">
                                            <div class="mb-3">
                                                <label class="form-label">Change Password<span class="text-danger">*</span></label>
                                                <input type="text" name="cpassword" class="form-control" placeholder="Enter Your Change Password...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="item-content">
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="text" name="confirmpass" class="form-control" placeholder="Enter Confirm Password...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-item-btn text-center">
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- change password -->
                    <div class="change-password-content mt-3">
                        <h5 class="fw-bold fs-5 my-3">Notification Setting</h5>
                        <div class="card-info-item-setting shadow">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Email Notification</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Order Alerts</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">New User Alerts</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOME PAGES END -->





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>