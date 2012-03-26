<?php

$site = strtolower($_POST['s']);
$pass = $_POST['p'];
$algo = $_POST['a'];

$site = substr($site,0,255);
$pass = substr($pass,0,255);

$valid_algos = array('orig', 'bcrypt1');
if (!in_array($algo,$valid_algos)) $algo = "orig";


$site = trim($site,'/');
$site = (substr($site,0,7)=='http://' ? substr($site,7) : $site);


$return = '';

switch ($algo){

	case "orig":
		$return = base64_encode(hash('sha256',($site.sha1($pass,true).sha1($site,true).$pass),true));
		$return = substr($return,0,12);
		$return = strtr($return, '+/', '-_');
		break;
	case "bcrypt1":
		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
			$bpass = $pass;
			if (strlen($bpass) < 23) {
				for ($i = (23/strlen($pass)); $i>0; $i--){
					$bpass = $bpass+$pass;
				}
			}
			$return = base64_encode(crypt($site,'$2a$12'.substr(ereg_replace("[^A-Za-z0-9]", "", base64_encode($bpass)),0,22)));
			$return = substr($return,0,12);
			$return = strtr($return, '+/', '-_');
		}
}
echo $return;
