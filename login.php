<?php
session_start();
include "config/connection.php";
include "flash.php";

// token gerated
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // verify the token
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        flash("error", "Invalid Token");
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // ALL FIELD ARE REQUIRED
    if (!$email || !$password) {
        flash("error", "Please All Field Are Required");
        exit();
    }

    // CHECK EMAIL ALREADY EXIT OT NOT
    $sql = "SELECT * FROM register_table WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        flash("error", "Email Does Not Found");
        exit();
    }

    // FETCH USER DATA
    $user = mysqli_fetch_assoc($result);

    // VERIFY PASSWORD
    if (!password_verify($password, $user['password'])) {
        flash("error", "Invalid Password");
        exit();
    }

    // CREATE SESSION
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    // unset token
    unset($_SESSION['token']);
    flash("success", "Login Successfully");

    // REDIRECT DASHBOARD
    header("Location: dashboard.php");
    exit();
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
    <title>Login</title>
</head>

<body>
    <section
        class="form-section d-flex align-items-center justify-content-center">
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
                        <h2>Login into Facebook</h2>
                        <form method="post" action="#">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <div class="mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email address or phone number"
                                    name="email"
                                    aria-describedby="emailHelp" />
                            </div>
                            <div class="mb-3">
                                <input
                                    type="password"
                                    placeholder="Password"
                                    name="password"
                                    class="form-control" />
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Log in
                            </button>
                            <div class="forget-pass text-center py-4">
                                <a href="#" class="text-decoration-none">Forgotten Password?</a>
                            </div>
                            <div class="create-account text-center">
                                <a
                                    href="register.php"
                                    class="text-decoration-none btn btn-outline-primary">Create New Account</a>
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