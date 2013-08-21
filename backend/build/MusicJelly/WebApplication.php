<?php

namespace MusicJelly;

use \Silex\Application;
use \Silex\Provider\SwiftmailerServiceProvider;
use \Silex\Provider\MonologServiceProvider;
use \Monolog\Handler\ChromePHPHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;


class WebApplication{


	public function __construct(){
		$app = new Application();
		$this->app = $app;

		$this->setDefaults();
		$this->registerMail();
		$this->registerLog();

		$app->before(array($this, 'before'));

		
		

	    $app->error(function (\Exception $e, $code) use ($app) {
            // $this->error($e->getMessage());
            
            $error = ([
                'message' => $e->getMessage(),
                // 'trace'   => $e->getTraceAsString(),
            ]);
            return new Response(json_encode($error), 400);
        });

		$this->app = $app;
	}

	public function setDefaults(){
		$app = $this->app;
		$app['env'] = $this->getEnvironment();
		$app['debug'] = $app['env'] == 'dev';

		$app['email.default_to'] = array(
		  'syriley@gmail.com',
		);

		$app['email.default_subject'] = '[MusicJelly] Error report';

		$app['email.default_from'] = 'syriley@gmail.com';
	}


	public function getEnvironment() {
	  $gethostname_result = gethostname();

	  $gethostname_map = array(
	    'musicjelly.com' => 'prod',
	    'stage.musicjelly.com' => 'staging',
	  );

	  $is_hostname_mapped = !empty($gethostname_result) &&
	                        isset($gethostname_map[$gethostname_result]);
	  
	  return $is_hostname_mapped ? $gethostname_map[$gethostname_result]
	                             : 'dev';
	}

	public function registerMail(){
		$app = $this->app;
		$app->register(new SwiftmailerServiceProvider());
		$app['swiftmailer.options'] = array(
		    'host' => 'smtp.gmail.com',
		    'port' => '465',
		    'username' => 'syriley',
		    'password' => 'Hec5ezA5',
		    'encryption' => 'ssl',
		    'auth_mode' => 'login'
		);
	}

	public function registerLog(){
		$app = $this->app;
		$app->register(new MonologServiceProvider(), array(
		    'monolog.logfile' => __DIR__.'/../../logs/development.log',
		    'monolog.name' => 'MusicJelly',
		));
		$app['monolog']->pushHandler(new ChromePHPHandler());
		$app['monolog'] = $app->share($app->extend('monolog',
			function($monolog, $app) {
				if (!$app['debug']) {
					$message = \Swift_Message::newInstance()
				        ->setSubject($app['email.default_subject'])
				        ->setFrom($app['email.default_from'])
				        ->setTo($app['email.default_to']);

				    $monolog->pushHandler(new \Monolog\Handler\SwiftMailerHandler(
				      $app['mailer'],
				      $message,
				      Monolog\Logger::ERROR
				    ));
				}

			  return $monolog;
			})
		);
	}

	public function before(Request $request){
	        $method = $request->getMethod();
	        if (strpos($method, 'PUT') !== false || strpos($method, 'POST') !== false) {
	            $data             = json_decode($request->getContent(), true);
	            $request->request = new ParameterBag(is_array($data) ? $data : array());
	        }

	}
}