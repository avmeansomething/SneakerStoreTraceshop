<?php
require("include/db_connect.php");
require("include/db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Магазин кроссовок - Trace Shop</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="styles/style.css">
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
                        <a href="#"><b>Привет, <?php echo $_SESSION['logged_user']->login ?>!</b></a>
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
    <div class="content_slider">
        <div id="slider-wrap">
            <div id="slider">
                <div class="slide">
                    <a href="sneakers.php?page=1&brand=all&sort=asc" class="to_sneakers">ВСЕ КРОССОВКИ</a>
                    <img src="images/pictuer1.jpg" alt="">
                </div>
                <div class="slide">
                    <a href="sneakers.php?page=1&brand=all&sort=asc" class="to_sneakers">ВСЕ КРОССОВКИ</a>
                    <img src="images/pictuer2.jpg" alt="">
                </div>
                <div class="slide">
                    <a href="sneakers.php?page=1&brand=all&sort=asc" class="to_sneakers">ВСЕ КРОССОВКИ</a>
                    <img src="images/pictuer3.jpg" alt="">
                </div>
                <div class="slide">
                    <a href="sneakers.php?page=1&brand=all&sort=asc" class="to_sneakers">ВСЕ КРОССОВКИ</a>
                    <img src="images/pictuer4.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="new_sneakers">
        <h1><b>НОВИНКИ</b></h1>
        <div class="stuff_slider">
            <?php
            $result = mysqli_query($link, "SELECT round(avg(rating_assessment), 1) as 'rate', sneaker_photo,sneaker_name, sneaker_brand, sneaker_new FROM `sneakers` 
            inner join rating on sneakers.sneaker_id = rating.sneaker_id WHERE sneaker_new = 1 group BY sneaker_name");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    echo '                                               
                    <div class="stuffslide">
                            <div class="rating">
                                <p>Рейтинг: ' . $row["rate"] . ' </p>
                                <img src="images/star.png" alt="" width="30" height="30">
                            </div>
                        <img src="' . $row["sneaker_photo"] . '" alt="' . $row["sneaker_photo"] . ' width="300" height="340"">
                        <a href="" style="font-size:2vw;">' . $row["sneaker_brand"] . '</a>
                    <a href="">' . $row["sneaker_name"] . '</a>
                </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        </div>
    </div>
    <div class="advantages">
        <h1><b>ПОЧЕМУ ИМЕННО МЫ?</b></h1>
        <div class="advs">
            <div class="adv_content">
                <img src="images/fastshippingservicepackageemslogistic_109710.png" alt="">
                <p><span style="color: #ce0a32; font-weight: 700;">Бесплатная доставка</span> двух пар</p>
            </div>
            <div class="adv_content">
                <img src="images/handlecarepackageshippingbox_109784.png" alt="">
                <p><span style="color: #ce0a32; font-weight: 700;">Примерка</span> перед покупкой</p>
            </div>
            <div class="adv_content">
                <img src="images/doorlocksecuritysaveprivacy_109742.png" alt="">
                <p><span style="color: #ce0a32; font-weight: 700;">Гарантия</span> на товар 2 месяца</p>
            </div>
            <div class="adv_content">
                <img src="images/savecostbudgetvaluepricecut_109773.png" alt="">
                <p><span style="color: #ce0a32; font-weight: 700;">Щедрые</span>и <span style="color: #ce0a32; font-weight: 700;">частые</span> акции</p>
            </div>
            <div class="adv_content">
                <img src="images/ididentificationcardpersondrivinglicence_109731.png" alt="">
                <p>Удобные виды <span style="color: #ce0a32; font-weight: 700;">оплаты</span></p>
            </div>
            <div class="adv_content">
                <img src="images/careshippingservicehandlingpackage_109799.png" alt="">
                <p>Полный <span style="color: #ce0a32; font-weight: 700;">возврат</span> средств</p>
            </div>
        </div>
    </div>
    <div class="advantages" style="background: white">
        <h1><b>ОТЗЫВЫ ПОКУПАТЕЛЕЙ</b></h1>
        <div class="reviews">
            <?php
            $result = mysqli_query($link, "SELECT round(avg(rating_assessment), 1) as 'rate', comment_text, user_name, 
            user_mark, sneaker_brand, sneaker_name, sneaker_photo FROM comments 
            inner join sneakers on comments.sneakers_id = sneakers.sneaker_id 
            inner join rating on sneakers.sneaker_id = rating.sneaker_id GROUP BY comment_id");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    echo '                                               
                    <div class="review">
                        <div class="block_review_what">
                            
                            <div class="review_sneaker">
                                <div class="rating">
                                    <p>Rating: ' . $row['rate'] . ' </p>
                                    <img src="images/star.png" alt="" width="30" height="30">
                                </div>
                                <img src="' . $row['sneaker_photo'] . '" alt="' . $row['sneaker_photo'] . '" width="300" height="330">
                                <p class="review_brand"><b>' . $row['sneaker_brand'] . '</b></p>
                                <p class="review_name">' . $row['sneaker_name'] . '</p>
                            </div>
                        </div>
                        
                        <div class="block_review_comment">
                            <div class="who_comment">
                                <h3>' . $row['user_name'] . '</h3>
                                <h4>Оценка товара : ' . $row['user_mark'] . '</h4>
                            </div>
                            <h3>Отзыв</h3>
                            <p>' . $row['comment_text'] . '</p>
                        </div>
                    </div>';
                } while ($row = mysqli_fetch_array($result));
            }
            ?>
        </div>
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
            <a href="sneakers.php?brand=NIKE">NIKE</a>
            <a href="sneakers.php?brand=ADIDAS">ADIDAS</a>
            <a href="sneakers.php?brand=REEBOK">REEBOK</a>
            <a href="sneakers.php?brand=PUMA">PUMA</a>
            <a href="sneakers.php?brand=VANS">VANS</a>
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
<script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
<script src="slick/slick.min.js"></script>
<script src="js/slickstuff.js"></script>
<script src="js/slider.js"></script>
<script src="js/slickreviews.js"></script>
<script src="js/reset.js"></script>

</html>