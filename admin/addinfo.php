<?php
require("../include/db_connect.php");
require("../include/db.php");


if (isset($_POST['add_sneaker'])) {
    $id = $_POST['sneak_id'];
    $brand = $_POST['brand'];
    $name = $_POST['name'];
    $photo = $_POST['photo'];
    $cost = $_POST['cost'];
    $size = $_POST['size'];
    $new = $_POST['new'];
    $sql = "INSERT INTO `sneakers` (`sneaker_id`, `sneaker_brand`, `sneaker_name`, `sneaker_photo`, `sneaker_price`, `sneaker_size`, `sneaker_new`) VALUES ('$id', '$brand', '$name', '$photo',
     '$cost', '$size', '$new')";

    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo'<div style="color="green";">Кроссовки добавлены</div>';
    }else{
        echo'<div style="color="red";">Кроссовки не добавлены</div>';
    }
}
if (isset($_POST['add_rate'])) {
    $id = $_POST['sneak_id'];
    $assesmt = $_POST['assessment'];
    $sql = "INSERT INTO `rating` (`rating_id`, `sneaker_id`, `rating_assessment`) VALUES (NULL, '$id', '$assesmt')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo'<div style="color="green";">Рейтинг добавлен</div>';
    }else{
        echo'<div style="color="red";">Рейтинг не добавлен</div>';
    }
}
if (isset($_POST['add_comment'])) {
    $id = $_POST['sneak_id'];
    $cmttxt = $_POST['comment_text'];
    $name = $_POST['username'];
    $assesmt = $_POST['assessment'];
    $sql = "INSERT INTO `comments` (`comment_id`, `sneakers_id`, `comment_text`, `user_name`, `user_mark`) VALUES (NULL, '$id', '$cmttxt', '$name', '$assesmt')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo'<div style="color="green";">Комментарий добавлен</div>';
    }else{
        echo'<div style="color="red";">Комментарий не добавлен</div>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление информации</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/filters.css">
</head>

<body>
    <div class="adding">
        <a href="../index.php">На главную</a>
        <div class="add_some">
            <h1>Добавить кроссовки</h1>
            <form id="add" action="addinfo.php" method="POST">
                <input id="sneak_id" type="text" name="sneak_id">
                <label for="sneak_id">ID Кроссовок</label>
                <br>
                <input id="brand" type="text" name="brand">
                <label for="brand">Бренд</label>
                <br>
                <input id="name" type="text" name="name">
                <label for="name">Название</label>
                <br>
                <input id="photo" type="text" name="photo">
                <label for="photo">Фото</label>
                <br>
                <input id="cost" type="text" name="cost">
                <label for="cost">Цена</label>
                <br>
                <input id="size" type="text" name="size">
                <label for="size">Размер</label>
                <br>
                <input id="new" type="text" name="new">
                <label for="new">Новинка?</label>
                <br>
                <button type="submit" name="add_sneaker" class="action-button">Добавить</button>
            </form>
        </div>
        <div class="add_some">
            <h1>Добавить рейтинг</h1>
            <form id="add" action="addinfo.php" method="POST">
                <input id="sneak_id" type="text" name="sneak_id">
                <label for="sneak_id">ID Кроссовок</label>
                <br>
                <input id="assessment" type="text" name="assessment">
                <label for="assessment">Оценка</label>
                <br>
                <button type="submit" name="add_rate" class="action-button">Добавить</button>
            </form>
        </div>
        <div class="add_some">
            <h1>Добавить комментарий</h1>
            <form id="add" action="addinfo.php" method="POST">
                <input id="sneak_id" type="text" name="sneak_id">
                <label for="sneak_id">ID Кроссовок</label>
                <br>
                <input id="comment_text" type="text" name="comment_text">
                <label for="comment_text">Текст</label>
                <br>
                <input id="username" type="text" name="username">
                <label for="username">Имя пользователя</label>
                <br>
                <input id="assessment" type="text" name="assessment">
                <label for="assessment">Оценка</label>
                <br>
                <button type="submit" name="add_comment" class="action-button">Добавить</button>
            </form>
        </div>
    </div>
</body>

</html>