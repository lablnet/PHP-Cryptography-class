<?php 
require_once 'classes/Cryptography.php';





$encrypt =  Cryptography::encrypt("Hello!");
$decrypt = Cryptography::decrypt($encrypt);
echo "encypted <br>".$encrypt;
echo "<br> decrypted <br>".$decrypt;
