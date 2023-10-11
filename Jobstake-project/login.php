<?php
include('config/AutoloadClass.php');

$obj = new LoginClass();
$obj->userAuthentication($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>JOBSTAKE</title>
</head>
<body>
    <div class="container-full">
        <!-- here menu section  -->
        <div class="header">
            <div class="hcontainer">
                <div class="logosection">
                    <a href="index.php"><img src="Sliced/jobstake-logo" alt="App Logo"></a>
                </div>
                <div class="post-a-job-section">
                    <a href="index.php"><button class="btn">Back</button></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="post-job-container">
                <form action="" method="post">
                    <h2 class="title">Admin Login</h2>
                    <?php if(isset($_REQUEST['msg'])) echo "<p style='color:red'>Enter Correct Email and Password</p>" ?>
                    <label for="email">Email</label><br>
                    <input class="input-box" type="text" value="admin@webkul.in" name="email" id="email"><br><br>

                    <label for="password">Password</label><br>
                    <input class="input-box" type="text" value="webkul" name="password" id="password"><br><br>

                    <input class="submit-btn" type="submit" value="LOGIN NOW" name="submit" id="">
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>