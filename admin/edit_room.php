<?php
    include 'templates/header.php';

    $topic_query = "SELECT * FROM baseapp_topics";
    $room_topics = mysqli_query($connection, $topic_query);

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM baseapp_rooms WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $room = mysqli_fetch_assoc($result);
    } else{
        header('location: ' . ROOT_URL . 'admin/manage_rooms.php');
    }
?>

        <section class="main">
            <div class="main-header">
                <h1>Edit Room</h1>
            </div>
            <section class="main-course">
                <div class="course-box">
                    <div class="course">
                        <div class="form__group">
                            <?php if (isset($_SESSION ['edit_room'])): ?>
                            <div class="messages">
                                <ul> 
                                    <li>
                                        <p>
                                            <?= $_SESSION['edit_room'];
                                            unset($_SESSION['edit_room']);
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?>
                            <form action="<?= ROOT_URL ?>admin/edit-room-method.php" method="POST" enctype="multipart/form-data">
                                <label for="room_name">Room Name</label>
                                <input type="hidden" name="id" value="<?= $room['id'] ?>">
                                <input required id="room_name" name="room_name" value="<?= $room['room_name'] ?>" type="text" placeholder="E.g. Web Development" />
                                <label for="room_topic">Topic</label>
                                <input required type="text" id="new_topic" list="topic-list" name="new_topic" />
                                    <datalist id="topic-list">
                                        <select name="room_topic">
                                            <?php while($topic = mysqli_fetch_assoc($room_topics)) : ?>
                                            <option value="<?= $topic['id'] ?>"><?= $topic['name'] ?></option>
                                            <?php endwhile ?>
                                        </select>
                                </datalist>
                                <label for="room_about">About</label>
                                <textarea required name="room_description" id="room_about" placeholder="Write about your study group..."><?= $room['room_description'] ?></textarea>
                                <label for="room_thumbnail">Thumbnail</label>
                                <input type="text" name="previous_thumbnail_name" value="<?= $room['room_thumbnail'] ?>">
                                <input type="file" name="room_thumbnail" id="thumbnail">

                                <button type="submit" class="btn btn-primary" name="submit" target="_self"><a>Create Study Room</a></button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>