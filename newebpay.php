<?php 

class Newebpay {
  const DOMAIN = 'https://core.newebpay.com/MPG/mpg_gateway';
  const DEV_DOMAIN = 'https://ccore.newebpay.com/MPG/mpg_gateway';
    
  protected $merchant_id;
  protected $hash_key;
  protected $hash_iv;

	function __construct($merchant_id, $hash_key, $hash_iv) {
	  $this->merchant_id = $merchant_id;
		$this->hash_key = $hash_key;
		$this->hash_iv = $hash_iv;
	}
	
	public function getDomain()
    {
        if (getenv('ENVIRONMENT') == 'production') {
            return self::DOMAIN;
        }

        return self::DEV_DOMAIN;
    }
}