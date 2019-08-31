<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:login.php?login=error1");
}
include_once ('config.php');
$temp=0;
if (isset($_POST['btn'])){
    $data=$_POST['frm'];
    $txt=$data['name'];
    $field=$data['field'];
    $conn=mysqli_connect($server,$userdb,$password,$dbname);
    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,"SET CHARACTER SET 'utf8'");
    mysqli_query($conn,"SET character_set_connection = 'utf8'");
    if (!$conn){
        die(mysqli_connect_error());
    }
    $sql="SELECT * FROM `users` WHERE $field LIKE '%$txt%' ORDER BY id ASC ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $temp=1;
}
?>

<!doctype html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>جستجو </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center m-auto">جستجو</h2>
    </div>
    <div class="row">
        <a href="ticket-list.php" class="btn btn-dark m-2">بازگشت</a>
        <a href="index.php" class="btn btn-success m-2">صفحه اصلی</a>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <form method="post">
                <div class="form-group">
                    <label for="Select1">فیلد :</label>
                    <select class="form-control" id="Select1" name="frm[field]">
                        <option value="firstname">نام</option>
                        <option value="lastname">نام خانوادگی</option>
                        <option value="age">سن</option>
                        <option value="field">بخش مربوطه</option>
                        <option value="comment">متن تیکت</option>
                    </select>
                    <label for="name" class="mt-3">مقدار :</label>
                    <input type="text" class="form-control" id="name" placeholder="رشته یا عدد" name="frm[name]">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="btn" name="btn">جستجو</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
                <div class="col-12">
                    <?php if ($temp==1){ ?>
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
                            echo '<div class="alert alert-secondary text-center" role=\"alert\">فیلدی جهت نمایش وجود ندارد </div>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>