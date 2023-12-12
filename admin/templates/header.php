<?php
    require 'config/dbconnection.php';

    // fetch user data from database
    // if user is admin
    if (isset($_SESSION['user_is_admin'])) {
        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT avatar FROM baseapp_users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
    } else {  
        header('location: ' . ROOT_URL . 'index.php');   // RESTRICTING USER TO ACCESS ADMIN DASHBOARD
    }
    
     // Check if the user has uploaded an avatar
    if (!empty($avatar['avatar'])) {
    $avatarPath = ROOT_URL . 'images/avatar/' . $avatar['avatar'];
    } else {
    // If the user doesn't have an avatar, use the default image
    $avatarPath = ROOT_URL . 'images/avatar/icons8-male-user-96.png';
    }

    //profile of users
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
        <link rel="stylesheet" href="<?= ROOT_URL ?>/CSS/dashboard.css">
        <!-- Icons Link -->
        <link rel="stylesheet" href="<?= ROOT_URL ?>/CSS/fontawesomeoffline/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="icon" href="<?= ROOT_URL ?>images/icons8-study-96.png"/>
        <title>CollaboraLearn | Dashboard</title>
    </head>
    <body>
        <div class="container">
            <nav id="VerticalNav">
                <ul>
                    <li>
                        <div id="logo">
                            <img id="brandicon" src="<?= ROOT_URL ?>images/icons8-study-96.png" alt="Error">
                            <img class="brandname" src="<?= ROOT_URL ?>images/2_collaboraLearnName.png"">
                        </div><hr/>
                    </li>
                    <?php if (isset($_SESSION['user-id'])) : ?>
                        <a href="<?= ROOT_URL ?>Profile.php?id=<?= $profile_rooms['id'] ?>" class="profile">
                            <div class="profile-pic">
                                <img src="<?= $avatarPath ?>" alt="User Avatar">
                            </div>
                            <div class="handle">
                                <h4><?= ($_SESSION['username'])?></h4>
                                <p class="text-muted">
                                    @<?= ($_SESSION['username'])?>
                                </p>
                            </div>
                        </a>
                    <?php else : ?>
                        <a href="<?= ROOT_URL ?>LoginPage.php" class="btn btn-primary">Sign In</a>   
                    <?php endif ?>
                    <li><a class="pop" href="Dashboard.php">
                        <i class="i fa-solid fa-table-list"></i>
                        <span class="nav-item">Dashboard</span></a></li>
                    <li><a class="pop" href="manage_users.php">
                        <i class="i fa-solid fa-users"></i>
                        <span class="nav-item">Manage Users</span></a></li>
                    <li><a class="pop" href="manage_rooms.php">
                        <i class="i fa-regular fa-file-lines"></i>
                        <span class="nav-item">Manage Rooms</span></a></li>
                    <li><a class="pop" href="manage_topics.php">
                        <i class="i fa-solid fa-list-ul"></i>
                        <span class="nav-item">Manage Topics</span></a></li>

                    <li><a class="pop" href="<?= ROOT_URL ?>index.php">
                        <i class="i fas fa-home"></i>
                        <span class="nav-item">Homepage</span></a></li>

                    <li><a href="<?= ROOT_URL ?>user_logout.php" class="logout">
                        <i class="i fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log Out</span></a></li>
                </ul>
            </nav>

            <div id="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
        </div>
                    