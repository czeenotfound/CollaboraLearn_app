<?php
    include 'templates/header.php';

    $usersCount = getCount($connection, 'baseapp_users');
    $roomsCount = getCount($connection, 'baseapp_rooms');
    $topicsCount = getCount($connection, 'baseapp_topics');

    function getCount($connection, $tableName){
        $query = "SELECT COUNT(*) AS count FROM $tableName";
        $result = $connection->query($query);

        if($result && $result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            return $row['count'];
        } else{
            return 0;
        }
        
    }
    
?>

        <section class="main">
            <div class="main-header">
                <h1>Dashboard</h1>
            </div>

            <section class="main-course">
                <div class="course-box">
                    <div class="course">
                        <div class="box">
                            <h3>Users</h3>
                            <h2><?php echo $usersCount; ?></h2>
                            <button><a class="btn btn-dark" href="manage_users.php">Manage Users</a></button>
                        </div>
                        <div class="box">
                            <h3>Rooms</h3>
                            <h2><?php echo $roomsCount; ?></h2>
                            <button><a class="btn btn-dark" href="manage_rooms.php">Manage Rooms</a></button>
                        </div>
                        <div class="box">
                            <h3>Topics</h3>
                            <h2><?php echo $topicsCount; ?></h2>
                            <button><a class="btn btn-dark" href="manage_topics.php">Manage Topics</a></button>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <script src="Static/JS/dashboard.js"></script>
    </body>
</html>