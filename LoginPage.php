<?php
    require 'config1/constants.php';

    $username_email = $_SESSION['login-data']['username_email'] ?? null;
    $password = $_SESSION['login-data']['password'] ?? null;

    unset($_SESSION['login-data']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CollaboraLearn | Log in or Sign up</title>
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
                    <!-- <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                   HELLLOOOO
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="messages">
                        <ul>
                            <li>
                                <p>
                                dwdw
                                </p>
                            </li>
                        </ul>
                    </div> -->
                    <?php if (isset($_SESSION ['user_register-success'])): ?>
                        <div class="success-messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= $_SESSION['user_register-success'];
                                        unset($_SESSION['user_register-success']);
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php elseif(isset($_SESSION ['LoginPage'])): ?>
                        <div class="messages">
                            <ul>
                                <li>
                                    <p>
                                    <?= $_SESSION['LoginPage'];
                                        unset($_SESSION['LoginPage']);
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                    <form action="<?= ROOT_URL ?>user_login.php" method="POST">
                        <input name="username_email" type="text" placeholder="Username or Email" value="<?= $username_email ?>">
                        <input name="password" type="password" placeholder="Password" value="<?= $password ?>">
                        <button type="submit" name="submit" class="btn-login login">Login</button>
                    </form>
                    <a class="forgotpass" href="<?= ROOT_URL ?>user_forgot.php">Forgot Password?</a><hr/>
                    <span>Don't have an account?<a id="signup" href="SignupPage.php" target="_self"> SIGN UP</a></span> 
                </div>
            </div>
        </div>
    </body>
</html>