<?php
include('config/AutoloadClass.php');

$obj = new JobActionClass();

if (isset($_REQUEST['submit_job'])) {
    $data = $obj->create($_REQUEST);
} elseif (isset($_REQUEST['update_job'])) {
    $data = $obj->updateData($_REQUEST);
} else {
    header("location:index.php");
}
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
            <div class="post-button">
            <a href="edit_post.php?id=<?php echo $data['data']['id'] ?>"><button class="submit-btn">EDIT POST</button></a>
            <?php if(isset($_SESSION['admin'])){ ?>
                <a href="publish.php?id=<?php echo $data['data']['id'] ?>"><button class="submit-btn">PUBLISH POST</button></a>
                <?php }else{ ?>
                    <a href="login.php"><button class="submit-btn">PUBLISH POST</button></a>
            <?php } ?>
            </div>            
            <div class="jobdes">
                <div class="imgsection">
                    <img width="180px" height="115px" src="../upload_images/<?php echo $data['data']['image'] ?>" alt="Job Banner">
                </div>
                <div class="contentsection">
                    <h3><?php echo $data['data']['job_title'] ?></h3>
                    <p><b>Posted By -</b> <?php echo $data['data']['name'] ?></p>
                    <p><b>Posted On -</b> <?php echo date('d-m-Y',strtotime($data['data']['posted_on'])) ?> &nbsp&nbsp&nbsp&nbsp<b>Location -</b> <?php echo $data['data']['location'] ?></p>
                    <p><b>Contact Email -</b> <?php echo $data['data']['email'] ?></p>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>