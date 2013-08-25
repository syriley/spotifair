<?php

namespace MusicJelly\Services;

require_once __DIR__.'/../../../Google/Google_Client.php';  
require_once __DIR__.'/../../../Google/contrib/Google_YouTubeService.php';

use Symfony\Component\HttpFoundation\Request;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Filters\ArtistFilter;
use MusicBrainz\Filters\RecordingFilter;
use MusicBrainz\Filters\LabelFilter;
use Guzzle\Http\Client;
use MusicJelly\Crawlers\MldbCrawler;

use \Google_Client;
use \Google_YoutubeService;

class TrackService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->get('/tracks', array($this, 'recordingSearch'));
        $app->get('/youtube', array($this, 'getYoutubeUrl'));

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

    public function recordingSearch(Request $request){
        $term = $request->get('term');
        $brainz = new MusicBrainz(new Client());
        $brainz->setUserAgent('ApplicationName', '0.1', 'http://example.com');
        $args = array(
            "recording"     => $term,
        );
        $recordings = $brainz->search(new RecordingFilter($args));

        usort($recordings, function($a, $b){
            return $a->releaseCount < $b->releaseCount;
        });


        return $this->app->json($recordings);
    }

     public function getYoutubeUrl(Request $request){
         // Call set_include_path() as needed to point to your client library.  
        $term = $request->get('term');
 
        $DEVELOPER_KEY = 'AIzaSyC0KZdPrm7z4_fl5LkrMoqRYvT7ESnFkcw';  
      
        $client = new Google_Client();  
        $client->setDeveloperKey($DEVELOPER_KEY);  
      
        $youtube = new Google_YoutubeService($client);  
      
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
          'type' => 'video',
          'videoEmbeddable' => 'true',  
          'q' => $term,  
          'maxResults' => 1,  
        ));  
      
        if(!isset($searchResponse['items'][0])) {
            return null;
        }
        $url = 'http://www.youtube.com/watch?v='.$searchResponse['items'][0]['id']['videoId'];
        return $url;
       }

}