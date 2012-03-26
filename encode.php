<?php

$site = strtolower($_GET['s']);
$pass = $_GET['p'];

$site = substr($site,0,255);
$pass = substr($pass,0,255);

$site = trim($site,'/');
$site = (substr($site,0,7)=='http://' ? substr($site,7) : $site);

$return = '';

$return = base64_encode(hash('sha256',($site.sha1($pass,true).sha1($site,true).$pass),true));
$return = substr($return,0,12);
$return = strtr($return, '+/', '-_');

echo $return;
