<?php
    require 'config1/dbconnection.php';

    // fetch user data from database
    // if user is user 
    if (isset($_SESSION['user-id'])) {
        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT avatar FROM baseapp_users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'LoginPage.php'); // RESTRICTING USER TO ACCESS TO THE WEBSITE NEED TO LOGIN SESSION FIRST
    }

    // fetch all the topics from database
    $topic_query = "SELECT * FROM baseapp_topics ORDER BY id DESC";
    $room_topics = mysqli_query($connection, $topic_query);
    
    
    $featured_query = "SELECT * FROM baseapp_rooms WHERE NOT is_featured=1";
    $featured_result = mysqli_query($connection, $featured_query);
    $featured = mysqli_fetch_assoc($featured_result);

    // Check if the user has uploaded an avatar
    if (!empty($avatar['avatar'])) {
        $avatarPath = ROOT_URL . 'images/avatar/' . $avatar['avatar'];
    } else {
    // If the user doesn't have an avatar, use the default image
        $avatarPath = ROOT_URL . 'images/avatar/icons8-male-user-96.png';
    }

    // rooms query
    $room_query = "SELECT * FROM baseapp_rooms ORDER BY date_time DESC";
    $rooms = mysqli_query($connection, $room_query);

    $current_user_id = $_SESSION['user-id'];

    $query = "SELECT id FROM baseapp_users WHERE id=$current_user_id";
    $profile_result = mysqli_query($connection, $query);
    $profile_rooms = mysqli_fetch_assoc($profile_result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS Link -->
        <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/main.css">
        <!-- <link rel="stylesheet" href="CSS/dashboard.css"> -->
        <link rel="stylesheet" href="./CSS/Room.css">
        <link rel="stylesheet" href="./CSS/profile.css">
        <!-- Icons Link -->
        <link rel="stylesheet" href="./CSS/fontawesomeoffline/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="icon" href="images/icons8-study-96.png"/>
        <title>CollaboraLearn</title>
    </head>
    <body>
        
        <nav>
            <div class="container">
                <div>
                    <a href="<?= ROOT_URL ?>index.php">
                        <h2 class="log"><img src="images/icons8-study-96.png" alt="">CollaboraLearn</h2>
                    </a>
                </div>
                <div class="links">
                    <ul class="nav_links">
                        <form action="<?= ROOT_URL ?>search-method.php" method="GET">
                            <div class="search-bar">
                                <input type="text" name="search" placeholder="Search for peers...">
                                <button type="submit" name="submit"><i class="btn-search fas fa-search"></i></button>
                            </div>
                        </form>
                        <li><a href="<?= ROOT_URL ?>"><i class="fa fa-home"></i></span></a></li>
                        <li><a href="#"><i class="fa fa-calendar"></i></a></li>
                    </ul>
                </div>
                <div class="create">
                    <label class="btn btn-primary" for="create-room">Create</label>
                    
                    <?php if (isset($_SESSION['user-id'])) : ?>
                        <div class="nav-profile" onclick="toggle()">
                            <div class="profile-pic">
                                <a href="<?= ROOT_URL ?>Profile.php?id=<?= $profile_rooms['id'] ?>"><img src="<?= $avatarPath ?>" alt="User Avatar"></a>
                            </div>
                            <p><?= ($_SESSION['first_name'])?> <?= ($_SESSION['last_name'])?><span>@<?= ($_SESSION['username'])?></span></p>
                            <i class="fa-solid fa-angle-down "></i>
                        </div>

                        <ul class="profile-dropdown-list">
                            <?php if(isset($_SESSION['user_is_admin'])) : ?>
                            <li class="profile-dropdown-list-item">
                                <a href="<?= ROOT_URL ?>admin/Dashboard.php">
                                    <i class="fa-solid fa-user"></i>
                                    Dashboard
                                </a>
                            </li>
                            <hr> 
                            <?php endif ?>    
                            <li class="profile-dropdown-list-item">
                                <a href="<?= ROOT_URL ?>Profile.php?id=<?= $profile_rooms['id'] ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <hr>
                            <li class="profile-dropdown-list-item">
                                <a href="<?= ROOT_URL ?>user_logout.php">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    <?php else : ?>
                        <a href="<?= ROOT_URL ?>LoginPage.php" class="btn btn-primary">Sign In</a>
                    <?php endif ?>
                    
                </div>
            </div>
        </nav>