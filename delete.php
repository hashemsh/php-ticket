<?php
/**
 * Copyright (c) 2019. this code by heart from hashem sheikhypour
 * Do your Best ...
 */

session_start();
if (!isset($_SESSION['name'])) {
    header("location:login.php?login=error1");
}

include_once ('config.php');

$id=$_GET['id'];
$conn=mysqli_connect($server,$userdb,$password,$dbname);
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET character_set_connection = 'utf8'");
$sql1="SELECT * FROM `users` WHERE `id`= $id ";
$result=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result);
//save foder name and file name
$array=explode("/",$row['image']);
$ext=end($array);
$file=$row['image'];
$tmpfolder=count($array)-2;
$folder="image/".$array[$tmpfolder];
unlink($file);
rmdir($folder);
//folder deleted

$sql="DELETE FROM `users` WHERE `users`.`id` = $id";
mysqli_query($conn,$sql);
//user deleted

header("Location: ticket-list.php?del=ok");