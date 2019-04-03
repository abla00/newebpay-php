<?php
include('newebpay.php');

$newebpay = new Newebpay();
$preiodData = $newebpay->getPeriodData();
$postData = $newebpay->createMpgAesEncrypt($preiodData);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newebpay Period API Demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="text-center">
    <h2>Newebpay Period Payment</h2>
    <form class="w-50" style="margin: auto;" action="<?= $newebpay->getDomain() ?>/period" method="post">
      <div class="form-group">
        <label for="merchantID">MerchantID</label>
        <input type="text" id="merchantID" name="MerchantID_" class="form-control" value="<?= $newebpay->merchant_id ?>" readonly>
      </div>
      <div class="form-group">
        <label for="postData">PostData</label>
        <input type="text" id="postData" name="PostData_" class="form-control" value="<?= $postData ?>" readonly>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
