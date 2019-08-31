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
$conn=mysqli_connect($server,$userdb,$password,$dbname);
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET character_set_connection = 'utf8'");
$sql="SELECT * FROM `users` ORDER BY id ASC";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لیست تیکت ها</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <h2 class="text-center m-auto"> لیست کل تیکت ها </h2>
        </div>
        <div class="row">
            <a href="index.php" class="btn btn-dark m-2">بازگشت</a>
            <a href="search.php" class="btn btn-secondary m-2">جستجو</a>
            <h5 class="m-2"><?php
                if (isset($_SESSION)) {
                  echo " نام مدیر :". $_SESSION['name']." <a class='btn btn-danger' href='expire.php'>خارج شوید </a>";
                }
                ?></h5>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">سن</th>
                        <th scope="col">فیلد</th>
                        <th scope="col">متن تیکت</th>
                        <th scope="col">تصویر</th>
                        <th scope="col">حذف</th>
                        <th scope="col">ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($row) {
                        do {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['age']; ?></td>
                                <td><?php echo $row['field']; ?></td>
                                <td><?php echo $row['comment']; ?></td>
                                <td><img src="<?php echo $row['image']; ?>" height="30px" alt=""></td>
                                <td><a href="delete.php?id=<?php echo $row['id']; ?>"><i class="material-icons text-danger">delete_forever</i></a></td>
                                <td><a href="edit.php?id=<?php echo $row['id']; ?>"><i class="material-icons">build</i></a></td>
                            </tr>
                            <?php
                        } while ($row = mysqli_fetch_assoc($result));
                    }else{
                        echo '<div class="alert alert-secondary" role=\"alert\">فیلدی جهت نمایش وجود ندارد </div>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if (isset($_GET['del'])) {
            ?>
            <div class="row justify-content-md-center">
                <div class="alert alert-success" role="alert">
                    ردیف مورد نظر شما با موفقیت حذف شد
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
