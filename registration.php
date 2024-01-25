<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Регистрация</title>
</head>
<body>
<?php
    require('db.php');
    
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $confirm_password = stripslashes($_REQUEST['confirm_password']);
        $confirm_password = mysqli_real_escape_string($con, $confirm_password);
        
        if ($password != $confirm_password) {
            echo "<div class='form'>
                  <h3>Пароли не совпадают.</h3><br/>
                  <p class='link'><a href='registration.php'>Повторить</a></p>
                  </div>";
        } else {
            $query = "INSERT into `users` (username, password)
                      VALUES ('$username', '" . md5($password) . "')";
            $result = mysqli_query($con, $query);
            
            if ($result) {
                echo "<div class='form'>
                      <h3>Аккаунт создан.</h3><br/>
                      <p class='link'><a href='login.php'>Вход</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Ошибка</h3><br/>
                      <p class='link'><a href='registration.php'>Повторить</a></p>
                      </div>";
            }
        }
    } else {
?>
    <div class="container">
        <form id="loginForm" method="post" action="">
            <h2>Регистрация</h2>
            <label for="username">Имя пользователя:</label>
            <input type="text" class="login-input" name="username" autofocus="true"/>
            <label for="password">Пароль:</label>
            <input type="password" class="login-input" name="password"/>
            <label for="confirm_password">Подтверждение пароля:</label>
            <input type="password" class="login-input" name="confirm_password"/>
            <input type="submit" name="submit"  value="Создать" class="login-button">
            <p class="link"><a href="login.php">Есть аккаунт?</a></p>
        </form>
    </div>
<?php
    }
?>
</body>
</html>
