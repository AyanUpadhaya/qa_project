<?php require "views/partials/header.php"; ?>

<div class="wrapper">
    <?php session_start(); ?>
    <?php require "views/partials/navbar.php"; ?>
    <div class="container">
        <div class=" row">

            <div class="col-md-8 d-flex flex-column gap-2">
                <h4>Questions</h4>
                <div class="list-group ">

                    <?php foreach ($all_questions as $question): ?>

                        <li class="list-group-item">
                            <a href="<?php echo "question_detail.php?id=" . $question['id']; ?>"
                                class="list-group-item list-group-item-action">
                                <?php echo $question["title"]; ?>
                            </a>
                             <small>Posted on: <?php echo $question['created_at']; ?></small>
                        </li>

                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column gap-2">
                <h4>Categories</h4>
                <div class="list-group ">
                    <?php foreach ($all_categories as $category): ?>

                        <a href="<?php echo "category_questions.php?category_id=" . $category['id']; ?>"
                            class="list-group-item list-group-item-action">
                            <?php echo $category["name"]; ?>
                        </a>

                    <?php endforeach; ?>
                </div>
            </div>


        </div>
    </div>

</div>

<?php require "views/partials/footer.php"; ?>