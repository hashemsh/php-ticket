<?php

include_once ('config.php');
include_once ('functions.php');


$id=$_GET['id'];
$conn=mysqli_connect($server,$userdb,$password,$dbname);
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET character_set_connection = 'utf8'");
$sql1="SELECT * FROM `users` WHERE `id`= $id ";
$result=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result);

if (isset($_POST['btn'])){
    $data=$_POST['frm'];
    if ($_FILES['image']['name']){
        //del last image
        $arraynew=explode("/",$row['image']);
        $ext=end($arraynew);
        $file=$row['image'];
        $tmpfolder=count($arraynew)-2;
        $folder="image/".$arraynew[$tmpfolder];
        unlink($file);
        rmdir($folder);
        //new image
        $name=rand();
        $dir="image/";
        $file="image";
        $to=uploaderimg($name,$dir,$file);
    }else{
        $to=$row['image'];
    }
    $sql=" UPDATE users SET firstname = '$data[name]',lastname = '$data[lname]',age = '$data[age]',field = '$data[field]',comment = '$data[comment]',image='$to' WHERE `users`.`id` = '$id'";
    mysqli_query($conn,$sql);
    header("Location: edit.php?id=".$id."&edit=ok");
}
?>

<!doctype html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فرم ویرایش </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center m-auto">ویرایش اطلاعات </h2>
    </div>
    <?php
    if (isset($_GET['edit'])) {
        ?>
        <div class="row justify-content-md-center">
            <div class="alert alert-success" role="alert">
                اطلاعات کاربر مورد نظر ویرایش شد
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">نام :</label>
                    <input type="text" class="form-control" id="name" placeholder="نام شما ؟" name="frm[name]" value="<?php echo $row['firstname']; ?>">
                </div>
                <div class="form-group">
                    <label for="lastname">نام خانوادگی :</label>
                    <input type="text" class="form-control" id="lastname" placeholder="نام خانوادگی شما ؟" name="frm[lname]" value="<?php echo $row['lastname']; ?>">
                </div>
                <div class="form-group">
                    <label for="age">سن :</label>
                    <input type="text" class="form-control" id="age" placeholder="سن شما ؟" name="frm[age]" value="<?php echo $row['age']; ?>">
                </div>
                <div class="form-group">
                    <label for="Select1">مربوط به :</label>
                    <select class="form-control" id="Select1" name="frm[field]">
                        <option value="پشتیبانی" <?php if($row['field']=="پشتیبانی"){echo "selected";} ?> >پشتیبانی</option>
                        <option value="امور مالی" <?php if($row['field']=="امور مالی"){echo "selected";} ?> >امور مالی</option>
                        <option value="مدیریت" <?php if($row['field']=="مدیریت"){echo "selected";} ?> >مدیریت</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="files">عکس : </label>
                    <input type="file" class="form-control-file" id="files" name="image">
                    <img class="w-25 mx-auto d-block mt-3 mb-3" src="<?php echo $row['image']; ?>">
                </div>
                <div class="form-group">
                    <label for="Textarea">متن تیکت :</label>
                    <textarea class="form-control" id="Textarea" rows="3" placeholder="سوال شما ..." name="frm[comment]" ><?php echo $row['comment']; ?></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="btn" id="btn">ثبت تغییرات</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <a href="ticket-list.php" class="btn btn-danger mb-5">لیست تیکت ها</a>
        </div>
    </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
<!--done : check file for edit and del last file and insert new one-->
</html>

