<header>
    <nav>
        <div class="flex-space-between">
            <div class="nav-logo"><a href="/"><img src="/res/img/nav_icon_velo.svg"></img></a></div>
            <h1 class="nav-title">ISIMS PARK</h1>
            <div class="nav-user_info">
            <?php if (isset($_SESSION["user_firstname"])): ?>
                <div class="nav-firstname">Welcome <?= $_SESSION["user_firstname"] ?></div>
                <div class="right-side">
                    <div class="log-button">
                        <a href="/logout">LOG OUT</a>
                    </div>
                <?php else: ?>
                    <div class="log-button">
                        <a href="/login">LOG IN</a>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>