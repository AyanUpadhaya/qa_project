<?php require "views/partials/header.php"; ?>

<div class="wrapper">
    <?php require 'partials/navbar.php'; ?>
    <div class="container">
        <h2>Add a New Question</h2>

        <!-- Display flash messages -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['flash_message'];
                unset($_SESSION['flash_message']);  // Remove the flash message after displaying it
                ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit Question</button>
        </form>
    </div>
</div>


<?php require "views/partials/footer.php"; ?>