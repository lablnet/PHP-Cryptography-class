<?php 
require_once 'classes/Cryptography.php';





$encrypt =  Cryptography::encrypt("https://symfony.com/components");
$decrypt = Cryptography::decrypt($encrypt);
echo "encypted <br>".$encrypt;
echo "<br> decrypted <br>".$decrypt;
