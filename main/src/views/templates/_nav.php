<header>
    <nav>
        <div class="flex-space-between">
            <div class="nav-logo"><img src="/res/img/nav_icon_velo.svg"></img></div>
            <h1 class="nav-title">ISIMS PARK</h1>
            <div class="nav-user_info">
            <?php if (isset($_SESSION["user_firstname"])): ?>
                <div class="nav-firstname">Welcome <?= $_SESSION["user_firstname"] ?></div>
                <div class="nav-logout"><a href="logout.php">LOG OUT</a>
            <?php else: ?>
                <div class="nav-login"><a href="login.php">LOG IN</a>   
            <?php endif; ?>
            </div>
        </div>
    </nav>
</header>