<?php
include "config/AutoloadClass.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}else{
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
                    <a href="logout.php"><button class="btn">Logout</button></a>
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
            <div class="publish-div">
                <h4 class="headline-title">UNPUBLISHED POSTS</h4>
            </div>
            <div class="jobcontainer">
                <?php 
                    foreach ($allData['data'] as $value) {
                        if ($value['publish'] == 0) {
                ?>
                <div>
                    <div class="jobdes">
                        <div class="imgsection">
                            <img width="180px" height="115px" src="../upload_images/<?php echo $value[5] ?>" alt="Job Banner">
                        </div>
                        <div class="contentsection">
                            <h3><?php echo $value[4] ?></h3>
                            <p><b>Posted By -</b> <?php echo $value[1] ?></p>
                            <p><b>Posted On -</b> <?php echo date('d-m-Y',strtotime($value[7])) ?> &nbsp&nbsp&nbsp&nbsp<b>Location -</b> <?php echo $value[3] ?></p>
                            <p><b>Contact Email -</b> <?php echo $value[2] ?></p>
                        </div>
                    </div>
                    <div class="post-button1">
                    <a href="edit_post.php?id=<?php echo $value[0] ?>"><button class="submit-btn">EDIT POST</button></a>
                    <a href="publish.php?id=<?php echo $value[0] ?>"><button class="submit-btn">PUBLISH POST</button></a>
                    </div>
                </div>
                <?php }} ?>
            </div>

            <div class="publish-div">
                <h4 class="headline-title">PUBLISHED POSTS</h4>
            </div>
            <div class="jobcontainer">
                <?php 
                    foreach ($allData['data'] as $value) {
                        if ($value['publish'] == 1) {
                ?>
                <div>
                    <div class="jobdes">
                        <div class="imgsection">
                            <img width="180px" height="115px" src="../upload_images/<?php echo $value[5] ?>" alt="Job Banner">
                        </div>
                        <div class="contentsection">
                            <h3><?php echo $value[4] ?></h3>
                            <p><b>Posted By -</b> <?php echo $value[1] ?></p>
                            <p><b>Posted On -</b> <?php echo date('d-m-Y',strtotime($value[7])) ?> &nbsp&nbsp&nbsp&nbsp<b>Location -</b> <?php echo $value[3] ?></p>
                            <p><b>Contact Email -</b> <?php echo $value[2] ?></p>
                        </div>
                    </div>
                    <div class="post-button1">
                    <a href="edit_post.php?id=<?php echo $value[0] ?>"><button class="submit-btn">EDIT POST</button></a>
                    <a href="unpublish.php?id=<?php echo $value[0] ?>"><button class="submit-btn">UNPUBLISH POST</button></a>
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
<?php
}
?>