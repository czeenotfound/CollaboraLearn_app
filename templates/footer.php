<?php
    $topic_query = "SELECT * FROM baseapp_topics";
    $room_topics = mysqli_query($connection, $topic_query);

    $room_name = $_SESSION['add_room']['room_name'] ?? null;
    $room_description = $_SESSION['add_room']['room_description'] ?? null;
    $name= $_SESSION['add_topic'] ?? null;

    unset($_SESSION['add-room-data']);
?>
        <div class="bg-modal">
            <div class="create-modal-content">
                <div class="close">+</div>
                <div class="create-room-form">
                    <h3>Create your study room</h3>
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
                    </div>
                    <form class="form" action="<?= ROOT_URL ?>add-room-method.php" method="POST" enctype="multipart/form-data">
                        <div class="form__group">
                            <label for="room_name">Room Name</label>
                            <input required id="room_name" name="room_name" type="text"/>
                        </div>
                    
                        <div class="form__group">
                            <label for="room_topic">Topic</label>
                            <input type="text" name="new_topic" id="new_topic" list="topic-list" placeholder="--- Select your topic or Input a new topic---">
                            <datalist id="topic-list">
                                <select name="room_topic">
                                    <?php while($name = mysqli_fetch_assoc($room_topics)) : ?>
                                    <option value="<?= $name['id'] ?>"><?= $name['name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </datalist>
                        </div>
        
        
                        <div class="form__group">
                            <label for="room_about">About</label>
                            <textarea required name="room_description" id="room_about" value="<?= $room_description ?>" placeholder="Write about your study group..."></textarea>
                            <label for="room_about">Thumbnail</label>
                            <input required type="file" name="room_thumbnail" id="thumbnail">            
                        </div>
                        <div class="form__action">
                            <button><a class="btn btn-dark"  href="<?= ROOT_URL ?>">Cancel</a></button>
                            <button type="submit" class="btn btn-primary" name="submit" target="_self"><a>Create Study Room</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="editProfile-modal" class="editprofilemodal">
            <div class="profile-modal-content">
                <span class="close" id="close-editProfile">+</span>
                <h2>Edit Profile</h2>
                <form id="confirm-editProfile">
                    <label for="profilePicture">Profile Picture:</label>
                    <div class="Editprofile-pic">
                        <img id="imagePreview" src="" alt="Image Preview">
                    </div>
                    
                    <input type="file" id="profilePicture" accept="image/*">
                    
                    <label for="bio">Username</label>
                    <input type="text" id="username">

                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name">

                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name">

                    <label for="bio">Bio:</label>
                    <textarea id="bio"></textarea>

                    <label for="interests">Subjects of Interest:</label>
                    <input type="text" id="interests">

                    <label for="methods">Learning Methods:</label>
                    <input type="text" id="methods">

                    <label for="availability">Availability:</label>
                    <input type="text" id="availability">

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

        <!-- javascripts -->
        <script src="JS/room.js"></script>
        <script src="JS/index.js"></script>
    </body>
</html>