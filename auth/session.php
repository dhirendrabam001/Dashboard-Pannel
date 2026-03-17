<?php

// SET TIMEOUT (in seconds)
$timeout = 300; // 5 minutes (600 = 10 minutes)

// CHECK USER LOGIN OR NOT
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// CHECK SESSION TIME
if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    if ($inactive_time > $timeout) {
        // SESSION EXPIRED
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();
    }
}

// UPDATE LAST ACTIVITY TIME
$_SESSION['last_activity'] = time();
