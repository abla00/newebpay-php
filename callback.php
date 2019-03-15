<?php
include('newebpay.php');
header("Content-Type:text/html; charset=utf-8");

$newebpay = new Newebpay();

$tradeInfo = trim($_POST['TradeInfo']);
$decrypt = $newebpay->decrypt($tradeInfo);

echo '$_POST: <br>';
print_r($_POST);
echo '<br>';
echo 'Decrypt: <br>';
print_r($decrypt);
?>
