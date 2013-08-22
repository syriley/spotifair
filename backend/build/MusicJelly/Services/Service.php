<?php

namespace MusicJelly\Services;

use MusicJelly\Container;


class Service {

    public function __construct($app){
        $this->app = $app;
        $this->container = Container::Instance();
        $this->entityManager = $this->container['entityManager'];

        $this->addEndpoints();
    }

    public function addEndpoints(){}


    /**
     * Get a parameter from the request.
     *
     * @param string $name The name (key) of the parameter.
     * 
     * @return string The escaped parameter.
     */
    public function getParameter($name){
        $app = $this->app;
        $value = $app['request']->get($name);

        return $app->escape($value);

    }

    public function log($message, $severity='debug'){
        switch ($severity) {
            case 'error':
                $this->app['monolog']->addError($message);
                break;
            
            default:
                $this->app['monolog']->addDebug($message);
                break;
        }
    }

    public function debug($message){
        $this->log($message, 'debug');
    }

    public function error($message){
        $this->log($message, 'error');
    }
}