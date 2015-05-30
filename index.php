<?php
$f3 = require ('vendor/bcosca/fatfree/lib/base.php');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
$f3->config('app/config/config.ini');
$f3->config('app/config/routes.ini');
// $f3->set('CACHE', true);
$f3->set('DEBUG', 3);
$f3->set('db.dsn', sprintf("%s:host=%s;port=%d;dbname=%s", $f3->get('db.driver'), $f3->get('db.hostname'), $f3->get('db.port'), $f3->get('db.name')));
$f3->set('DB', new DB\SQL($f3->get('db.dsn'), $f3->get('db.username'), $f3->get('db.password')));
$f3->set('AUTOLOAD', 'app/controllers/');
$f3->set('proInfo', $f3->get('DB')->exec('select name from province'));
$f3->set('template', 'XBResult');
// F3::route('GET /', function () {
//     echo Template::instance()->render('index.htm');
// });
$f3->run();
?>