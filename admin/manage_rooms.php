<?php
    include 'templates/header.php';

    $current_user_id = $_SESSION['user-id'];

    $query = "SELECT id, room_name, topic_id FROM baseapp_rooms WHERE host_id=$current_user_id ORDER BY id DESC";
    $rooms = mysqli_query($connection, $query);
?>

        <section class="main">
            <div class="main-header">
                <h1>Manage Rooms</h1>
                <button><a class="btn btn-primary" href="add_room.php"><i class="fa-solid fa-plus"> </i> Add Room</a></button>
            </div>
 
            <section class="main-course">
                <?php if (isset($_SESSION ['edit-room-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['edit-room-success'];
                                    unset($_SESSION['edit-room-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_SESSION ['add-room-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['add-room-success'];
                                    unset($_SESSION['add-room-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_SESSION ['delete-room-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['delete-room-success'];
                                    unset($_SESSION['delete-room-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
                <?php if (mysqli_num_rows($rooms) > 0): ?> 
                <div class="course-box">
                    <div class="course">
                        <table>
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Topic</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($room = mysqli_fetch_assoc($rooms)) : ?>
                                <?php
                                    $topic_id = $room['topic_id'];
                                    $topic_query = "SELECT name FROM baseapp_topics WHERE id=$topic_id";
                                    $topic_result = mysqli_query($connection, $topic_query);
                                    $topic = mysqli_fetch_assoc($topic_result);

                                ?>
                                <tr>
                                    <td> <?= $room['room_name']; ?></td>
                                    <td><?= $topic['name']; ?></td>
                                    <td class = "actions"><a href="<?= ROOT_URL ?>admin/edit_room.php?id=<?= $room['id'] ?>" class="btn btn-primary">Edit</a></td>
                                    <td class = "actions"><a href="<?= ROOT_URL ?>admin/delete_room.php?id=<?= $room['id'] ?>" class="btn btn-delete">Delete</a></td>
                                </tr>
                                <?php endwhile ?>
                                <!-- Add more rows as needed -->
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
                                        <?= "No rooms found" ?>
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