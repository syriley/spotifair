<?php 

require_once __DIR__.'/../bootstrap.php';

use MusicJelly\Container;
use MusicJelly\WebApplication;
use MusicJelly\Services\CrawlerService;


$webApplication = new WebApplication(
	array(
	'logFile' => __DIR__.'/../logs/crawler.log',
	)
);

$app = $webApplication->app;
$crawlerService = new CrawlerService($app);

$app->run();
$app['monolog']->addDebug('starting crawler');