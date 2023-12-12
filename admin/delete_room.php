<?php
    include 'templates/header.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM baseapp_rooms WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $room = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'admin/manage_users.php');
    }
?>
        <section class="main">
            <section class="main-course">
                <div class="course-box">
                    <div class="course"> 
                    <div class="main-header">
                        <?php
                            $topic_id = $room['topic_id'];
                            $topic_query = "SELECT name FROM baseapp_topics WHERE id=$topic_id";
                            $topic_result = mysqli_query($connection, $topic_query);
                            $topic = mysqli_fetch_assoc($topic_result);

                        ?>
                        <h1>Are you sure you want to delete "<?= $room['room_name'] ?> [<?= $topic['name']; ?>]"? </h1>
                    </div>
                        <div class="form__group">
                            <!-- <?php if (isset($_SESSION ['edit_user'])): ?>
                            <div class="messages">
                                <ul>
                                    <li>
                                        <p>
                                            <?= $_SESSION['edit_user'];
                                            unset($_SESSION['edit_user']);
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?> -->
                            <a href="<?= ROOT_URL ?>admin/delete-room-method.php?id=<?= $room['id'] ?>" class="btn btn-delete">Delete</a><br/>
                            <a href="<?= ROOT_URL ?>admin/manage_rooms.php" class="btn btn-dark">Cancel</a>    
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>
