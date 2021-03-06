<?php

namespace MusicJelly\Crawlers;

require __DIR__.'/simpleHtmlDom.php';
require_once __DIR__.'/../../../Google/Google_Client.php';  
require_once __DIR__.'/../../../Google/contrib/Google_YouTubeService.php';  

use MusicJelly\Entities\Artist;
use MusicJelly\Entities\Album;
use MusicJelly\Entities\MldbTrack;
use MusicJelly\Entities\StartPath;
use MusicJelly\Entities\Track;
use MusicJelly\container;
use \Google_Client;
use \Google_YoutubeService;

class MldbCrawler {

    const MLDB_ORG = 'http://www.mldb.org/';

    public function __construct(){
        $this->container = Container::Instance();
        $this->entityManager = $this->container['entityManager'];
    }

    public function search($term) {
        $html = file_get_html('http://www.mldb.org/search?si=0&mm=0&ob=1&mq='.$term);
        foreach ($html->find('a') as $link) {
            if(strpos($link->href, 'song-') !== false){
                $this->saveTrackUrl($link->href);
            }
            else if(strpos($link->href, 'artist-')  !== false){
                $this->saveStartPath(self::MLDB_ORG.$link->href);
            }
        }
    }

    public function scrapeStartPath($url){
        $html = file_get_html($url);
        foreach ($html->find('a') as $link) {
            if(strpos($link->href, 'song-') !== false){
                $this->saveTrackUrl($link->href);
            }
            else if(strpos($link->href, 'artist-')  !== false || strpos($link->href, 'album-')  !== false){
                $this->saveStartPath(self::MLDB_ORG.$link->href);
            }
        }   
    }

    public function getTrackDetails($url){
        $html = file_get_html($url);

        $artist = new Artist();
        $album = new Album();
        $track = new Track();
        $track->lyrics = $html->find('p.songtext', 0)->plaintext;
        foreach ($html->find('a') as $link) {
            if(strpos($link->href, 'artist-') !== false && strpos($link->style, 'font-size:14') !== false){
                $artist->name = trim($link->plaintext);
                if(empty($artist->name)) {
                    return;
                }
                $this->saveStartPath(self::MLDB_ORG.$link->href);
            }
            if(strpos($link->href, 'album-') !== false && strpos($link->style, 'font-size:14px') !== false){
                $album->name = trim($link->plaintext);
                $this->saveStartPath(self::MLDB_ORG.$link->href);
                break;
            }
        }
        foreach ($html->find('h1') as $header) {
            if(strpos($header->plaintext, 'lyrics') !== false){
                $track->name = trim(str_replace('lyrics', '', $header->plaintext));
            }
        }

        $artistRepository = $this->entityManager->getRepository('MusicJelly\Entities\Artist');
        $artist = $artistRepository->save($artist);
        $albumRepository = $this->entityManager->getRepository('MusicJelly\Entities\Album');
        $album->artist = $artist;
        $album = $albumRepository->save($album);
        
        $trackRepository = $this->entityManager->getRepository('MusicJelly\Entities\Track');
        $track->artist = $artist;
        $track->album = $album;
        if(!$trackRepository->exists($track)) {
            $track->url = $this->getYoutubeUrl(sprintf('%s, %s',$artist->name, $track->name));
            if($track->url != null){
                $trackRepository->save($track);
            }
        }
    }

    public function saveTrackUrl($path){
        $url= self::MLDB_ORG.$path;
        $mldbTrackRepository = $this->entityManager->getRepository('MusicJelly\Entities\MldbTrack');
        $mldbTrack = new MldbTrack();
        $mldbTrack->url = $url;
        $mldbTrackRepository->save($mldbTrack);

    }

    public function saveStartPath($url){
        $startPathRepository = $this->entityManager->getRepository('MusicJelly\Entities\StartPath');
        $startPath = new StartPath();
        $startPath->url = $url;
        $startPathRepository->save($startPath);

    }

    public function getYoutubeUrl($term){
         // Call set_include_path() as needed to point to your client library.  
  
 
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