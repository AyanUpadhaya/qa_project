<?php require "views/partials/header.php"; ?>

<div class="wrapper">

    <?php require "views/partials/navbar.php"; ?>
    <div class="container">
        <h3>Your questions</h3>

        <?php
        // Check if there is a flash message and display it
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="container mx-auto alert alert-success">' . $_SESSION['flash_message'] . '</div>';

            // Unset the flash message so it doesn't show up again
            unset($_SESSION['flash_message']);
        }
        ?>

        <?php if (count($questions) > 0): ?>
            <ul class="list-group">
                <?php foreach ($questions as $question): ?>
                    <li class="list-group-item">
                        <a href="<?php echo "question_detail.php?id=" . $question['id']; ?>"
                            class="list-group-item list-group-item-action">
                            <?php echo $question["title"]; ?>
                        </a>
                        <small>Posted on: <?php echo $question['created_at']; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No questions available for this category.</p>
        <?php endif; ?>

    </div>

</div>
<?php require "views/partials/footer.php"; ?>