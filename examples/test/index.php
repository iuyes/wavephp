<?php
header('Content-Type:text/html;charset=utf-8');
// error_reporting(0);

require dirname(__FILE__).'/../../wavephp/Wave.php';

$wave = new Wave();
$wave->run();

?>