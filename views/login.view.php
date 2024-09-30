<?php require "views/partials/header.php"; ?>

<div class="wrapper">
    <?php require "views/partials/navbar.php"; ?>

    <?php
    // Check if there is a flash message and display it
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="container mx-auto alert alert-success">' . $_SESSION['flash_message'] . '</div>';

        // Unset the flash message so it doesn't show up again
        unset($_SESSION['flash_message']);
    }
    ?>
    <div class="container py-2">
        <h2>Login</h2>
        <!-- Attach the JavaScript validation function to the form using 'onsubmit' -->
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            onsubmit="return validate();">
            <div class="form-group">
                <label class="form-label" for="username">Username:</label>
                <input class="form-control" type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <!-- Error message container -->
                <span id="password_info" style="color: red;"></span>
            </div>
            <div class="mt-2">
                <button class="btn btn-secondary" type="submit">Login</button>
            </div>
        </form>
        <?php require "views/partials/validate.php"; ?>
    </div>

    <?php require "views/partials/footer.php"; ?>
</div>