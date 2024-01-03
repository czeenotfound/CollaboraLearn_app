<?php
    include 'templates/header.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM baseapp_users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'index.php');
    }
?> 
    <div id="edit-modal" class="editmodal">
        <div class="room-modal-content">
            <div class="create-room-form">
                <h3>Update study room</h3>
                <div class="form__group">
                    <?php if (isset($_SESSION ['edit_profile'])): ?>
                        <div class="messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= $_SESSION['edit_profile'];
                                        unset($_SESSION['edit_profile']);
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form__group">
                    <form action="<?= ROOT_URL ?>edit-profile-method.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" placeholder="First Name" value="<?= $user['first_name'] ?>">
                        
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" placeholder="Last Name" value="<?= $user['last_name'] ?>" >

                        <label for="room_about">Bio</label>
                        <textarea required name="bio" id="bio" value="<?= $bio ?>" placeholder="Write about your bio..."><?= $user['bio'] ?? 'none' ?></textarea>

                        <label for="avatar">Avatar</label>
                        <div class="currentmessages">
                            <ul>
                                <li>
                                    <p>
                                        <?= $user['avatar'] ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="previous_avatar_name" value="<?= $user['avatar'] ?>">
                        <input type="file" name="user_avatar" id="avatar" value="<?= $user['avatar'] ?>">

                        <button class="btn btn-dark"><a href="index.php">Cancel</a><button>
                        <button type="submit" class="btn btn-primary" name="submit" target="_self"><a>Edit Profile</a></button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>