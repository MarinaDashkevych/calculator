<?php
//// read data from history.json
//$jsonContent = array(file_get_contents("history.json"));
//var_dump($jsonContent);
//
//$array = json_encode($jsonContent);
//var_dump($array);
//
//$jsonIterator = new RecursiveIteratorIterator(
//    new RecursiveArrayIterator(json_decode($array , TRUE)),
//    RecursiveIteratorIterator::SELF_FIRST);
//
//foreach ($jsonIterator as $key => $val) {
//    if(is_array($val)) {
//        echo "$key:\n";
//    } else {
//        echo "$key => $val\r";
//    }
//}

// read data from "history.txt"
$dataArrayTxt = file("history.txt");
var_dump($dataArrayTxt);

$dataStringTxt = file_get_contents('history.txt');
var_dump($dataStringTxt);

$data = $dataStringTxt;
$all = list($from, $to, $amount, $result, $date) = explode(",", $data);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>ОбменяйКА</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=B612+Mono|Cabin:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/fonts/icomoon/style.css">
    <link rel="stylesheet" href="style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/css/jquery-ui.css">
    <link rel="stylesheet" href="style/css/owl.carousel.min.css">
    <link rel="stylesheet" href="style/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="style/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="style/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="style/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="style/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="style/css/aos.css">
    <link href="style/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style/css/style.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php"><b>ОбменяйКА<b></a>
            <ul class="nav justify-content-center">
                <li class="nav-item active">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Курс валют</a>
                </li>
                <a class="nav-link" href="history.php">История</a>
                </li>
                <a class="nav-link" href="config.php">Настройки</a>
                </li>
            </ul>
        </div>
    </nav>
</div>


<div id="info"></div>
<table id="workers"></table>
<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Продаю</th>
            <th scope="col">Покупаю</th>
            <th scope="col">Количество</th>
            <th scope="col">Сумма</th>
            <th scope="col">Дата</th>
        </tr>
        </thead>
        <tbody>
        <!--        --><?php //foreach ($jsonIterator as $key => $val): ?>
        <!--            <tr>-->
        <!--                <td>--><? //= $val ?><!--</td>-->
        <!--                --><?php //endforeach; ?>

        <?php foreach ($all as $key): ?>
        <tr>
            <td><?= $from?></td>
            <td><?= $to ?></td>
            <td><?= $amount ?></td>
            <td><?= $result ?></td>
            <td><?= $date ?></td>
        <?php endforeach; ?>
        </tr>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="page-footer font-small indigo">

    <div class="container">
        <div class="row text-center d-flex justify-content-center pt-5 mb-3">
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#">Про нас</a>
                </h6>
            </div>

            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#">Помощь</a>
                </h6>
            </div>

            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#">Мы в соцсетях</a>
                </h6>
            </div>
        </div>
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/"> ОбменяйКА</a>
        </div>
</footer>


<!--<script src="js/jquery-3.3.1.min.js"></script>-->
<!--<script src="js/jquery-migrate-3.0.1.min.js"></script>-->
<!--<script src="js/jquery-ui.js"></script>-->
<!--<script src="js/popper.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/owl.carousel.min.js"></script>-->
<!--<script src="js/jquery.stellar.min.js"></script>-->
<!--<script src="js/jquery.countdown.min.js"></script>-->
<!--<script src="js/bootstrap-datepicker.min.js"></script>-->
<!--<script src="js/jquery.easing.1.3.js"></script>-->
<!--<script src="js/aos.js"></script>-->
<!--<script src="js/jquery.fancybox.min.js"></script>-->
<!--<script src="js/jquery.sticky.js"></script>-->
<!--<script src="js/jquery.mb.YTPlayer.min.js"></script>-->
<!--<script src="js/main.js"></script>-->

</html>