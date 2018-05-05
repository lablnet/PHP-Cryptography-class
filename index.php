<?php 
require_once 'classes/Cryptography.php';

$Encypted =  Cryptography::Encypted("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.

");
echo $Encypted['text'];
echo "<br>";
echo Cryptography::Decrypt($Encypted);

