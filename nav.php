<?php
$getAdmin = new \App\admin\Login();
$loginUser = $getAdmin->getSessionUser($_SESSION['login_id']);
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?=$root?>">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if ($page == "home"){echo "active";}?>">
                    <a class="nav-link" href="<?=$root?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if ($page == "food"){echo "active";}?>">
                    <a class="nav-link" href="foods.php">Foods</a>
                </li>
                <li class="nav-item <?php if ($page == "cat"){echo "active";}?>">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item <?php if ($page == "devices"){echo "active";}?>">
                    <a class="nav-link" href="devices.php">Devices</a>
                </li>
                <li class="nav-item <?php if ($page == "users"){echo "active";}?>">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <li class="nav-item <?php if ($page == "keys"){echo "active";}?>">
                    <a class="nav-link" href="access-keys.php">Keys</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?=$root.'orders.php'?>" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orders</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item <?php if ($page == "orders-today"){echo "active";}?>" href="<?=$root.'orders-today.php'?>">Orders Today</a>
                        <a class="dropdown-item <?php if ($page == "orders"){echo "active";}?>" href="<?=$root.'orders.php'?>">All Orders</a>
                        <a class="dropdown-item <?php if ($page == "orders-active"){echo "active";}?>" href="<?=$root.'orders-active.php'?>">Active Orders</a>
                        <a class="dropdown-item <?php if ($page == "orders-in-kitchen"){echo "active";}?>" href="<?=$root.'orders-in-kitchen.php'?>">In Kitchen</a>
                        <a class="dropdown-item <?php if ($page == "orders-in-table"){echo "active";}?>" href="<?=$root.'orders-intable.php'?>">Order Done</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?=$root.'settings.php'?>" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$loginUser['username']?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item <?php if ($page == "settings"){echo "active";}?>" href="<?=$root.'orders-today.php'?>">Settings</a>
                        <a class="dropdown-item <?php if ($page == "cat"){echo "active";}?>" href="<?=$root.'logout.php'?>">Logout</a>
                    </div>
                </li>
            </ul>
<!--            <form class="form-inline my-2 my-lg-0">-->
<!--                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">-->
<!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
<!--            </form>-->
        </div>
    </div>

</nav>