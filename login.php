<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Вход</title>
</head>
<?php
require('db.php');
    session_start();
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Неверные данные.</h3><br/>
                  <p class='link'><a href='login.php'>Повторить попытку</a></p>
                  </div>";
        }
    } else {
?>
<body>
    <div class="container">
        <form id="registerForm" method="post" name="login">
            <h2>Вход</h2>            
            <label for="username">Имя пользователя:</label>
            <input type="text" class="login-input" name="username" autofocus="true"/>
            <label for="password">Пароль:</label>
            <input type="password" class="login-input" name="password"/>
            <input type="submit"  name="submit" value="Вход" class="login-button">
            <p class="link"> <a href="registration.php">Создать аккаунт</a></p>
        </form>
    </div>
</body>
<?php
}
?>
</html>
