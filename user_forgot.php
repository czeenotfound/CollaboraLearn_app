<?php
    require 'config1/constants.php';

    $email = $_SESSION['forgot-data']['email'] ?? null;
    $old_password = $_SESSION['forgot-data']['old_password'] ?? null;
    $password = $_SESSION['forgot-data']['password'] ?? null;
    $confirm_password = $_SESSION['forgot-data']['confirm_password'] ?? null;

    unset($_SESSION['forgot-data']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CollaboraLearn | Forgot Password</title>
        <link rel="stylesheet" href="CSS/LoginPage.css"/>
        <link rel="icon" href="./images/icons8-study-96.png"/>
    </head>
    <body>
        <div class="container">
            <div class="outsideBorder">
                <div class="branding-container">
                    <a href="<?= ROOT_URL ?>LoginPage.php"><img src="./images/icons8-study-96.png" width="60px"/>
                    <img src="./images/2_collaboraLearnName.png" width="300px"/></a>
                    <h3 class="quote">Help students find like-minded peers to study with, fostering a collaborative learning environment.</h3>
                </div>
                <div class="login-container">
                    <?php if (isset($_SESSION['forgot-success'])): ?>
                        <div class="success-messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= $_SESSION['forgot-success'];
                                        unset($_SESSION['forgot-success']);
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php elseif(isset($_SESSION['forgot-error'])): ?>
                        <div class="error-messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= $_SESSION['forgot-error'];
                                        unset($_SESSION['forgot-error']);
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                    <form action="<?= ROOT_URL ?>user_forgot_process.php" method="POST">
                        <input name="email" type="text" placeholder="Email" value="<?= $email ?>">
                        <input name="old_password" type="password" placeholder="Old Password" value="<?= $old_password ?>">
                        <input name="password" type="password" placeholder="New Password" value="<?= $password ?>">
                        <input name="confirm_password" type="password" placeholder="Confirm Password" value="<?= $confirm_password ?>">
                        <button type="submit" name="submit" class="btn-login login">Reset Password</button>
                    </form>
                    <a class="forgotpass" href="<?= ROOT_URL ?>LoginPage.php">Back to Login</a><hr/>
                    <span>Remember your password? <a id="signup" href="<?= ROOT_URL ?>LoginPage.php" target="_self">Login</a></span> 
                </div>
            </div>
        </div>
    </body>
</html>
