<?php
include "config/AutoloadClass.php";
if(!isset($_GET['id'])){
    header("location:index.php");
}else{
    $obj = new JobActionClass();
    $data = $obj->showUpdate($_GET['id']);
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
                    <img src="Sliced/jobstake-logo" alt="App Logo">
                </div>
                <div class="post-a-job-section">
                    <a href="index.php"><button class="btn">Back</button></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="post-job-container">
                <form class="form-css" action="preview_post.php" method="post" enctype="multipart/form-data">
                    <h2 class="title">POST A JOB</h2>
                    <input type="hidden" name="id" value="<?php echo $data['data']['id'] ?>">
                    <input type="hidden" name="publish" value="<?php echo $data['data']['publish'] ?>">
                    <label for="name">Name</label><br>
                    <input class="input-box" value="<?php echo $data['data']['name'] ?>" type="text" name="name" required id="name"><br><br>

                    <label for="email">Email</label><br>
                    <input class="input-box" value="<?php echo $data['data']['email'] ?>" type="text" name="email" required id="email"><br><br>

                    <label for="location">Location</label><br>
                    <input class="input-box" value="<?php echo $data['data']['location'] ?>" type="text" name="location" required id="location"><br><br>

                    <label for="job_title">Job Title</label><br>
                    <textarea class="textarea"name="job_title" id="job_title" required cols="37" rows="4"><?php echo $data['data']['job_title'] ?></textarea><br><br>
                    
                    <input class="file-upload" name="image" required type="file"><br><br>

                    <input class="submit-btn" type="submit" value="PREVIEW POST" name="update_job" id="">
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<?php
}
?>