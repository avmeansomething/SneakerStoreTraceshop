<?php

$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'traceshop';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database);

mysqli_select_db($link, $db_database) or die("Нет соединения с БД ".mysqli_error($link));
mysqli_query($link, "SET name utf-8");
?>
