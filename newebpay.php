<?php 
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

class Newebpay {
  const DOMAIN = 'https://core.newebpay.com/MPG/mpg_gateway';
  const DEV_DOMAIN = 'https://ccore.newebpay.com/MPG/mpg_gateway';
    
  public $merchant_id;
  protected $hash_key;
  protected $hash_iv;

	function __construct() {
	  $this->merchant_id = getenv("NEWEBPAY_MERCHANT_ID");
		$this->hash_key = getenv('NEWEBPAY_HASH_KEY');
		$this->hash_iv = getenv('NEWEBPAY_HASH_IV');
	}
	
	public function getDomain()
  {
    if (getenv('ENVIRONMENT') == 'production') {
      return self::DOMAIN;
    }

    return self::DEV_DOMAIN;
  }
  
  public function getTradeInfoArray()
  {
    $time = time();
    return [
      'MerchantID' => $this->merchant_id,
      'RespondType' => 'JSON',
      'TimeStamp' => $time,
      'Version' => "1.5",
      'MerchantOrderNo' => $time,
      'Amt' => 500,
      'ItemDesc' => 'My order description',
      'LoginType' => 0,
      'Email' => 'user@example.com'
    ];
  }
  
  public function createMpgAesEncrypt($parameter) {
    $query_string = http_build_query($parameter);
  
    return trim(bin2hex(openssl_encrypt($this->addPadding($query_string), 'aes-256-cbc',
      $this->hash_key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $this->hash_iv)));
  }

  protected function addPadding($string, $blocksize = 32) {
    $len = strlen($string);
    $pad = $blocksize - ($len % $blocksize);
    $string .= str_repeat(chr($pad), $pad);

    return $string;
  }

  public function getTradeSha($tradeInfo) {
    $key = $this->hash_key;
    $iv = $this->hash_iv;

    $data = "HashKey=$key&$tradeInfo&HashIV=$iv";

    return strtoupper(hash("sha256", $data));
  }

  public function decrypt($encrypt) {
    $decrypt = $this->stripPadding(openssl_decrypt(hex2bin($encrypt),
      'aes-256-cbc', $this->hash_key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->hash_iv));

    return json_decode($decrypt, true);
  }

  protected function stripPadding($string) {
    $slast = ord(substr($string, -1));
    $slastc = chr($slast);
    if (preg_match("/$slastc{" . $slast . "}/", $string)) {
      $string = substr($string, 0, strlen($string) - $slast);
            return $string;
    }
    else {
      return false;
    }
  }
}