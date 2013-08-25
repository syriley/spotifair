<?php

namespace MusicJelly\Services;

use MusicBrainz\MusicBrainz;
use MusicBrainz\Filters\ArtistFilter;
use MusicBrainz\Filters\RecordingFilter;
use MusicBrainz\Filters\LabelFilter;
use Guzzle\Http\Client;

use Symfony\Component\HttpFoundation\Request;

class SearchService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->get('/search/artist', array($this, 'artistSearch'));
        $app->get('/search/recording', array($this, 'recordingSearch'));

    }
    
    public function artistSearch(Request $request){
        $term = $this->getParameter('term');
        $brainz = new MusicBrainz(new Client());
        $brainz->setUserAgent('ApplicationName', '0.1', 'http://example.com');
        $args = array(
            "artist"     => $term,
        );
        $artists = $brainz->search(new ArtistFilter($args));

        return $this->app->json($artists);
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

}