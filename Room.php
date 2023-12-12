<?php
include 'templates/header.php';

// fetch room from database 

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM baseapp_rooms WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $room = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

// Handle sending messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message_text']) && !empty($_POST['message_text'])) {
        $message_text = filter_var($_POST['message_text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_id = $_SESSION['user-id'];

        // Insert the message into the database
        $insert_message_query = "INSERT INTO baseapp_messages (room_id, user_id, body, created) 
                                 VALUES ($id, $user_id, '$message_text', NOW())";
        $insert_message_result = mysqli_query($connection, $insert_message_query);

        if (!$insert_message_result) {
            echo 'Error inserting message into the database.';
        }
    }
}

?>
<!-- Main Room Page -->
<main>
    <?php if (isset($_SESSION['user-id'])) : ?>
        <div class="room-top">
            <a href="<?= ROOT_URL ?>"><p><i class="fa-solid fa-circle-chevron-left"></i> Back</p></a>
        </div>
    <?php endif ?>
    <div class="room-container">
        <!-- Room Left -->
        <div class="room-left">
            <div class="roomInfo">
                <div class="room-header">
                    <div class="coverpic">
                        <img src="./images/thumbnail/<?= $room['room_thumbnail'] ?>" alt="">
                    </div>
                    <div class="room-headerinfo">
                        <h2><?= $room['room_name'] ?></h2>
                        <small><?= date("M d, Y", strtotime($room['date_time'])) ?></small>
                    </div>
                </div>
                <div class="room-info">
                    <?php
                    $host_id = $room['host_id'];
                    $host_query = "SELECT * FROM baseapp_users WHERE id=$host_id";
                    $host_result = mysqli_query($connection, $host_query);
                    $host = mysqli_fetch_assoc($host_result);
                    ?>
                    <div class="room-creator">
                        <p>CREATED BY <span><a href="Profile.php">@<?= $host['username'] ?></a></span></p>
                    </div>
                    <div class="room-description">
                        <span><?= $room['room_description'] ?></span>
                    </div>
                    <?php
                    $topic_id = $room['topic_id'];
                    $topic_query = "SELECT name FROM baseapp_topics WHERE id=$topic_id";
                    $topic_result = mysqli_query($connection, $topic_query);
                    $topic = mysqli_fetch_assoc($topic_result);
                    ?>
                    <div class="room-topic">
                        <h4 class="btn btn-primary"><?= $topic['name'] ?></h4>
                    </div>
                </div>
            </div>
            <div class="room-members">
                <div class="members_header">
                    <h4>Members</h4>
                    <p>(<small># </small>Joined)</p>
                </div>
                <div class="members_name">
                    <?php
                        // Fetch and display members
                        $fetch_members_query = "SELECT DISTINCT u.id, u.username, u.avatar FROM baseapp_messages m 
                                            JOIN baseapp_users u ON m.user_id = u.id
                                            WHERE m.room_id = $id";

                        $fetch_members_result = mysqli_query($connection, $fetch_members_query);

                        $memberCount = 0;

                        while ($member = mysqli_fetch_assoc($fetch_members_result)) :
                            $memberCount++;

                        if (!empty($member['avatar'])) {
                            $avatarPath = ROOT_URL . 'images/avatar/' . $member['avatar'];
                        } else {
                            // If the user doesn't have an avatar, use the default image
                            $avatarPath = ROOT_URL . 'images/avatar/icons8-male-user-96.png';
                        }
                    ?>
                    <div class="members_namebox">
                        <div class="nav-profile">
                            <div class="profile-pic">
                                <a href="<"><img src="<?= $avatarPath ?>" alt=""></a>
                            </div>
                            <p><?= $member['username'] ?> <span>@<?= $member['username'] ?></span></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <!-- Room Main -->
        <div class="room-main">
            <div class="room">
                <div class="room-messages" id="scrollbottomtop">
                    <?php
                    // Fetch and display messages
                    $fetch_messages_query = "SELECT m.*, u.username FROM baseapp_messages m 
                                             JOIN baseapp_users u ON m.user_id = u.id
                                             WHERE m.room_id = $id 
                                             ORDER BY m.created ASC";

                    $fetch_messages_result = mysqli_query($connection, $fetch_messages_query);

                    while ($message = mysqli_fetch_assoc($fetch_messages_result)) :
                        // Check if the user has uploaded an avatar
                        if (!empty($message['avatar'])) {
                            $avatarPath = ROOT_URL . 'images/avatar/' . $message['avatar'];
                        } else {
                            // If the user doesn't have an avatar, use the default image
                            $avatarPath = ROOT_URL . 'images/avatar/icons8-male-user-96.png';
                        }

                        // Check if the message is from the current user
                        $isCurrentUser = $message['user_id'] == $_SESSION['user-id'];
                        // Set the message box class based on the user
                        $messageBoxClass = $isCurrentUser ? 'usermessage' : 'message';
                        ?>
                        <div class="<?= $messageBoxClass ?>">
                            <div class="<?= $isCurrentUser ? 'usermessageheader' : 'messageheader' ?>">
                                <div class="profile-pic">
                                    <a href="Profile.html"><img src="<?= $avatarPath ?>" alt=""></a>
                                </div>
                                <p class="profile-username">@<?= $message['username'] ?></p>
                                <?php if ($isCurrentUser) : ?>
                                    <p class="delete-button">x</p>
                                <?php endif; ?>
                            </div>

                            <div class="<?= $isCurrentUser ? 'usermessagebox' : 'messagebox' ?>">
                                <span><?= $message['body'] ?></span>
                                <small><?= date("M d, Y H:i:s", strtotime($message['created'])) ?></small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="room__message">
                    <form action="<?= ROOT_URL ?>room.php?id=<?= $id ?>" method="POST">
                        <input type="text" name="message_text" placeholder="Write your message here..." />
                        <button type="submit" name="submit">Send <i class="fa-solid fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Room Main -->
    </div>
</main>
<script>
    // Update the member count
    document.querySelector('.members_header p small').textContent = <?= $memberCount ?>;
</script>
<?php
include 'templates/footer.php';
?>
