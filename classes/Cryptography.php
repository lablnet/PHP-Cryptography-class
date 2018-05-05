<?php 
class Cryptography{      

	private static $key;

	private static $cipher = "aes-128-gcm";	
	
	public function __construct(){

		Cryptography::$key = openssl_random_pseudo_bytes(32);

	}

	public static function Encypted($plain_txt){

	if (in_array(Cryptography::$cipher,openssl_get_cipher_methods())){

		$ciphertext = false;

		$key = Cryptography::$key;

		$cipher = Cryptography::$cipher;

    	$ivlen = openssl_cipher_iv_length($cipher);

    	$iv = openssl_random_pseudo_bytes($ivlen);

    		$ciphertext .= openssl_encrypt($plain_txt, $cipher, $key, $options=0, $iv,$tag);

    	$array =  [
    		'text' => Cryptography::Custom(16).$ciphertext.Cryptography::Custom(16),
    		'key' => $key,
     		'cipher' => $cipher,
    		'iv' => $iv,   	
    		'tag' => $tag,	
    	];
    	return $array;
	}

	}
	public static function Decrypt($params) {

    	if(is_array($params)){

    		$data = $params;

    		$text = substr($data['text'], 16, -16);

    		$decrypted_txt = openssl_decrypt($text, $data['cipher'], $data['key'], 0 , $data['iv'],$data['tag']);

    		return $decrypted_txt;

    	}else{

    		return false;

    	}

     }	

	private static function Custom($length){

		if(is_int($length) && $length >= 5){

			$chars =  array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

			$stringlength = count( $chars  ); //Used Count because its array now
			
			$randomString = '';
			
			for ( $i = 0; $i < $length; $i++ ) {
				
				$randomString .= $chars[rand( 0, $stringlength - 1 )];
				
			}
			
			return $randomString;			

		}else{

			return false;

		}

	}
}