<?php
session_start();
// remove all the session data
$_SESSION = [];
// destroy data
session_destroy();
// redirect into loginpage
header("Location: login.php");
