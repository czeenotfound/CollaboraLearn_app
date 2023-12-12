<?php
    include 'templates/header.php';

    $query = "SELECT * FROM baseapp_topics";
    $room_topics = mysqli_query($connection, $query);

    $room_name = $_SESSION['add_room']['room_name'] ?? null;
    $room_description = $_SESSION['add_room']['room_description'] ?? null;
    $topic_name= $_SESSION['add_topic'] ?? null;

    unset($_SESSION['add-room-data']);
?>
 
        <section class="main">
            <div class="main-header">
                <h1>Add Room</h1>
            </div>
            
            <section class="main-course">
                <div class="course-box">
                    <div class="course">
                        <div class="form__group">
                            <?php if (isset($_SESSION ['add_room'])): ?>
                            <div class="messages">
                                <ul>
                                    <li>
                                        <p>
                                            <?= $_SESSION['add_room'];
                                            unset($_SESSION['add_room']);
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?>
                            <form action="<?= ROOT_URL ?>admin/add-room-method.php" method="POST" enctype="multipart/form-data">
                                <label for="room_name">Room Name</label>
                                <input required id="room_name" name="room_name" value="<?= $room_name ?>" type="text" placeholder="E.g. Web Development" />
                                <label for="room_topic">Topic</label>
                                    <input required type="text" name="new_topic" id="new_topic" list="topic-list">
                                    <datalist id="topic-list">
                                        <select name="room_topic">
                                            <?php while($topic_name = mysqli_fetch_assoc($room_topics)) : ?>
                                            <option value="<?= $topic_name['id'] ?> = <?= $topic_name['name'] ?>"><?= $topic_name['name'] ?></option>
                                            <?php endwhile ?>
                                        </select>
                                    </datalist>
                                <label for="room_about">About</label>
                                <textarea required name="room_description" id="room_about" value="<?= $room_description ?>" placeholder="Write about your study group..."></textarea>
                                <label for="room_about">Thumbnail</label>
                                <input required type="file" name="room_thumbnail" id="thumbnail">

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