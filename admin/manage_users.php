<?php
    include 'templates/header.php';

    $current_admin_id = $_SESSION['user-id'];

    $query = "SELECT * FROM baseapp_users WHERE NOT id=$current_admin_id";
    $users = mysqli_query($connection, $query);
?>

        <section class="main">
            <div class="main-header">
                <h1>Manage Users</h1>
                <button><a class="btn btn-primary" href="add_user.php"><i class="fa-solid fa-plus"> </i> Add User</a></button>
            </div>
            <br/>
            <section class="main-course">
                <?php if (isset($_SESSION ['edit-user-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['edit-user-success'];
                                    unset($_SESSION['edit-user-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_SESSION ['add-user-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['add-user-success'];
                                    unset($_SESSION['add-user-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_SESSION ['delete-user-success'])): ?>
                    <div class="success-messages">
                        <ul>
                            <li>
                                <p>
                                    <?= $_SESSION['delete-user-success'];
                                    unset($_SESSION['delete-user-success']);
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
                <!-- <div class="success-messages">
                    <ul>
                        <li>
                            <p>
                                HELLOOOO
                            </p>
                        </li>
                    </ul>
                </div> -->
                <?php if (mysqli_num_rows($users) > 0): ?>
                <div class="course-box">
                    
                    <div class="course">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Admin/User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                                <tr>
                                    <td> <?= $user['first_name']; ?><?= $user['last_name']; ?></td>
                                    <td> <?= $user['username']; ?></td>
                                    <td class = "actions"><a href="<?= ROOT_URL ?>admin/edit_user.php?id=<?= $user['id'] ?>" class="btn btn-primary">Edit</a></td>
                                    <td class = "actions"><a href="<?= ROOT_URL ?>admin/delete_user.php?id=<?= $user['id'] ?>" class="btn btn-delete">Delete</a></td>
                                    <td><?= $user['is_admin'] ? 'YES' : 'NO' ?></td>
                                </tr>
                                <!-- Add more rows as needed -->
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else : ?>
                    <div class="form__group">
                        <div class="messages">
                            <ul>
                                <li>
                                    <p>
                                        <?= "No users found" ?>
                                    </p>
                                </li>
                            </ul>
                        </div>  
                    </div>
                <?php endif ?>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>