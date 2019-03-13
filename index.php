<?php
require __DIR__ . '/vendor/autoload.php';
include('newebpay.php');
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$merchant_id = getenv("NEWEBPAY_MERCHANT_ID");
$hash_key = getenv('NEWEBPAY_HASH_KEY');
$hash_iv = getenv('NEWEBPAY_HASH_IV');

$newebpay = new Newebpay($merchant_id, $hash_key, $hash_iv);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newebpay API Demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="text-center">
    <h2>Newebpay</h2>
    <form class="w-50" style="margin: auto;" action="<?= $newebpay->getDomain() ?>">
      <div class="form-group">
        <label for="merchantID">MerchantID</label>
        <input type="input" id="merchantID" name="MerchantID" class="form-control" value="<?= $merchant_id ?>" readonly>
      </div>
      <div class="form-group">
        <label for="tradeInfo">TradeInfo</label>
        <input type="input" id="tradeInfo" name="TradeInfo" class="form-control" value="<?= $hash_key ?>" readonly>
      </div>
      <div class="form-group">
        <label for="tradeSha">TradeSha</label>
        <input type="input" id="tradeSha" name="TradeSha" class="form-control" value="<?= $hash_iv ?>" readonly>
      </div>
      <div class="form-group">
        <label for="version">Version</label>
        <input type="input" id="version" name="Version" class="form-control" value="1.5" readonly>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
