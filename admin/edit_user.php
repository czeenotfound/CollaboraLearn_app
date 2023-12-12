<?php
    include 'templates/header.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM baseapp_users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'admin/manage_users.php');
    }
?>
        <section class="main">
            <div class="main-header">
                <h1>Edit User</h1>
            </div>
            <section class="main-course">
                <div class="course-box">
                    <div class="course">
                        <div class="form__group">
                            <?php if (isset($_SESSION ['edit_user'])): ?>
                            <div class="messages">
                                <ul>
                                    <li>
                                        <p>
                                            <?= $_SESSION['edit_user'];
                                            unset($_SESSION['edit_user']);
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?>
                            <form action="<?= ROOT_URL ?>admin/edit-user-method.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" placeholder="First Name" value="<?= $user['first_name'] ?>">
                                
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" placeholder="Last Name" value="<?= $user['last_name'] ?>" >
                                
                                <label for="topic">Avatar</label>
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
                                
                                <label for="user_role">User Role</label>
                                <select name="user_role" id="user_role">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary" name="submit" target="_self"><a>Edit User</a></button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>