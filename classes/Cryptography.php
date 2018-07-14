<?php 
class Cryptography{      

	private static $secret_key = 'gsdgsg423b523b5432bjbjm24vbjn2hv';
	const CIPHER_16 = 'AES-128-CBC';
    const CIPHER_32 = 'AES-256-CBC';

	public static function encrypt($str,$cl=32){
		return static::encyptedDecypted('encrypt',$str,$cl);
	}
	public static function decrypt($str,$cl=32){
		return static::encyptedDecypted('decrypt',$str,$cl);
	}	
	public static function encyptedDecypted($action,$str,$cl){

		$cl = (int) $cl;

		if($cl === 16){
			$cipher = static::CIPHER_16;
			$length = 16;
		}elseif($cl === 32){
			$cipher = static::CIPHER_32;
			$length = 32;
		}else{
			throw new Exception("Error Processing Request", 1);
			
		}
		$iv =  $iv = substr(hash('sha256',static:: $secret_key), 0, 16);
		$key = hash('sha512', static::$secret_key);
	    if ( $action == 'encrypt' ) {
	        $output = openssl_encrypt($str, $cipher, $key, 0, $iv);
	        $output = base64_encode($output);
	        $output = static::securesalts($length).$output.static::securesalts($length);
	    } else if( $action == 'decrypt' ) {
	    	$str = $text = substr($str, $length, -$length);
	        $output = openssl_decrypt(base64_decode($str), $cipher, $key, 0, $iv);
	    }
	    return $output;
	}
	private static function securesalts($length){
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