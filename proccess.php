<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:login.php?login=error1");
}
?>

<!doctype html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>save data</title>
</head>
<body>
<?php
/**
 * Copyright (c) 2019. this code by heart from hashem sheikhypour
 * Do your Best ...
 */


include_once ('functions.php');
include_once ('config.php');


$data=$_POST['frm'];
$name=rand();
$dir="image/";
$file="image";
$to=uploaderimg($name,$dir,$file);

$conn=mysqli_connect($server,$userdb,$password,$dbname);
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET character_set_connection = 'utf8'");
if ($conn){
    echo "success<br>";
    $sql = "INSERT INTO `users` (`firstname`, `lastname`, `age`, `field`, `image`, `comment`) VALUES ('$data[name]', '$data[lname]', '$data[age]', '$data[field]', '$to', '$data[comment]')";
    mysqli_query($conn,$sql);
    echo "data saved !";
}else{
    die(mysqli_connect_error());
}

header("location:index.php?add=ok");
?>
</body>
</html>