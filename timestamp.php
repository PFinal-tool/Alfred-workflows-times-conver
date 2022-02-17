<?php

date_default_timezone_set('PRC');
$iconPngUrl = 'icon.png';
$query = '';
if(isset($argv[1])) {
    $query = urldecode($argv[1]);
}

require_once('time.php');

$T = new Time();

$T->getTime($query);