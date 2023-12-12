<?php
    include 'templates/header.php';

    $name= $_SESSION['add_topic'] ?? null;

    unset($_SESSION['add-topic-data']);
?>

        <section class="main">
            <div class="main-header">
                <h1>Add Topic</h1>
            </div>

            
            <section class="main-course">
                <div class="course-box">
                    <div class="course">
                        <div class="form__group">
                            <?php if (isset($_SESSION ['add_topic'])): ?>
                            <div class="messages">
                                <ul>
                                    <li>
                                        <p>
                                            <?= $_SESSION['add_topic'];
                                            unset($_SESSION['add_topic']);
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?>
                            <form action="<?= ROOT_URL ?>admin/add-topic-method.php" method="POST">
                                <label for="room_topic">Topic</label>
                                <input required type="text" name="name" id="room_topic" list="topic-list" value="<?= $name ?>">
                                
                                <button type="submit" class="btn btn-primary" name="submit" target="_self"><a>Add Topic</a></button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>