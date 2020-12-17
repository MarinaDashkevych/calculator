<?php
$fh = fopen("history.json", 'a+');
//or die("Error opening output file");

$amountInUah = 0;
$exchangeRate = [
    'USD' =>[
      'ccy' => 'USD' ,
      'base_ccy' => 'UAH' ,
      'buy' => '28.00000' ,
      'sale' => '28.41000' ],
    'EUR' =>
    [
      'ccy' => 'EUR' ,
      'base_ccy' => 'UAH',
      'buy' => '33.80000',
      'sale' => '34.40000', ],
    'RUR' =>
    [
      'ccy' => 'RUR',
      'base_ccy' => 'UAH',
      'buy' => '0.36000',
      'sale' => '0.40000' ],
    'BTC' =>
    [
      'ccy' => 'BTC',
      'base_ccy' => 'USD',
      'buy' => '17425.9825',
      'sale' => '19260.2965' ]
];

$amount = !!$_POST['amount']  && is_numeric($_POST['amount']) ? (float)$_POST['amount'] : 0;
if ($_POST['from'] == 'UAH') {
    $amountInUah = $amount;
} else {
    $rateFrom = (float)$exchangeRate[$_POST['from']]['buy'];
    $amountInUah = $amount * $rateFrom;
}
if($_POST['to'] == 'UAH') {
    $result = $amountInUah;
} else {
    $rateTo = (float)$exchangeRate[$_POST['to']]['sale'];
    $result = round($amountInUah / $rateTo, 2);
}
echo $result;

//// write data to history.json
//$dataToFile = ['from' => $_POST['from'], 'to' => $_POST['to'], 'amount' => $_POST['amount'], 'result' => $result,'date'=> date('Y-m-d-H-i-s')];
//fwrite($fh, json_encode($dataToFile,JSON_UNESCAPED_UNICODE) . ',');
//fclose($fh);
//echo $result;

//write data to file"history.txt"
$dataToFile = ['from' => $_POST['from'],
    'to' => $_POST['to'],
    'amount' => $_POST['amount'],
    'result' => $result ,
    'date' => date('Y-m-d-H-i-s'),
    $end="\r"];
$str = implode(',',$dataToFile);
$finish = fwrite(fopen('history.txt', 'a') , $str);
$data= file_put_contents('history.txt ',$finish .';');
fclose($fh);


