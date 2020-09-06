<?php
require("include/db.php");
?>

<?php
if (isset($_POST['create'])) {
    header("Location: signup.php");
}
if (isset($_POST['index'])) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($_POST['login']));
    if ($user) {
        if (password_verify($_POST['pass'], $user->password)) {
            $_SESSION['logged_user'] = $user;
            header("Location: index.php");
        } else {
            $errors[] = 'Вы ввели не верный пароль!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден!';
    }
}



if (!empty($errors)) {
    echo '<script> alert("' . array_shift($errors) . '");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в личный кабинет - TraceShop</title>
    <link rel="stylesheet" href="styles/register.css">
</head>

<body>
    <img src="images/logo.png" alt="" width="200" style="position: absolute; top:2%; left:2%">
    <form id="msform" action="login.php" method="POST" style="margin-top: 15vw">
        <fieldset>
            <h2 class="fs-title" style="margin-top: 1vw;">Войдите в свой профиль</h2>
            <h3 class="fs-subtitle">Новые кроссовки уже совсем рядом</h3>
            <input type="text" name="login" placeholder="Логин" value="<?php echo @$_POST['login']; ?>" />
            <input type="password" name="pass" placeholder="Пароль" />
            <button name="forgot" class="action-button">Забыл пароль</button>
            <button type="submit" name="create" class="action-button">Регистрация</button>
            <button type="submit" name="submit" class="action-button">Войти</button>
            <button type="submit" name="index" class="action-button">На главную</button>
        </fieldset>
    </form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/register.js"></script>

</html>