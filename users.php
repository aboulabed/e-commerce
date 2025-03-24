<?php
include('server/check_login.php');
include('server/connection.php');
switch ($_SESSION['user_type']) {
    case 'user':
        echo "<script>window.location.href='../account.php';</script>";
        break;
}
// Edit user
if (isset($_POST['edit-user'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("UPDATE users SET user_name = ?, user_email = ?, user_type = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $user_name, $user_email, $user_type, $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: users.php");
    exit();
}
// Delete user
if (isset($_POST['delete-user'])) {
    $user_id = $_POST['user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: users.php");
    exit();
}
// Add user
if (isset($_POST['add-user'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_type = $_POST['user_type'];
    $user_password = $_POST['user_password'];
    // check if not dublicate email
    $stmt1 = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt1->bind_param("s", $user_email);
    $stmt1->execute();
    $result = $stmt1->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists');</script>";
        $stmt1->close();
    } else {

        $stmt2 = $conn->prepare("INSERT INTO users (user_name, user_email, user_type, user_password) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("ssss", $user_name, $user_email, $user_type, $user_password);
        $stmt2->execute();
        $stmt2->close();
        header("Location: users.php");
        exit();
    }
}
// Pagination logic
$usersPerPage = 8; // Number of users per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $usersPerPage; // Calculate offset

// Fetch total number of users
$stmt1 = $conn->prepare("SELECT COUNT(*) as total FROM users");
$stmt1->execute();
$totalusersResult = $stmt1->get_result();
$totalusers = $totalusersResult->fetch_assoc()['total'];
$stmt1->close();

// Fetch users for the current page
$stmt2 = $conn->prepare("SELECT * FROM users ORDER BY user_id LIMIT ? OFFSET ?");
$stmt2->bind_param("ii", $usersPerPage, $offset);
$stmt2->execute();
$users = $stmt2->get_result();
$stmt2->close();

// Calculate total number of pages
$totalPages = ceil($totalusers / $usersPerPage);
include('layouts/header.php');
include('layouts/sidebar.php');
?>
<div class="page-body">
    <div class="content m-5">
        <h2 class="mb-4">users</h2>
        <div class="add-user">
            <!-- Button trigger modal -->
            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#adduser">
                Add user
            </button>

            <!-- Modal -->
            <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduserLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="adduserLabel">Add user</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="users.php" method="post">
                            <div class="modal-body row">
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="user_name">user name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="user_email">user email</label>
                                    <input type="email" class="form-control" id="user_email" name="user_email" required>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="user_type">user type</label>
                                    <select class="form-select" aria-label="Default select example" name="user_type">

                                        <option value="admin">Admin</option>
                                        <option value="client" selected>Client</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="user_password">user password</label>
                                    <input type="password" class="form-control" id="user_password" name="user_password" required></input>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="add-user">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="latest-orders card mt-4 mb-3 rounded-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card-body">
                    <div class="table-responsive">

                        <table>
                            <thead>
                                <tr>
                                    <th>user ID</th>
                                    <th>user Name</th>
                                    <th>user Email</th>
                                    <th>user Type</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = $users->fetch_assoc()) { ?>


                                    <tr>
                                        <td>#<?php echo $user['user_id']; ?></td>
                                        <td><?php echo $user['user_name']; ?></td>
                                        <td><?php echo $user['user_email']; ?></td>
                                        <td><?php echo $user['user_type']; ?></td>
                                        <td class="date"><?php echo $user['date_added']; ?></td>
                                        <td class="action">
                                            <!-- Button trigger modal -->
                                            <i class="fas fa-edit" style="color: #2fa3d6;" type="button" data-bs-toggle="modal" data-bs-target="#editModel<?php echo $user['user_id']; ?>"></i>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModel<?php echo $user['user_id']; ?>" tabindex=" -1" aria-labelledby="editModelLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModelLabel">Edit user</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="users.php?page=<?php echo $page; ?>" method="post">

                                                            <div class="modal-body">
                                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                                <div class="form-group mb-3">
                                                                    <label for="user_name">user name</label>
                                                                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user['user_name']; ?>" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="user_email">user email</label>
                                                                    <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $user['user_email']; ?>" required>
                                                                </div>
                                                                <label for="user_type">user type</label>
                                                                <select class="form-select" aria-label="Default select example" name="user_type">

                                                                    <option value="admin">Admin</option>
                                                                    <option value="client" selected>Client</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="edit-user" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="users.php?page=<?php echo $page; ?>" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>"><input type="hidden" name="delete-user">
                                                <button type="submit" class="btn p-0" name="delete-user"><i class="fas fa-trash" style="color: #fb8182;"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php if ($page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>

                                <?php if ($page < $totalPages) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include('layouts/footer.php'); ?>
<style>
    body {
        background-color: #edf8fd;
    }

    .navbar {
        width: 85%;
        justify-self: right;
        box-shadow: none !important;
        max-height: 10vh;
        position: sticky !important;

        img,
        h2 {
            display: none;
        }
    }

    .page-body {
        justify-self: right;
        width: 85%;

        .add-user {
            display: flex;
            justify-content: end;

            &>button,
            .modal-footer>button {
                background-color: #008ecc;
                color: #d7edf7;
                font-size: 12px;
                border-radius: 10px;
            }

            .modal-body {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;

                input,
                select {
                    width: 100%;
                }
            }
        }

        table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: separate;
            border-spacing: 0 20px;
            overflow: hidden;

            thead {
                background-color: #edf8fd;


                th {
                    font-weight: 600;
                    padding: 10px;
                    overflow: hidden;
                }

                th:first-of-type {
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px
                }

                th:last-of-type {
                    border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px
                }
            }

            tbody {
                td {
                    padding: 10px;
                    color: #6e7070;

                    &.date {
                        background-color: #ddf2fb;
                        text-align: center;
                        color: #015579 !important;
                        border-radius: 2rem;
                    }

                    &.action {
                        background-color: #ddf2fb;
                        text-align: center;
                        color: #015579 !important;
                        display: flex;
                        justify-content: space-between;
                        max-width: fit-content;
                        gap: 15px;
                        justify-self: center;
                        align-items: center;
                        border-radius: 0.5rem !important;

                        svg {
                            cursor: pointer;
                        }
                    }
                }
            }
        }
    }

    footer {
        display: none;
    }
</style>