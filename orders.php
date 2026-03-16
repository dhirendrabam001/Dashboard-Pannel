<?php
include "auth/auth.php";
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
                                    <a href="manage.php" class="nav-link link-dark">
                                        <i class="fa-solid fa-folder-open me-"></i>
                                        </svg>
                                        Manage
                                    </a>
                                </li>
                                <li>
                                    <a href="detailsItem.php" class="nav-link link-dark">
                                        <i class="fa-solid fa-folder-open me-"></i>
                                        </svg>
                                        All Items
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link link-dark">
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
                        <h2 class="fw-bold fs-2 mb-3">Orders</h2>
                        <div class="divider"></div>
                        <div class="orders-main">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="orders-card d-flex align-items-center shadow">
                                        <div class="order-icons">
                                            <i class="fa-solid fa-cart-shopping me-2"></i>
                                        </div>
                                        <div class="orders-card-content">
                                            <h2>1,120</h2>
                                            <p>Total Orders</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- order-2 -->
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="orders-card d-flex align-items-center shadow">
                                        <div class="order-icons">
                                            <i class="fa-solid fa-circle-check me-2 bg-success"></i>
                                        </div>
                                        <div class="orders-card-content">
                                            <h2>150</h2>
                                            <p>Completed Orders</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- order-3 -->
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="orders-card d-flex align-items-center shadow">
                                        <div class="order-icons">
                                            <i class="fa-solid fa-circle-check me-2 bg-warning"></i>
                                        </div>
                                        <div class="orders-card-content">
                                            <h2>100</h2>
                                            <p>Pending Orders</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- order-4 -->
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="orders-card d-flex align-items-center shadow">
                                        <div class="order-icons">
                                            <i class="fa-solid fa-circle-check me-2 bg-danger"></i>
                                        </div>
                                        <div class="orders-card-content">
                                            <h2>50</h2>
                                            <p>Canceled Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SEARCH FILTER START-->
                            <div class="search-filter">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Search...">

                                        </div>
                                    </div>
                                    <!--STATUS  -->
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <div class="status-info">
                                            <select class="form-select select-color" aria-label="Default select example">
                                                <option selected>Select Status</option>
                                                <option value="1" class="color-info">Pending</option>
                                                <option value="2" class="color-info">Success</option>
                                                <option value="3" class="color-info">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Select Date  -->
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <div class="date-info">
                                            <!-- Fake Select -->
                                            <select id="dateSelect" class="form-select">
                                                <option>Select Date</option>
                                            </select>
                                            <!-- Hidden Real Date Input -->
                                            <input type="date" id="realDate">
                                        </div>
                                    </div>

                                    <!-- EXPORT SECTION -->
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <div class="status-info">
                                            <select class="form-select select-color" aria-label="Default select example">
                                                <option selected>Export</option>
                                                <option value="1" class="color-info">CSV</option>
                                                <option value="2" class="color-info">Excel</option>
                                                <option value="3" class="color-info">PDF</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- ADD ORDER -->
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <div class="add-btn">
                                            <button class="btn btn-primary"> <i class="fa-solid fa-plus"></i> Add Orders</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SERVER FILTER END-->

                        <!-- ORDER-DASHBOARD -->
                        <div class="order-dashboard">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="$gray-100">
                                        <tr>
                                            <th scope="col">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="form-check m-0">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                    </div>
                                                    <span class="fw-semibold">Order ID</span>
                                                </div>
                                            </th>

                                            <th scope="col" class="fw-semibold">Customer</th>
                                            <th scope="col" class="fw-semibold">Order Date</th>
                                            <th scope="col" class="fw-semibold">Status</th>
                                            <th scope="col" class="fw-semibold text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-info">
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="form-check m-0">
                                                        <input class="form-check-input row-check" type="checkbox">
                                                    </div>
                                                    <span class="fw-semibold">#1250</span>
                                                </div>
                                            </th>

                                            <td>
                                                <h6 class="mb-0">Dhirendra</h6>
                                                <small class="text-muted">dhirendrabam12@gmail.com</small>
                                            </td>

                                            <td>12 Oct 2026</td>

                                            <td>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- ORDER-DASHBOARD END -->
                        <!-- DASHBOARD-ORDER-CONTENT -->
                        <div class="order-dashboard-content">
                        </div>
                    </div>
                    <!-- DASHBOARD ORDER-CONTENT-END -->
                </div>
                <!-- RECENT DATA SECTION -->
            </div>
        </div>
    </section>


    <!-- HOME PAGES END -->





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>

</html>