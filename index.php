<!doctype html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فرم پشتیبانی </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center m-auto">ارسال تیکت جدید </h2>
    </div>
    <?php
    if (isset($_GET['add'])) {
        ?>
        <div class="row justify-content-md-center">
            <div class="alert alert-success" role="alert">
                کاربر مورد نظر به لیست اضافه شد
            </div>
        </div>
        <?php
    }elseif (isset($_GET['login'])){?>
        <div class="row justify-content-md-center">
            <div class="alert alert-success" role="alert">
                شما خارج شدید
            </div>
        </div>
    <?php    } ?>
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <form action="proccess.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">نام :</label>
                    <input type="text" class="form-control" id="name" placeholder="نام شما ؟" name="frm[name]">
                </div>
                <div class="form-group">
                    <label for="lastname">نام خانوادگی :</label>
                    <input type="text" class="form-control" id="lastname" placeholder="نام خانوادگی شما ؟" name="frm[lname]">
                </div>
                <div class="form-group">
                    <label for="age">سن :</label>
                    <input type="text" class="form-control" id="age" placeholder="سن شما ؟" name="frm[age]">
                </div>
                <div class="form-group">
                    <label for="Select1">مربوط به :</label>
                    <select class="form-control" id="Select1" name="frm[field]">
                        <option value="پشتیبانی">پشتیبانی</option>
                        <option value="امور مالی">امور مالی</option>
                        <option value="مدیریت">مدیریت</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="files">عکس : </label>
                    <input type="file" class="form-control-file" id="files" name="image">
                </div>
                <div class="form-group">
                    <label for="Textarea">متن تیکت :</label>
                    <textarea class="form-control" id="Textarea" rows="3" placeholder="سوال شما ..." name="frm[comment]"></textarea>
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6 mb-5">
            <a href="login.php" class="btn btn-success">ورود مدیریت</a>
            <a href="ticket-list.php" class="btn btn-danger">لیست تیکت ها</a>
        </div>
    </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>