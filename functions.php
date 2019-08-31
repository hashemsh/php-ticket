<?php

/**
 * Copyright (c) 2019. this code by heart from hashem sheikhypour
 * Do your Best ...
 */
session_start();
if (!isset($_SESSION['name'])) {
    header("location:login.php?login=error1");
}

function uploaderimg($name,$dir,$file){
    if(!file_exists($dir.$name)){
        mkdir($dir.$name);
        echo "make file successfully<br>";
    }else{
        echo "file is done before but image save !<br> ";
    }
    $picname=$_FILES[$file]['name'];
    $array=explode(".",$picname);
    $ext=end($array);
    $newname=rand().".".$ext;
    $from=$_FILES[$file]['tmp_name'];
    $to=$dir.$name."/".$newname;
    move_uploaded_file($from,$to);

    return $to;
}