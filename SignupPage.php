<?php
    require 'config1/constants.php';

    $first_name = $_SESSION['signup-data']['first_name'] ?? null;
    $last_name = $_SESSION['signup-data']['last_name'] ?? null;
    $username = $_SESSION['signup-data']['username'] ?? null;
    $email = $_SESSION['signup-data']['email'] ?? null;
    $createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
    $confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

    unset($_SESSION['signup-data']);
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
                    <a href="LoginPage.php"><img src="./images/icons8-study-96.png" width="60px"/>
                    <img src="./images/2_collaboraLearnName.png" width="300px"/></a>
                    <h3 class="quote">Help students find like-minded peers to study with, fostering a collaborative learning environment.</h3>
                </div>
               
                <div class="login-container">
                    <?php if (isset($_SESSION ['SignupPage'])): ?>
                        <div class="messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= $_SESSION['SignupPage'];
                                        unset($_SESSION['SignupPage']);
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                    
                    <form action="<?= ROOT_URL ?>user_register.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="first_name" placeholder="First Name" value="<?= $first_name ?>">
                        <input type="text" name="last_name" placeholder="Last Name" value="<?= $last_name ?>">
                        <input type="text" name="username" placeholder="Username" value="<?= $username ?>">
                        <input type="email" name="email" placeholder="Email" value="<?= $email ?>">
                        <input type="password" name="createpassword" placeholder="Create Password" value="<?= $createpassword ?>">
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?= $confirmpassword ?>">
                        <button type="submit" class="btn-login login" name="submit" target="_self"><a>Sign up</a></button><hr/>
                    
                    </form>
                    <span>Already have an account?<a id="signup" href="LoginPage.php" target="_self"> LOGIN</a></span> 
                </div>
            </div>
        </div>
    </body>
</html>