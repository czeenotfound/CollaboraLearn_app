<?php
    include 'templates/header.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM baseapp_users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $profile = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'LoginPage.php'); // RESTRICTING USER TO ACCESS TO THE WEBSITE NEED TO LOGIN SESSION FIRST
    }

    $current_user_id = $_GET['id'];

    $query = "SELECT id, room_name, room_thumbnail, date_time, topic_id, host_id FROM baseapp_rooms WHERE host_id=$current_user_id ORDER BY id DESC";
    $profile_rooms = mysqli_query($connection, $query);

    // Check if the user has uploaded an avatar
    if (!empty($profile['avatar'])) {
        $avatarPath = ROOT_URL . 'images/avatar/' . $profile['avatar'];
    } else {
    // If the user doesn't have an avatar, use the default image
        $avatarPath = ROOT_URL . 'images/avatar/icons8-male-user-96.png';
    }

?>
    <main>
        <div class="profile-container">
            <!-- Profile main -->
            <div class="profile-main">
                <div class="profile">
                    <div class="profile-header">
                        <div class="profilecard">
                            <div class="cover-pic">
                                <!-- green cover photo -->
                            </div>
                            <div class="profile-pic">
                                <img src="<?= $avatarPath ?>" alt="">
                            </div>
                            <div class="profile-info">
                                <h3><?= $profile['first_name']?> <?= $profile['last_name'] ?></h3>
                                <p>@<?= $profile['username'] ?></p>
                                <a href="<?= ROOT_URL ?>edit_profile.php?id=<?= $profile['id'] ?>" class="btn btn-primary editProfile-button"><i class="fa-solid fa-user-edit"></i> Edit Profile</a>
                            </div>
                            <div class="profile-bio">
                                <h4>Bio</h4>
                                <p><?= $profile['bio'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-post">
                    <h4>Posts</h4>
                    <?php while($room = mysqli_fetch_assoc($profile_rooms)) : ?>
                    <div class="room">
                        <div class="photo">
                            <img src="./images/thumbnail/<?= $room['room_thumbnail'] ?>" alt="">
                        </div>
                        <div class="room-box">
                            <div class="room_name">
                                
                                <h3><a href=""></a></h3>
                                <p></p>
                            </div>
                            <div class="head">
                                <div class="card-header">
                                    <a href="<?= ROOT_URL ?>Profile.php?id=<?= $room['host_id']?>" class="user">
                                        <div class="profile-pic">
                                            <img src="<?= $avatarPath ?>" alt="">
                                        </div>
                                        <div class="info">
                                            <h3><?= $profile['username'] ?></h3>
                                            <small><?= date("M d, Y - H:i", strtotime($room['date_time'])) ?></small>
                                        </div>
                                        
                                    </a>
                                    
                                    <span class="edit">
                                        <div class="dropdown">
                                            <button id="dropdown-button"><i class="fa-solid fa-ellipsis"></i></button>
                                            <div id="dropdown-content">
                                                <a class="edit-button" href=""><i class="fa-solid fa-edit"></i> Edit</a>
                                                <a class="delete-button" href=""><i class="fa-solid fa-trash-can delete"></i> Delete</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <br/>
                            <div class="liked-by">
                                <p><b>0</b> People joined</p>
                            </div>  
                        </div>
                    </div>
                    <?php endwhile ?>
                </div>
            </div>
            <!-- end of Profile main -->
            <!-- Profile right -->
            <div class="profile-right">
                <div class="preference-container">
                    <div class="cover-pic">
                        <!-- green cover photo -->
                    </div>
                    <div class="preference">
                        <h3><i class="fa-solid fa-book"></i> Subjects of Interest:</h3> 
                        <ul>
                            <li><p>Subject A</p></li>
                            <li><p>Subject B</p></li>
                            <li><p>Subject C</p></li>
                        </ul>
                    </div> 
                    <div class="preference middle">
                        <h3><i class="fa-solid fa-school"></i> Preferred Study Methods:</h3>
                        <ul>
                            <li><p>Method X</p></li>
                            <li><p>Method Y</p></li>
                        </ul>
                        
                    </div>
                    <div class="preference">
                        <h3><i class="fa-regular fa-clock"></i> Availability:</h3>
                        <ul>
                            <li><p>Weekdays</p></li>
                            <li><p>Evenings</p></li>
                        </ul>
                    </div>
                </div>
                <h4>Recent Activity</h4>
                    <div class="activity-container">
                        
                        
                    </div>
            </div>
            <!-- end of Profile left -->
        </div>
    </main>

<?php
    include 'templates/footer.php';
?>