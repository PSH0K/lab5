<?php
    $con = mysqli_connect("localhost","root","root","PashaBD");
    if (mysqli_connect_errno()){
        echo "Ошибка в подключении БД: " . mysqli_connect_error();
    }
?>
