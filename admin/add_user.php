<?php
    include 'templates/header.php';
    
    $first_name = $_SESSION['add_user']['first_name'] ?? null;
    $last_name = $_SESSION['add_user']['last_name'] ?? null;
    $username = $_SESSION['add_user']['username'] ?? null;
    $email = $_SESSION['add_user']['email'] ?? null;
    $createpassword = $_SESSION['add_user']['createpassword'] ?? null;
    $confirmpassword = $_SESSION['add_user']['confirmpassword'] ?? null;
    $is_admin = $_SESSION ['add_user']['user_role'] ?? null;

    unset($_SESSION['add_user_data']);
?>
        <section class="main">
            <div class="main-header">
                <h1>Add User</h1>
            </div>
            <section class="main-course">
                <div class="course-box">
                    <div class="course">
                        <div class="form__group">
                            <?php if (isset($_SESSION ['add_user'])): ?>
                            <div class="messages">
                                <ul>
                                    <li>
                                        <p>
                                            <?= $_SESSION['add_user'];
                                            unset($_SESSION['add_user']);
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?>
                            <form action="<?= ROOT_URL ?>admin/add-user-method.php" method="POST" enctype="multipart/form-data">
                                <input required type="text" name="first_name" placeholder="First Name" value="<?= $first_name ?>">
                                <input required type="text" name="last_name" placeholder="Last Name" value="<?= $last_name ?>">
                                <input required type="text" name="username" placeholder="Username" value="<?= $username ?>">
                                <input required type="email" name="email" placeholder="Email" value="<?= $email ?>">
                                <input required type="password" name="createpassword" placeholder="Create Password" value="<?= $createpassword ?>">
                                <input required type="password" name="confirmpassword" placeholder="Confirm Password" value="<?= $confirmpassword ?>">
                                <input type="file" name="avatar" id="avatar">
                                <select required name="user_role" id="user_role">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary" name="submit" target="_self"><a>Create User</a></button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>