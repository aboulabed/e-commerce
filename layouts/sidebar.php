<?php 
// Get the current page's filename
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar border-end shadow">
    <div class="logo mb-3">
        <img src="assets/imgs/logo.png" class="logo" alt="">
    </div>

    <ul class="list-unstyled ps-0">

        <li class="mb-2 ms-2 <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">
            <i class="fas fa-th-large"></i>
            <a href="dashboard.php" class="text-decoration-none">Dashboard</a>

        </li>
        <li class="mb-2 ms-2 <?php echo $currentPage === 'orders.php' ? 'active' : ''; ?>">
            <i class="fas fa-tasks"></i>
            <a href="orders.php" class="text-decoration-none">Orders</a>

        </li>
        <li class="mb-2 ms-2 <?php echo $currentPage === 'products.php' ? 'active' : ''; ?>">
            <i class="fas fa-tasks"></i>
            <a href="products.php" class="text-decoration-none">Products</a>

        </li>
        <hr>

        <li class="mb-2 ms-2 <?php echo $currentPage === 'users.php' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <a href="users.php" class="text-decoration-none">Manage Users</a>

        </li>
        <hr>
        <li class="mb-2 ms-2 <?php echo $currentPage === 'logout.php' ? 'active' : ''; ?>">
            <i class="fas fa-sign-out-alt"></i>
            <a href="logout.php" class="text-decoration-none">Logout</a>

        </li>


    </ul>
</div>

<style>
    .sidebar {
            width: 15%;
            background-color: white;
            height: 100vh;
            position: fixed;
            top: 0;

            div.logo {
                width: 100%;
                text-align: center;
            }

            ul {
                margin-top: 1.5rem;
                display: flex;
                flex-wrap: wrap;

                li {
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    font-size: 18px;
                    font-weight: 300;
                    padding: 10px 20px;
                    width: 85%;
                    justify-self: center;
                    border-radius: 10px;
                    transition: 0.3s ease;

                    &:hover {
                        transform: translateX(10px);
                    }

                    a {
                        margin-left: 10px;
                    }

                }

                hr {
                    width: 100%;
                    background-color: #6e7070;
                    height: 1px !important;
                }

                li.active {
                    background-color: #008ecc;
                    color: #d7edf7;
                }
            }
        }

</style>