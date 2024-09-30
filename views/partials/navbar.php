<nav class="navbar bg-secondary navbar-expand-lg" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href=".">Discussion</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href=".">Home</a>
                </li>
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">Registration</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="user_questions.php">My questions</a>
                    </li>
                <?php endif; ?>

            </ul>
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Updated Logout Form -->
                <span class="pe-2 text-white bold"><?= "@" . $_SESSION['user']['username'] ;?></span>
                <form class="d-flex" action="logout.php" method="POST">
                    <button class="btn btn-dark" type="submit">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>