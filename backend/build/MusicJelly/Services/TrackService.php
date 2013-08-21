<?php

namespace MusicJelly\Services;

use Symfony\Component\HttpFoundation\Request;

class TrackService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->get('/tracks', array($this, 'all'));

    }
    
    public function all(Request $request){
            $trackRepository = $this->entityManager->getRepository('MusicJelly\Entities\Track');

            $tracks = $trackRepository->findAll();
            $trackDtos = array();
            foreach ($tracks as $track) {
                array_push($trackDtos, $track->toDto());
            }
            
            // $this->log('testing');
            // $this->log('testing', 'error');
            // $message = \Swift_Message::newInstance()
            //     ->setSubject('[YourSite] Feedback')
            //     ->setFrom(array('syriley@gmail.com'))
            //     ->setTo(array('syriley@gmail.com'))
            //     ->setBody('message');

            // $this->app['mailer']->send($message);
            return $this->app->json($trackDtos);
    }

}