<?php
include "config/connection.php";
include "flash.php";
include "auth/auth.php";
$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM   register_table  WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);
if (!$user) {
    echo "user not found";
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    // all field are required
    if (!$username || !$fullname || !$email) {
        flash("error", "Please All Field Are Required");
        exit();
    }

    // updated query 
    $update_query = "UPDATE register_table SET username = '$username', fullname = '$fullname', email = '$email' WHERE id = '$user_id'";
    $update_result = mysqli_query($conn, $update_query);
    if ($update_result) {
        flash("success", "Profile Updated Successfully");
        exit();
    }
}

// change password
if (isset($_POST['change_password'])) {
    $currentpass = $_POST['currentpass'];
    $newpass = $_POST['cpassword'];
    $confirmpass = $_POST['confirmpass'];

    // all field are required
    if (!$currentpass || !$newpass || !$confirmpass) {
        flash("error", "Please All Filed Are Required");
        exit();
    }

    // check the password
    if ($newpass !== $confirmpass) {
        flash("error", "Password Does Not Matched");
        exit();
    }

    //  get password from user
    $sql = "SELECT password FROM register_table WHERE id = '$user_id'";
    $get_result = mysqli_query($conn, $sql);
    $get_row = mysqli_fetch_assoc($get_result);

    // password verify from register user
    if (!password_verify($currentpass, $get_row['password'])) {
        flash("error", "Current Password Does Not Matched");
        exit();
    }

    // hashpassword
    $hashPass = password_hash($newpass, PASSWORD_DEFAULT);

    // now updated password 
    $update = "UPDATE register_table SET password = '$hashPass' WHERE id = '$user_id'";
    $update_result = mysqli_query($conn, $update);
    if ($update_result) {
        flash("success", "Password Updated Successfully");
    } else {
        flash("error", "Password Does Not Updated");
    }
    exit();
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
                <div class="col-12 col-md-4 col-lg-2">
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
                <div class="col-12 col-md-8 col-lg-9">
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
                                                <?php
                                                if (isset($user)) { ?>
                                                    <div class="mb-3">
                                                        <label class="form-label">Username <span class="text-danger">*</span></label>
                                                        <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control" placeholder="Enter Your Username...">
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" class="form-control" placeholder="Enter Name...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" value="<?php echo $user['email'] ?>" class="form-control" placeholder="Enter Your Email Address...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php  }
                                ?>

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
                            <form method="POST">
                                <div class="row align-items-center">
                                    <?php
                                    if (isset($user)) { ?>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Current Password<span class="text-danger">*</span></label>
                                                    <input type="password" name="currentpass" class="form-control" placeholder="Enter Current Password...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Change Password<span class="text-danger">*</span></label>
                                                    <input type="password" name="cpassword" class="form-control" placeholder="Enter Your Change Password...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="item-content">
                                                <div class="mb-3">
                                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" name="confirmpass" class="form-control" placeholder="Enter Confirm Password...">
                                                </div>
                                            </div>
                                        </div>
                                    <?php   }

                                    ?>


                                </div>
                                <div class="add-item-btn text-center">
                                    <button type="submit" name="change_password" class="btn btn-primary w-100">Update Profile</button>
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