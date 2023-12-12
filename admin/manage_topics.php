<?php
    include 'templates/header.php';

    $query = "SELECT * FROM baseapp_topics ORDER BY name";
    $topics = mysqli_query($connection, $query);
?>

        <section class="main">
            <div class="main-header">
                <h1>Manage Topics</h1>
                <button><a class="btn btn-primary" href="add_topic.php"><i class="fa-solid fa-plus"> </i> Add Topic</a></button>
            </div>

            <section class="main-course">
                <?php if (isset($_SESSION ['add-topic-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['add-topic-success'];
                                    unset($_SESSION['add-topic-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_SESSION ['delete-topic-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['delete-topic-success'];
                                    unset($_SESSION['delete-topic-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
                <?php if (mysqli_num_rows($topics) > 0): ?>
                <div class="course-box">
                    <div class="course">
                        <table>
                            <thead>
                                <tr>
                                    <th>Topic</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($name = mysqli_fetch_assoc($topics)) : ?>
                                    <tr>
                                        <td> <?= $name['name']; ?></td>
                                        <td class = "actions"><a href="<?= ROOT_URL ?>admin/delete_topic.php?id=<?= $name['id'] ?>" class="btn btn-delete">Delete</a></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else : ?>
                    <div class="form__group">
                        <div class="messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= "No topics found" ?>
                                    </p>
                                </li>
                            </ul>
                        </div>  
                    </div>
                <?php endif ?>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>