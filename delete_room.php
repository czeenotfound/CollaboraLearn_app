<?php
    include 'templates/header.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM baseapp_rooms WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $room = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'admin/manage_users.php');
    }
?>
    <div id="delete-modal" class="deletemodal">
        <div class="modal-content">
            <div class="logoClosure">
                <i class="fa-regular fa-trash-can deletelogo"></i>
            </div>
            <p>Are you sure you want to delete this room?</p><hr>
            <div class="delete__action">
                <button><a class="btn btn-dark" href="index.php" id="cancel-edit">Cancel</a></button>
                <button><a class="btn btn-danger" href="<?= ROOT_URL ?>delete-room-method.php?id=<?= $room['id'] ?>">Delete</a></button>
            </div>
        </div>
    </div> 