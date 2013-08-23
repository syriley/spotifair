<?php

namespace MusicJelly\Services;

use Symfony\Component\HttpFoundation\Request;
use MusicJelly\Crawlers\MldbCrawler;

class TrackService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->get('/tracks', array($this, 'all'));

    }
    
    public function all(Request $request){
            $term = $this->getParameter('term');
            if($term){
                $this->debug('term is '.$term);
                $searchRepository = $this->entityManager->getRepository('MusicJelly\Entities\SearchTerm');
                $alreadySearched = $searchRepository->addTerm($term);
            }
            $trackRepository = $this->entityManager->getRepository('MusicJelly\Entities\Track');

            $tracks = $trackRepository->search($term);
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