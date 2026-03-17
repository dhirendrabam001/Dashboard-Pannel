<?php
session_start();
include "config/connection.php";
include "flash.php";

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // check the token
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        flash("error", "Invalid Token");
        exit();
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // CHECK THE FIRST ALL FIELD ARE REQUIRED OR NOT
    if (!$username || !$email || !$password || !$cpassword) {
        flash("error", "Please All Field Are Required");
        exit();
    }

    // CHECK THE PASSWORD AND CONFIRM PASSWORD
    if ($password !== $cpassword) {
        flash("error", "Password Does Not Matched");
        exit();
    }

    // CHECK EMAIL ALREADY EXIT OR NOT
    $checkEmail = "SELECT * FROM register_table WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmail);
    if (mysqli_num_rows($result) > 0) {
        flash("error", "Email Already Exits!");
        exit();
    }

    // HASHPASSWORD
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // SAVE INTO DATABASE MYSQLI
    $sql = "INSERT INTO register_table(username, email, password) VALUES ('$username', '$email', '$hashPassword')";
    if (mysqli_query($conn, $sql)) {
        // unset token when register successfully
        unset($_SESSION['token']);
        flash("success", "User Register Successfully");
    } else {
        flash("error", "Register Failed");
        header("Location: login.php");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <title>Register</title>
</head>

<body>
    <section class="form-section">
        <div class="container-info">
            <div class="row align-items-center g-5">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="facebook-bg">
                        <div class="facebook-icon">
                            <img
                                width="70"
                                height="70"
                                src="https://img.icons8.com/color/48/facebook-new.png"
                                alt="facebook-new" />
                        </div>
                        <div class="facebook-content">
                            <h1>
                                Explore<br />
                                the things <br /><span class="text-primary">you love.</span>
                            </h1>
                        </div>
                        <div class="bg-main">
                            <img src="img/bg-img.png" class="img-fluid" alt="background" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 position-relative">
                    <div class="divide"></div>
                    <div class="form-user">
                        <h2>Register into Facebook</h2>
                        <form method="post" action="#">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <div class="mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="username"
                                    placeholder="Username" />

                            </div>
                            <div class="mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="Email address or phone number"
                                    aria-describedby="emailHelp" />
                            </div>
                            <div class="mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="form-control" />
                            </div>
                            <div class="mb-3">
                                <input
                                    type="password"
                                    name="cpassword"
                                    placeholder="Enter Your Confirm Password"
                                    class="form-control" />
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Register
                            </button>
                            <div class="forget-pass text-center py-4">
                                <a href="login.php" class="text-decoration-none">Already Have An Account?</a>
                            </div>
                            <div class="meta-info text-center">
                                <img src="img/meta-logo-12362.svg" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>