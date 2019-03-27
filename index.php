<?php
include('newebpay.php');

$newebpay = new Newebpay();
$tradeInfoArr = $newebpay->getTradeInfoArray();
$tradeInfo = $newebpay->createMpgAesEncrypt($tradeInfoArr);
$tradeSha = $newebpay->getTradeSha($tradeInfo);
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
    <form class="w-50" style="margin: auto;" action="<?= $newebpay->getDomain() ?>" method="post">
      <div class="form-group">
        <label for="merchantID">MerchantID</label>
        <input type="text" id="merchantID" name="MerchantID" class="form-control" value="<?= $newebpay->merchant_id ?>" readonly>
      </div>
      <div class="form-group">
        <label for="tradeInfo">TradeInfo</label>
        <input type="text" id="tradeInfo" name="TradeInfo" class="form-control" value="<?= $tradeInfo ?>" readonly>
      </div>
      <div class="form-group">
        <label for="tradeSha">TradeSha</label>
        <input type="text" id="tradeSha" name="TradeSha" class="form-control" value="<?= $tradeSha ?>" readonly>
      </div>
      <div class="form-group">
        <label for="version">Version</label>
        <input type="text" id="version" name="Version" class="form-control" value="1.5" readonly>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
