<?php
session_start();
?>
<link rel="stylesheet" href="./assets/css/header.css">
<html>

<head></head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-primary">
        <a class="navbar-brand text-light mx-5" href="/">Car Rentals</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (!isset($_SESSION['user'])) { ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="margin-right: 80px">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-sign-in mx-2" aria-hidden="true"></i>Login
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/pages/agent_login.php">Agent Login</a></li>
                            <li><a class="dropdown-item" href="/pages/customer_login.php">Customer Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="margin-right: 80px">
                    <li class="nav-item">
                        <p class="nav-link text-light m-auto" id="navbar"> <?php echo $_SESSION['name'] ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light m-auto" href="/ajax_server/logout.php" id="navbar" role="button" aria-expanded="false">
                            Logout<i class="fa fa-sign-in mx-2" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>

        <?php } ?>
    </nav>
</body>

</html>