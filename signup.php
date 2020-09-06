<?php
require("include/db.php");
?>

<?php
if (isset($_POST['account']))
    header("Location: login.php");

if (isset($_POST['index']))
    header("Location: index.php");


if (isset($_POST['submit'])) {
    $errors = array();
    if (trim($_POST['login']) == '')
        $errors[] = 'Введите логин!';

    if (($_POST['pass']) == '')
        $errors[] = 'Введите пароль!';

    if (($_POST['cpass']) != $_POST['pass'])
        $errors[] = 'Введённый повторный пароль не соответствует введённому!';

    if (($_POST['fname']) == '')
        $errors[] = 'Введите ваше Имя!';

    if (R::count('users', "login = ?", array($_POST['login'])) > 0) {
        $errors[] = 'Пользователь с таким логином уже существует!';
    }

    if (R::count('users', "email = ?", array($_POST['email'])) > 0) {
        $errors[] = 'Пользователь с такой почтой уже существует!';
    }

    if (empty($errors)) {

        $role = $_POST['admin'];
        if ($role == "sunflower") {

            $users = R::dispense('users');
            $users->login = $_POST['login'];
            $users->password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $users->first_name = $_POST['fname'];
            $users->last_name = $_POST['lname'];
            $users->phone = $_POST['phone'];
            $users->email = $_POST['email'];
            $users->role = 'администратор';
            R::store($users);
            echo '<script> alert("Admin Registered!");</script>';

            header("Location: index.php");
        } else {
            $users = R::dispense('users');
            $users->login = $_POST['login'];
            $users->password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $users->first_name = $_POST['fname'];
            $users->last_name = $_POST['lname'];
            $users->phone = $_POST['phone'];
            $users->email = $_POST['email'];
            $users->role = 'пользователь';
            R::store($users);
            echo '<script> alert("User Registered!");</script>';
            header("Location: index.php");
        }
    } else {
        echo '<script> alert("' . array_shift($errors) . '");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация нового пользователя - TraceShop</title>
    <link rel="stylesheet" href="styles/register.css">

</head>

<body>
    <!-- <img src="images/logo.png" alt="" width="200" style="position: absolute; top:2%; left:2%"> -->
    <form id="msform" action="signup.php" method="POST">
        <ul id="progressbar">
            <li class="active">Регистрация нового аккаунта</li>
            <li>Детали аккаунта</li>
        </ul>
        <fieldset>
            <h2 class="fs-title">Создайте свой профиль</h2>
            <h3 class="fs-subtitle">Первый шаг к новым кроссовкам</h3>
            <input type="text" name="login" placeholder="Логин" value="<?php echo @$_POST['login']; ?>" />
            <input type="password" name="pass" placeholder="Пароль" />
            <input type="password" name="cpass" placeholder="Повторите пароль" />
            <input type="button" name="next" class="next action-button" value="Далее" />
            <input type="submit" name="account" class="next action-button" value="Войти" />
            <input type="submit" name="index" class="next action-button" value="На главную" />
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Ваши персональные данные</h2>
            <h3 class="fs-subtitle">Мы никогда их не распространим</h3>
            <input type="text" name="fname" placeholder="Ваше имя" value="<?php echo @$_POST['fname']; ?>" />
            <input type="text" name="lname" placeholder="Фамилия" value="<?php echo @$_POST['lname']; ?>" />
            <input type="text" name="phone" placeholder="Телефон" value="<?php echo @$_POST['phone']; ?>" />
            <input type="email" name="email" placeholder="Email" value="<?php echo @$_POST['email']; ?>" />
            <input type="password" name="admin" placeholder="Привилегии администратора" />
            <input type="button" name="previous" class="previous action-button" value="Назад" />
            <button type="submit" name="submit" class="action-button">Подтвердить</button>
        </fieldset>
    </form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/register.js"></script>

</html>