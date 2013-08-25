<?php 

$uri = $_SERVER['REQUEST_URI'];
if(strpos($uri, 'api') !== false) {
    $_SERVER['REQUEST_URI'] = substr($uri, 4);
}

require_once __DIR__.'/../bootstrap.php';

use MusicJelly\Container;
use MusicJelly\WebApplication;
use MusicJelly\Services\UserService;
use MusicJelly\Services\LoginService;
use MusicJelly\Services\LookupService;
use MusicJelly\Services\TrackService;
use MusicJelly\Services\SearchService;
use MusicJelly\Services\PaypalService;
use Symfony\Component\HttpFoundation\Request;


$webApplication = new WebApplication();

$app = $webApplication->app;
$userService = new UserService($app);
$songService = new TrackService($app);
$paypalService = new PaypalService($app);
$lookupService = new LookupService($app);
$searchService = new SearchService($app);

$app->run();