<?php require "views/partials/header.php"; ?>

<div class="wrapper">

    <?php require "views/partials/navbar.php"; ?>
    <div class="container">
        <h2><?php echo htmlspecialchars($questionDetail['title']); ?></h2>
        <p><?php echo htmlspecialchars($questionDetail['description']); ?></p>
        <small>Category: <?php echo htmlspecialchars($questionDetail['category_name']); ?> |
            Posted by: <?php echo htmlspecialchars($questionDetail['username']); ?>
            on <?php echo $questionDetail['created_at']; ?></small>

        <hr>

        <div>
            <?php if ($_SESSION['user']['id'] === $questionDetail['user_id']): ?>
                <a href="delete_question.php?id=<?php echo $questionDetail['id']; ?>" class="btn btn-sm btn-danger">Delete Question</a>
            <?php endif; ?>
        </div>

        <!-- Flash message -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['flash_message'];
                unset($_SESSION['flash_message']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Answer form -->
        <?php if (isset($_SESSION['user'])): ?>
            <form action="process_answer.php" method="POST">
                <input type="hidden" name="question_id" value="<?php echo $questionDetail['id']; ?>">
                <div class="form-group">
                    <label for="answer">Your Answer</label>
                    <textarea name="answer" id="answer" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit Answer</button>
            </form>
        <?php else: ?>
            <p>Please <a href="/login.php">login</a> to submit an answer.</p>
        <?php endif; ?>

        <hr>

        <!-- List of answers -->
        <h3>Answers</h3>
        <?php if (count($answers) > 0): ?>
            <ul class="list-group">
                <?php foreach ($answers as $answer): ?>
                    <li class="list-group-item">
                        <p><?php echo htmlspecialchars($answer['answer']); ?></p>
                        <small>Posted by: <?php echo htmlspecialchars($answer['username']); ?> on
                            <?php echo $answer['created_at']; ?></small>
                        <br>
                        <small>Liked: <?php echo checkLikeCount($answer['id']); ?></small>
                        <br>

                        <div class="d-flex gap-2">
                            <div>
                                <?php if (checkeIfLiked($answer['id'], $_SESSION['user']['id'])): ?>
                                    <!-- Unlike button -->
                                    <a href="toggleLike.php?action=unlike&answer_id=<?php echo $answer['id']; ?>" class="btn btn-sm btn-danger">
                                        Unlike
                                    </a>
                                <?php else: ?>
                                    <!-- Like button -->
                                    <a href="toggleLike.php?action=like&answer_id=<?php echo $answer['id']; ?>" class="btn btn-sm btn-success">
                                        Like
                                    </a>
                                <?php endif; ?>
                                
                               
                            </div>
                            <div>
                                 <!-- Show Delete link only for the user who posted the answer -->
                                <?php if ($answer['user_id'] == $_SESSION['user']['id']): ?>
                                    <a href="delete_answer.php?id=<?php echo $answer['id']; ?>" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this answer?');">Delete</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No answers yet. Be the first to answer!</p>
        <?php endif; ?>
    </div>
</div>

<?php require "views/partials/footer.php"; ?>