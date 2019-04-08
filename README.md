# Newebpay

API Version: 1.5

To create a web page to pay with credit card using [Newebpay](https://www.newebpay.com/) API.

API Documents: 
[https://www.newebpay.com/website/Page/content/download_api](https://www.newebpay.com/website/Page/content/download_api) 

## Requirements

* PHP > 5.5
* Composer
* Newebpay 1.5

## Usage

Create your own .env file

`$ cp .env.example .env`

Install dependencies

`$ composer install`

Create a mpg form, you need 4 required parameters:

```
<form action="<?= $newebpay->getDomain() ?>/mpg_gateway" method="post">
    <input type="text" name="MerchantID" value="<?= $newebpay->merchant_id ?>">
    <input type="text" name="TradeInfo" value="<?= $tradeInfo ?>">
    <input type="text" name="TradeSha" value="<?= $tradeSha ?>">
    <input type="text" name="Version" value="1.5">
    <input type="submit" value="Submit">
</form>
```

Create a periodical form:

```
<form action="<?= $newebpay->getDomain() ?>/period" method="post">
    <input type="text" name="MerchantID_" value="<?= $newebpay->merchant_id ?>">
    <input type="text" name="PostData_" value="<?= $postData ?>">    
    <input type="submit" value="Submit">
</form>
```

* Please notice that the input names end with a underline(_)

## Verify Callback

Newebpay makes a form POST to NotifyUrl when transactions are completed.

If you are using csrf verification then you have to skip it.

And you need to verify the callback is from Newebpay by decryption.

Save the transaction data to database if the decryption is success.

## Settings

* `NotifyURL` is triggered after every completion of the transaction.
* `ReturnURL` the page will be redirected to ReturnURL by **Form Post** after completion.

If you are trying to test if it works or not on localhost.

You will need a public URL, then [ngrok](https://ngrok.com/) is useful.

## Troubleshooting
Have you ever wasted a whole day on the error code which is not helpful?

Some situations list below:

* If you post the form at server side, it returns:
```
Code: MPG02005
Message: 驗證資料錯誤(來源不合法)
```

* If you forgot to add method="POST" to the form, it returns:
```
Code: MPG01010
Message: 程式版本錯誤
```

#### Attention
* You must specify the HTTP method POST to be used when submitting the form data.

* And you cannot POST your data at server side.

* This is NOT an official example maintained by Newebpay.
