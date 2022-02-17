<?php
/**
 *      时间戳转换工具
 */
date_default_timezone_set('PRC');
$iconPngUrl = 'icon.png';
$query = '';
require_once('microtime.php');

if(isset($argv[1])) {
    $query = urldecode($argv[1]);
}

$T = new Time();
$T->getTime($query);