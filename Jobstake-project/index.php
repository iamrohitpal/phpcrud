<?php
include "config/AutoloadClass.php";

$obj = new JobActionClass();
$allData = $obj->showData();

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
                    <a href="login.php"><button class="btn">Admin Login</button></a>
                    <a href="post_job.php"><button class="btn">Post A Job</button></a>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- here search section -->
            <div class="searchbox">
                <div class="searchsection">
                    <input class="inputbox" name="search" placeholder="Search for job here ...." type="text" id="search-weeazer">
                    <button id="search-btn" class="searchbtn">SEARCH FOR JOBS</button>
                </div>
            </div>
            <!-- here posted jobs -->
            <div class="jobcontainer">
                <?php 
                    foreach ($allData['data'] as $value) {
                        if ($value[6] == 1) {
                ?>
                <div class="jobdes">
                    <div class="imgsection">
                        <img src="../upload_images/<?php echo $value[5] ?>" width="180px" height="115px" alt="Job Banner">
                    </div>
                    <div class="contentsection">
                        <h3><?php echo $value[4] ?></h3>
                        <p><b>Posted By -</b> <?php echo $value[1] ?></p>
                        <p><b>Posted On -</b> <?php echo date('d-m-Y',strtotime($value[7])) ?> &nbsp&nbsp&nbsp&nbsp<b>Location -</b> <?php echo $value[3] ?></p>
                        <p><b>Contact Email -</b> <?php echo $value[2] ?></p>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>