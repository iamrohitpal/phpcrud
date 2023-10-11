<?php
include('config/AutoloadClass.php');

if (isset($_GET['id'])) {
    $obj = new JobActionClass();
    $obj->changeStatusPublish($_GET['id']);
    header("location:dashboard.php");
} else {
    header("location:index.php");
}
