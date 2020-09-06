<?php
require("db_connect.php");
require("db.php");
if (isset($_POST['rated'])) {
    if ($_POST['comment'] != "") {
        if (isset($_POST['rate']) && isset($_POST['sneaker_id'])) {
            $sneak_id = $_POST['sneaker_id'];
            $rate = $_POST['rate'];
            $comment_text = $_POST['comment'];
            $user_name = $_SESSION['logged_user']->first_name;

            $sql1 = "INSERT INTO `rating` (`rating_id`, `sneaker_id`, `rating_assessment`) VALUES (NULL, '$sneak_id', '$rate')";
            $result1 = mysqli_query($link, $sql1) or die("Ошибка " . mysqli_error($link));
            
            $sql2 = "INSERT INTO `comments` (`comment_id`, `sneakers_id`, `comment_text`, `user_name`, `user_mark`) VALUES (NULL, '$sneak_id', '$comment_text', '$user_name', '$rate')";
            $result2 = mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

            if ($result1 && $result2) {
                header("Location: ../sneakers.php?page=1&brand=".$_SESSION['brand']."&sort=".$_SESSION['sort']."");
            } else {
                echo '<script>alert("Давай по новой миша, всё херня")</script>';
            }
            
        }
    } 
    else {

        if (isset($_POST['rate']) && isset($_POST['sneaker_id'])) {
            $sneak_id = $_POST['sneaker_id'];
            $rate = $_POST['rate'];
            $sql = "INSERT INTO `rating` (`rating_id`, `sneaker_id`, `rating_assessment`) VALUES (NULL, '$sneak_id', '$rate')";
            $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
            if ($result) {
                header("Location: ../sneakers.php?page=1&brand=".$_SESSION['brand']."&sort=".$_SESSION['sort']."");
            } else {
                echo '<script>alert("Давай по новой миша, всё херня")</script>';
            }
        }
    }
}
?>
