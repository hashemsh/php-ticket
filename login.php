<?php
include_once ('config.php');
session_start();
$conn=mysqli_connect($server,$userdb,$password,$dbname);
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET character_set_connection = 'utf8'");
if (!$conn){
    die(mysqli_connect_error());
}
//check cookie
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $sqlcookie="SELECT * FROM `auth` WHERE username = '$_COOKIE[username]'";
    $result1=mysqli_query($conn,$sqlcookie);
    $row1=mysqli_fetch_assoc($result1);
    if ($row1['password']==sha1($_COOKIE['password'])){
        $_SESSION['name']=$row1['name'];
        header("Location: ticket-list.php?login=true");
    }else{
        header("Location: login.php?login=false");
    }
}
// login btn set
if (isset($_POST['btn'])){
    $data=$_POST['frm'];
    $sql="SELECT * FROM `auth` WHERE username = '$data[username]'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $userwd=$data['username'];
    $passwd=$data['password'];
    // remember check
    if (isset($data['remember'])){
        setcookie('username',$userwd,time()+86400); //cookie for 1 day
        setcookie('password',$passwd,time()+86400);
    }
    if ($row['password']==sha1($data['password'])){
        $_SESSION['name']=$row['name'];
        header("Location: ticket-list.php?login=true");
    }else{
        header("Location: login.php?login=false");
    }
}
?>

<!doctype html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فرم ورود </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center m-auto">فرم ورود </h2>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <form method="post">
                <div class="form-group">
                    <label for="name">نام کاربری :</label>
                    <input type="text" class="form-control" id="name" placeholder="نام کاربری خود را وارد کنید " name="frm[username]">
                </div>
                <div class="form-group">
                    <label for="pass">پسورد :</label>
                    <input type="password" class="form-control" id="pass" placeholder="پسورد خود را وارد کنید" name="frm[password]">
                </div>
                <div class="form-group text-right">
                    <input type="checkbox" name="frm[remember]" class="ml-2">مرا به خاطر بسپار
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="btn">ورود</button>
                    <a href="index.php" class="btn btn-secondary">صفحه اصلی</a>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_GET['login']) && $_GET['login']=="false") {
        ?>
        <div class="row justify-content-md-center">
            <div class="alert alert-danger" role="alert">
               نام کاربری یا پسورد اشتباه میباشد
            </div>
        </div>
        <?php
    }elseif(isset($_GET['login']) && $_GET['login']=="error1"){?>
    <div class="row justify-content-md-center">
        <div class="alert alert-danger" role="alert">
            باید ابتدا وارد شوید
        </div>
    </div>
        <?php
    }
    ?>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>