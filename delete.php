<?php
session_start();
include "config/connection.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // DELETE SYNTAX
    $delete = "DELETE FROM item_table WHERE id = '$id'";
    if (mysqli_query($conn, $delete)) {
        header("Location: dashboard.php?msg=Item Deleted Successfully");
        exit();
    }
}
