<?php

namespace MusicJelly\Services;

use MusicBrainz\MusicBrainz;
use MusicBrainz\Filters\ArtistFilter;
use MusicBrainz\Filters\RecordingFilter;
use MusicBrainz\Filters\LabelFilter;
use Guzzle\Http\Client;

use Symfony\Component\HttpFoundation\Request;

class LookupService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->get('/lookup', array($this, 'lookup'));

    }
    
    public function lookup(Request $request){
        $brainz = new MusicBrainz(new Client(), 'spotifair', 'lurpak83');
        $brainz->setUserAgent('ApplicationName', '0.1', 'http://example.com');

        $guid = $this->getParameter('guid');
        $type = $this->getParameter('type');
        
        switch ($type) {
            case 'artist':
                $includes = array(
                    'releases',
                    'recordings',
                    'release-groups',
                    'user-ratings'
                );
                break;
            case 'release-group':
                $includes = array(
                    'releases',
                );
                break;
            case 'release':
                $includes = array(
                    'recordings',
                );
                break;
            default:
                $includes = array();
                break;
        }
        

        try {
            $resource = $brainz->lookup($type, $guid, $includes);  //bryan adams
            print_r($artist);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $this->app->json($resource);
    }

}