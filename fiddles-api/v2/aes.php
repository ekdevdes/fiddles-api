<?php

class AESCrypt {

	public function decrypt($text, $isJSONEncoded = false){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = 'a16byteslongkey!a16byteslongkey!';

		if($isJSONEncoded){
			return preg_replace("/[^A-Za-z0-9 ]/", '',
					trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($_POST['pw']), MCRYPT_MODE_ECB)));
		}else{
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($_POST['pw']), MCRYPT_MODE_ECB));
		}
	}

};