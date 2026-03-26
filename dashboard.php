<?php
include "auth/auth.php";
include "auth/session.php";
include "config/connection.php";
include "flash.php";

// total user
$user_info = "SELECT COUNT(*) AS total_user FROM item_table";
$user_result = mysqli_query($conn, $user_info);
$fetch_data = mysqli_fetch_assoc($user_result);
$total_user = $fetch_data['total_user'];

// total orders
$total_query = "SELECT COUNT(*) AS total_order FROM order_table";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_order = $total_row['total_order'];

// updated data from backend
if (isset($_POST['submit'])) {

    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $name = $_POST['name'];
    $skills = $_POST['skills'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? "Active" : "Inactive";

    // updated data
    $sql = "UPDATE item_table SET
    title = '$title',
    name = '$name',
    skills = '$skills',
    category = '$category',
    description = '$description',
    status = '$status'
    WHERE id =$id";

    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
    flash("success", "Item Updated Successfully");
    exit();
}

// fetch all the data items
$sql = "SELECT * FROM item_table ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
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
    <title>Dashboard</title>
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
                    <div class="dashbaord-content-left">
                        <h2 class="fw-bold fs-2 mb-3">Dashboard</h2>
                        <div class="divider"></div>
                        <div class="card-info">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="card-content shadow">
                                        <h5 class="fs-6 mb-3">Total User</h5>
                                        <h3 class="fw-bold fs-2"><?php echo $total_user; ?></h3>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="card-content-posts shadow">
                                        <h5 class="fs-6 mb-3">Total Posts</h5>
                                        <h3 class="fw-bold fs-2"><?php echo $total_user; ?></h3>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="card-content-orders shadow">
                                        <h5 class="fs-6 mb-3">Total Orders</h5>
                                        <h3 class="fw-bold fs-2"><?php echo $total_order ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- RECENT DATA SECTION -->
                    <div class="react-data">
                        <h2 class="fw-bold fs-5">Recent Data</h2>
                        <div class="divider"></div>
                        <div class="table-content">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Skills</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['skills']; ?></td>
                                                <td><?php echo $row['category']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['status'] == "Active") {
                                                        echo '<span class="badge bg-success">Active</span>';
                                                    } else {
                                                        echo '<span class="badge bg-secondary">Inactive</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <!-- edit modal -->
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">
                                                        Edit
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Dashboard Item</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="" method="POST">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                                <div class="item-content">
                                                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Title<span class="text-danger">*</span></label>
                                                                                        <input type="text" value="<?php echo $row['title']; ?>" name="title" class="form-control" placeholder="Enter Title...">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                                <div class="item-content">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Name<span class="text-danger">*</span></label>
                                                                                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter Name...">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                                <div class="item-content">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Skills <span class="text-danger">*</span></label>
                                                                                        <input type="text" value="<?php echo $row['skills']; ?>" name="skills" class="form-control" placeholder="Enter Subject...">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                                <div class="item-content">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                                                                        <select name="category" class="form-select">
                                                                                            <option selected disabled>Select category</option>
                                                                                            <option <?php if ($row['category'] == "Education") echo "Selected"; ?>>Education</option>
                                                                                            <option <?php if ($row['category'] == "Technology") echo "Selected"; ?>>Technology</option>
                                                                                            <option <?php if ($row['category'] == "Designer") echo "Selected"; ?>>Designer</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Description<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" name="description" placeholder="Enter Description..." rows="5"><?php echo $row['description']; ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="d-flex align-items-center mb-4">
                                                                                    <label class="form-label me-3 mb-0">Status:</label>

                                                                                    <div class="form-check form-switch">
                                                                                        <input class="form-check-input" name="status"
                                                                                            value="Active"
                                                                                            <?php echo ($row['status'] == "Active") ? "checked" : ""; ?>
                                                                                            type="checkbox">
                                                                                        <label class="form-check-label">Active</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="add-item-btn text-center">
                                                                            <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure to delete this item?');">
                                                        Delete
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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