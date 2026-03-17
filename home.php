<?php
include "auth/auth.php";
include "config/connection.php";

/* Fetch all items */
$sql = "SELECT * FROM item_table ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h2 class="mb-4">Dashboard</h2>

        <a href="addnewitem.php" class="btn btn-success mb-3">Add New Item</a>

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Skills</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                            <tr>

                                <td><?php echo $row['id']; ?></td>

                                <td><?php echo htmlspecialchars($row['title']); ?></td>

                                <td><?php echo htmlspecialchars($row['name']); ?></td>

                                <td><?php echo htmlspecialchars($row['skills']); ?></td>

                                <td><?php echo htmlspecialchars($row['category']); ?></td>

                                <td><?php echo htmlspecialchars($row['description']); ?></td>

                                <td>

                                    <?php if ($row['status'] == "Active") { ?>

                                        <span class="badge bg-success">Active</span>

                                    <?php } else { ?>

                                        <span class="badge bg-secondary">Inactive</span>

                                    <?php } ?>

                                </td>

                                <td>

                                    <a href="edit.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure to delete this item?');">
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php

                        }
                    } else {

                        ?>

                        <tr>
                            <td colspan="8" class="text-center">No Items Found</td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
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
            <td><?php echo $row['status']; ?></td>

            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                    Delete
                </a>
            </td>

        </tr>

    <?php
    }
    ?>

</tbody>