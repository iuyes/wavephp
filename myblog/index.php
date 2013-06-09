<?php
header('Content-Type:text/html;charset=utf-8');
// error_reporting(0);

require '../wavephp/Wave.php';

$wave = new Wave();
$wave->run();

?>