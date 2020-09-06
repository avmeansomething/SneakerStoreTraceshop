<?php
require("include/db_connect.php");
require("include/db.php");

global $current_sort;
global $current_brand;
global $branding;
global $sorting;

$current_brand = 'all';
$current_sort = 'asc';

$page = $_GET['page'];
if (isset($_POST['rad'])) {
    $current_brand = $_POST['rad'];
    header("Location: sneakers.php?page=" . $page . "&brand=" . $current_brand . "&sort=" . $current_sort . "");
}
if (isset($_POST['rad1'])) {
    $current_sort = $_POST['rad1'];
    header("Location: sneakers.php?page=" . $page . "&brand=" . $current_brand . "&sort=" . $current_sort . "");
}
if ($_GET['brand'] != "all") {
    $branding = 'WHERE sneaker_brand = \'' . $_GET['brand'] . '\'';
}
$sorting = "order by sneaker_price ".$_GET['sort']."";
$_SESSION['br'] = $branding;
$_SESSION['so'] = $sorting;
$_SESSION['brand'] = $_GET['brand'];
$_SESSION['sort'] = $_GET['sort'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Все кроссовки - Trace Shop</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/filters.css">
</head>

<body class="preload">
    <div class="header">
        <div class="logotype">
            <a href="index.php"><img src="images/logo.png" alt=""></a>
        </div>
        <div class="navigation">
            <div class="main_navigation">
                <a href="sneakers.php?page=1&brand=Nike&sort=asc"><b>NIKE </b></a>
                <a href="sneakers.php?page=1&brand=Adidas&sort=asc"><b>ADIDAS </b></a>
                <a href="sneakers.php?page=1&brand=Puma&sort=asc"><b>PUMA </b></a>
                <a href="sneakers.php?page=1&brand=Reebok&sort=asc"><b>REEBOK </b></a>
                <a href="sneakers.php?page=1&brand=Vans&sort=asc"><b>VANS </b></a>
                <a href="sneakers.php?page=1&brand=Fila&sort=asc"><b>FILA </b></a>
            </div>
            <div class="search">
                <form action="">
                    <input type="text" name="search_bar" class="search_info" placeholder="Поиск товаров..">
                    <img src="images/search.png" alt="">
                </form>
            </div>
        </div>
        <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->role == "администратор") : ?>
            <div class="little_contacts">
                <p><b>+375 (44) 321-41-12</b></p>
                <a><b>Минск и Минская область</b></a>
                <a href="admin/addinfo.php"><b>Редактирование информации</b></a>
            </div>
        <?php else : ?>
            <div class="little_contacts">
                <p><b>+375 (44) 321-41-12</b></p>
                <a><b>Минск и Минская область</b></a>
            </div>
        <?php endif; ?>
        <div class="authorization">
            <div class="auth">
                <?php if (isset($_SESSION['logged_user'])) : ?>
                    <div class="block_auth">
                        <img src="images/-account-box_90550.png" alt="">
                        <a href="#"><b>Привет, <?php echo $_SESSION['logged_user']->first_name ?>!</b></a>
                    </div>
                    <div class="block_auth">
                        <img src="images/exit.png" alt="">
                        <a href="logout.php"><b>Выход</b></a>
                    </div>
                <?php else : ?>
                    <div class="block_auth">
                        <img src="images/-account-box_90550.png" alt="">
                        <a href="login.php"><b>Вход в кабинет</b></a>
                    </div>
                    <div class="block_auth">
                        <img src="images/signup.png" alt="">
                        <a href="signup.php"><b>Регистрация</b></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="sneak_navig">
        <p>Главная/Все кроссовки</p>
    </div>

    <?php
    $result = mysqli_query($link, "SELECT count(sneaker_id) as 'amount' from sneakers");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        do {
            echo '                                               
                <div class="sneakers_abbr">
                    <h2>ВСЕ КРОССОВКИ (' . $row['amount'] . ' товаров в каталоге)</h2>
                </div>';
        } while ($row = mysqli_fetch_array($result));
    }
    ?>
    <div class="pages">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else $page = 1;

        $kol = 6;  //количество записей для вывода
        $art = ($page * $kol) - $kol;

        $res = mysqli_query($link, "SELECT count(*) from sneakers ".$_SESSION['br']."");
        $row = mysqli_fetch_row($res);
        $total = $row[0]; // всего записей	

        global $str_pag;
        $str_pag = ceil($total / $kol);
        echo 'Страницы ';
        for ($i = 1; $i <= $str_pag; $i++) {
            echo "<a href=sneakers.php?page=" . $i . "&brand=" . $_SESSION['brand'] . "&sort=" . $_SESSION['sort'] . ">" . $i . "</a>";
        }
        ?>
    </div>
    <div class="main_for_sneakers">
        <div class="filters">
            <?php
            echo '<form id="filterform" action="sneakers.php?page=1&brand=' . $_SESSION['brand'] . '&sort=' . $_SESSION['sort'] . '" method="POST">';
            ?>
            <fieldset>
                <h2 class="fs-title" style="margin-top: 1vw;">ФИЛЬТРЫ</h2>
                <input id="all" name="rad" type="radio" value="all" <?php if($_SESSION['brand'] == "all") echo'checked="checked"'?>/>
                <label for="all">Все</label>
                <br>
                <input id="nike" name="rad" type="radio" value="Nike" <?php if($_SESSION['brand'] == "Nike") echo'checked="checked"'?>/>
                <label for="nike">Nike</label>
                <br>
                <input id="adidas" name="rad" type="radio" value="Adidas" <?php if($_SESSION['brand'] == "Adidas") echo'checked="checked"'?>/>
                <label for="adidas">Adidas</label>
                <br>
                <input id="puma" name="rad" type="radio" value="Puma" <?php if($_SESSION['brand'] == "Puma") echo'checked="checked"'?>/>
                <label for="puma">Puma</label>
                <br>
                <input id="reebok" name="rad" type="radio" value="Reebok" <?php if($_SESSION['brand'] == "Reebok") echo'checked="checked"'?>/>
                <label for="reebok">Reebok</label>
                <br>
                <input id="asics" name="rad" type="radio" value="Vans" <?php if($_SESSION['brand'] == "Vans") echo'checked="checked"'?>/>
                <label for="asics">Vans</label>
                <br>
                <input id="fila" name="rad" type="radio" value="Fila" <?php if($_SESSION['brand'] == "Fila") echo'checked="checked"'?>/>
                <label for="fila">Fila</label>
                <br>
                <input id="asc" name="rad1" type="radio" value="asc" <?php if($_SESSION['sort'] == "asc") echo'checked="checked"'?>/>
                <label for="asc">Цена по возрастанию</label>
                <br>
                <input id="desc" name="rad1" type="radio" value="desc" <?php if($_SESSION['sort'] == "desc") echo'checked="checked"'?>/>
                <label for="desc">Цена по убыванию</label>
                <br>
                <button type="submit" name="filter" class="action-button">Показать</button>
            </fieldset>
            </form>
        </div>
        <?php if (isset($_SESSION['logged_user'])) : ?>
            <div class="sneakers_view">
                <?php
                $sql = "SELECT round(avg(rating_assessment), 1) as 'rate', sneakers.sneaker_id, sneaker_photo, sneaker_name, sneaker_brand, sneaker_size, sneaker_price,sneaker_new FROM `sneakers` 
                left join rating on sneakers.sneaker_id = rating.sneaker_id ".$_SESSION['br']." group by sneaker_name ".$_SESSION['so']." LIMIT $art, $kol";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    do {
                        if ($row['rate'] == null) {
                            $rating = "нет рейтинга";
                        } else {
                            $rating = $row['rate'];
                        }
                        echo '                                               
                    <div class="sneaker_out">
                        <div class="sneaker_block_one">
                            <div class="rating">
                            <p>Рейтинг: ' . $rating . ' </p>
                            <img src="images/star.png" alt="" width="30" height="30">
                            </div>
                            <img src="' . $row["sneaker_photo"] . '" alt="' . $row["sneaker_photo"] . ' width="390" height="420"">
                            <a class="sneak_brand" href="" style="font-size:2vw;">' . $row["sneaker_brand"] . '</a>
                            <a class="sneak_name" href=""><b>' . $row["sneaker_name"] . '</b></a>
                            <a href="">Размер: ' . $row["sneaker_size"] . ' Eu</a>
                            <a href="">Цена: ' . $row["sneaker_price"] . ' Br</a>
                        </div>
                        <div class="sneaker_block_two">
                            <form id="stats" action="include/addrate.php" method="POST">
                            <input id="rating" name="rate" type="number" max="10" min="1"/>
                            <input id="sneak_id" name="sneaker_id" value="' . $row['sneaker_id'] . '" style="display: none;"/>
                            <label for="rating">Оставьте рейтинг</label>
                            <br><br>
                            <textarea id="comment" class="for_comment" name="comment" type="text"></textarea>
                            <br>
                            <label>Комментарий</label>
                            <br>
                            <button type="submit" name="rated" class="action-button">Добавить</button>
                            </form>
                        </div>
                    </div>';
                    } while ($row = mysqli_fetch_array($result));
                }
                ?>

            </div>
        <?php else : ?>
            <div class="sneakers_view_non">
                <?php
                $result = mysqli_query($link, "SELECT round(avg(rating_assessment), 1) as 'rate', sneaker_photo,sneaker_name, sneaker_brand,sneaker_size, sneaker_price,sneaker_new FROM `sneakers` 
            left join rating on sneakers.sneaker_id = rating.sneaker_id ".$_SESSION['br']." group BY sneaker_name ".$_SESSION['so']." LIMIT $art, $kol");
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    do {
                        if ($row['rate'] == null) {
                            $rating = "нет рейтинга";
                        } else {
                            $rating = $row['rate'];
                        }
                        echo '                                               
                    <div class="sneaker_out_non">
                        <div class="sneaker_block_one">
                            <div class="rating">
                            <p>Рейтинг: ' . $rating . ' </p>
                            <img src="images/star.png" alt="" width="30" height="30">
                            </div>
                            <img src="' . $row["sneaker_photo"] . '" alt="' . $row["sneaker_photo"] . ' width="310" height="330"">
                            <a class="sneak_brand" href="" style="font-size:2vw;">' . $row["sneaker_brand"] . '</a>
                            <a class="sneak_name" href=""><b>' . $row["sneaker_name"] . '</b></a>
                            <a href="">Размер: ' . $row["sneaker_size"] . ' Eu</a>
                            <a href="">Цена: ' . $row["sneaker_price"] . ' Br</a>
                        </div>
                    </div>';
                    } while ($row = mysqli_fetch_array($result));
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="footer">
        <div class="footer_block">
            <h3><span style="color: #ce0a32; font-weight: 700;">Информация</span></h3>
            <a href="#">О нас</a>
            <a href="#">Адрес</a>
            <a href="#">Отзывы покупателей</a>
        </div>
        <div class="footer_block">
            <h3><span style="color: #ce0a32; font-weight: 700;">Контакты</span></h3>
            <a href="#">+375 (44) 321-41-12</a>
            <a href="#">traceshop.by</a>
            <a href="#">traceshop@gmail.com</a>
        </div>
        <div class="footer_block">
            <h3><span style="color: #ce0a32; font-weight: 700;">Бренды</span></h3>
            <a href="sneakers.php?page=1&brand=Nike&sort=asc"><b>NIKE </b></a>
            <a href="sneakers.php?page=1&brand=Adidas&sort=asc"><b>ADIDAS </b></a>
            <a href="sneakers.php?page=1&brand=Puma&sort=asc"><b>PUMA </b></a>
            <a href="sneakers.php?page=1&brand=Reebok&sort=asc"><b>REEBOK </b></a>
            <a href="sneakers.php?page=1&brand=Vans&sort=asc"><b>VANS </b></a>
            <a href="sneakers.php?page=1&brand=Fila&sort=asc"><b>FILA </b></a>
        </div>
    </div>
    <div class="sec_footer">
        <div class="sec_footer_block">
            <p>
                Trace Shop - интернет магазин кроссовок и спортивной обуви<br>
                Адрес - ул. Колотушкина 10<br>
                Режим работы пн-сб 9:00 - 20:00<br>
                Минск 2020
            </p>
        </div>
        <div class="sec_footer_block">
            <p>Владелец сайта RONN1E INC. <br>
                Разработано специально для Чеботарёва Александра Валерьевича<br>18.01.2020<br>
                Все права защищены<br></p>
        </div>
    </div>
</body>

</html>