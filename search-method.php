<?php
    require 'templates/header.php';

    if(isset($_GET['search']) && isset($_GET['submit'])){
        $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "SELECT * FROM baseapp_rooms WHERE CONCAT(room_name, ' ', room_description, ' ', topic_id) LIKE '%$search%' ORDER BY date_time DESC";

        $rooms = mysqli_query($connection, $query);

    } else{
        header('location: ' . ROOT_URL . 'index.php');
        die();
    }

?>
    <main>
        <div class="container">
            <div class="left">
                <a href="<?= ROOT_URL ?>Profile.php?id=<?= $profile_rooms['id'] ?>" class="profile">
                    <div class="profile-pic">
                        <img src="<?= $avatarPath ?>" alt="User Avatar">
                    </div>
                    <div class="handle">
                        <?php if (isset($_SESSION['user-id'])) : ?>
                        <h4><?= ($_SESSION['first_name'])?> </h4>
                        <p class="text-muted">
                            <?= ($_SESSION['username'])?>
                        </p>
                        <?php endif ?>
                    </div>
                </a>
                <label for="create-room" class="btn btn-primary">Create Room</label>
                <!-- end of sidebar -->
            </div>
            <!-- end of left -->

            <!-- MIDDLE -->
            <div class="middle">
                <!-- Create Room -->
                <div class="form__group">
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
                </div>
                
                <form class="create-room">
                    <div class="profile-pic">
                        <a href="<?= ROOT_URL ?>Profile.php?id=<?= $profile_rooms['id'] ?>">
                            <img src="<?= $avatarPath ?>" alt="User Avatar">
                        </a>
                    </div>
                    <input type="text" placeholder="Create your study room" name="create-room" id="create-room">
                    <label for="create-room" class="btn btn-primary">POST</label>
                </form>
                <!-- end of create room -->

                <!-- Browse Topics -->
                <div class="browse">
                    <h3>Browse Topics</h3>
                    <div class="browse-topics">
                            <div class="left-arrow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>
                        <?php
                            $roomsCount = getCount($connection, 'baseapp_rooms');

                            function getCount($connection, $tableName){
                                $query = "SELECT COUNT(*) AS count FROM $tableName";
                                $result = $connection->query($query);

                                if($result && $result->num_rows > 0){
                                    $row = $result->fetch_assoc();
                                    return $row['count'];
                                } else {
                                    return 0;
                                }
                            }
                        ?>
                        <div class="browse-links">
                            <ul>
                                <li><a href="index.php" class="active">All  <span><?= $roomsCount ?></span></a></li>
                                <?php while($topic = mysqli_fetch_assoc($room_topics)) : ?>
                                    <li><a href="#"><?= $topic['name'] ?></a></li>
                                <?php endwhile ?>
                            </ul>
                        </div>
                        <div class="right-arrow active">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
                <!-- Create Room -->
                <div class="form__group">
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
                </div>
                
                <?php if(mysqli_num_rows($rooms) > 0) : ?>
                <!-- Rooms -->
                <div class="rooms">
                    <!-- first room -->
                    <?php while($room = mysqli_fetch_assoc($rooms)) : ?>
                    <div class="room">
                        <div class="photo">
                            <img src="./images/thumbnail/<?= $room['room_thumbnail'] ?>" alt="">
                        </div>
                        <div class="room-box">
                            <div class="room_name">
                                <h3><a href="<?= ROOT_URL ?>Room.php?id=<?= $room['id'] ?>"><?= $room['room_name'] ?></a></h3>
                                <?php
                                    $topic_id = $room['topic_id'];
                                    $topic_query = "SELECT name FROM baseapp_topics WHERE id=$topic_id";
                                    $topic_result = mysqli_query($connection, $topic_query);
                                    $topic = mysqli_fetch_assoc($topic_result);
                                ?>
                                <p><?= $topic['name'] ?></p>
                            </div>
                            <div class="head">
                                <div class="card-header">
                                    <?php
                                        $host_id = $room['host_id'];
                                        $host_query = "SELECT * FROM baseapp_users WHERE id=$host_id";
                                        $host_result = mysqli_query($connection, $host_query);
                                        $host = mysqli_fetch_assoc($host_result);

                                        if (!empty($host['avatar'])) {
                                            $avatarPath = ROOT_URL . 'images/avatar/' . $host['avatar'];
                                        } else {
                                        // If the user doesn't have an avatar, use the default image
                                            $avatarPath = ROOT_URL . 'images/avatar/icons8-male-user-96.png';
                                        }
                                    ?>
                                    <a href="Profile.php" class="user">
                                        <div class="profile-pic">
                                            <img src="<?= $avatarPath ?>">
                                        </div>
                                        <div class="info">
                                            <h3><?= $host['username'] ?></h3>
                                            <small><?= date("M d, y - H:i", strtotime($room['date_time'])) ?></small>
                                        </div>
                                        
                                    </a>
                                    <?php
                                        // Check if the currently logged-in user is the host of the room
                                        $current_user_id = $_SESSION['user-id'];
                                         // Replace with the actual current user ID (e.g., from session)
                                        if ($current_user_id == $host_id) :
                                    ?>
                                    <span class="edit">
                                        <div class="dropdown">
                                            <button id="dropdown-button"><i class="fa-solid fa-ellipsis"></i></button>
                                            <div id="dropdown-content">
                                                <a class="edit-button" href="<?= ROOT_URL ?>edit_room.php?id=<?= $room['id'] ?>"><i class="fa-solid fa-edit"></i> Edit</a>
                                                <a class="delete-button" href="<?= ROOT_URL ?>delete_room.php?id=<?= $room['id'] ?>"><i class="fa-solid fa-trash-can delete"></i> Delete</a>
                                            </div>
                                        </div>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="liked-by">
                                <p><b>0</b> People joined</p>
                            </div>    
                        </div>
                    </div>
                    <!-- end of first room -->
                    <?php endwhile ?>
                </div>
                <?php else : ?>
                <br/>
                <div class="form__group">
                    <div class="messages">
                        <ul>
                            <li>
                                <p>
                                    No rooms found
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>              
                <?php endif ?>
                <!-- end of rooms -->
            </div>
            <!-- end of main middle -->

            <!-- RIGHT -->
            <div class="right">
                <!-- Recent activity -->
                <div class="activities">
                    <h4>Recent Activity</h4>
                    <div class="activity-container">
                        <!-- <div class="info">
                            <div class="profile-pic">
                                <img src="images/men/30.jpg" alt="">
                            </div>
                            <div>
                                <h5><a href="Profile.php">Username</a></h5>
                                <p class="text-muted">
                                    8 mutual friends
                                </p>
                            </div>
                        </div>
                        <div class="room-title">
                            <p>Replied to post "<a href="Room.php">HTML, CSS, & JS</a>"</p>
                            <div class="room-titleContent">
                                I’ll have to try this sometime. Really like this idea. Wanna talk about it? I ‘m....
                            </div>
                        </div> -->
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
    include 'templates/footer.php';
?>