<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS Link -->
    <!-- Main CSS -->
    <link rel="stylesheet" href="./CSS/settingup.css">
    <link rel="icon" href="./images/icons8-study-96.png"/>
    <!-- Icons Link -->
    <link rel="stylesheet" href="Static/fontawesomeoffline/css/all.css">
    <title>Setting Up</title>
</head>
<body>
    <main>
        <div class="setup-container">
            <div class=" outsideBorder forms">
                <div class="branding-container">
                    
                    <a href="LoginPage.html"><img src="./images/icons8-study-96.png" width="60px"/>
                    <img src="./images/2_collaboraLearnName.png" width="300px"/></a>
                    <hr>
                    <div class="setup-header">
                        <h1>Setting up your account preferences</h1>
                    </div>
                    <hr>
                    <h3 class="quote">Help students find like-minded peers to study with, fostering a collaborative learning environment.</h3>
                </div>
                <div class="form setup-content">
                    <form action="">
                        <h1>Add Avatar</h1>
                        <input type="file" name="avatar" id="avatar">

                        <h1>Study Periods</h1>
                        <input type="time">
                            
                        <h1>Learning preferences</h1> 
                        <input type="text" placeholder="Learning preference 1">
                        
                        <h1>Subjects of interest</h1> 
                        <input type="text" placeholder="Interest 1">
                        <div class="action">
                            <button class="btn" class="cancel"><a>Skip</a></button>
                            <button class="btn btn-primary"><a>Next</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- JS Script -->
    <!-- <script src="Static/JS/loginForm.js"></script> -->
</body>
</html>