<?php
const ACCEPTED_CURENCIES = ['USD', 'EUR', 'RUR'];

function getExchangeRates($method, $url, $data)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'APIKEY: 111111111111111111111',
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    $response = json_decode($result, true);
    $result = [];
    foreach ($response as $currencyData) {
        $keyBy = $currencyData['ccy'];
        if (in_array($keyBy, ACCEPTED_CURENCIES)) {
            $result[$keyBy] = $currencyData;
        }
    }
    return $result;
}

$rateList = getExchangeRates(
    'GET',
    'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5',
    false
);

if (!empty($_POST['exchange'])) {
    $selectedExchange = $_POST['exchange'];
    $_SESSION['$selectedExchange'] = $selectedExchange;
}
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

<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Код валюты</th>
            <th scope="col">Код национальной валюты</th>
            <th scope="col">Покупка</th>
            <th scope="col">Продажа</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rateList as $currency): ?>
            <tr>
                <?php foreach ($currency as $row): ?>
                    <td><?= $row ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container">
    <ul class="list-group">
        <li class="list-group-item active">Введите валюту и введите сумму к продаже</li>
    </ul>
    <br>

    <div class="container"
    <div class="col-auto my-2">
        <h4>Хочу продать... ОТДАЮ</h4>
        <label class="mr-sm-20 sr-only" for="inlineFormCustomSelect">Preference</label>
        <select class="custom-select mr-sm-8" id="from">
            <?php foreach (array_merge(array_keys($rateList), ['UAH']) as $currency): ?>
                <option value=""><?= $currency ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="col-auto my-2">
        <h4>Хочу купить... ПОЛУЧУ</h4>
        <label class="mr-sm-20 sr-only" for="inlineFormCustomSelect">Preference</label>
        <select class="custom-select mr-sm-8" id="to">
            <?php foreach (array_merge(array_keys($rateList), ['UAH']) as $currency): ?>
                <option value=""><?= $currency ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <form class="form-horizontal">
        <div class="form-group">
            <label for="amount-input" class="col-xs-2 control-label"></label>
            <div class="col-xs-10">
                <input type="number" class="form-control" id="amount-input" placeholder="Введите сумму..." required/>
            </div>
        </div>
    </form>

    <form action="/" method="get">
        <div class="button">
            <input type="button" id="button" class="btn btn-primary" value="Рассчет" name="start">
        </div>
    </form>
<br>
    <div class="col-xs-10">
        <h4>Результат:</h4>
        <h3><span id="result"></span></h3>
    </div>
</div>
</body>
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


<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script>
    $("#button").click(function (e) {
        let amount = $("#amount-input").val(),
            from = $("#from").children("option:selected").html(),
            to = $("#to").children("option:selected").html();
        if (from == to) {
            $("#result").html(amount);
        } else {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/calculator.php",
                data: {
                    amount: amount, // < note use of 'this' here
                    from: from,
                    to: to,
                },
                success: function (result) {
                    $("#result").html(result);
                },
                error: function (result) {
                    alert('error');
                }
            });
        }
    });
</script>
</html>