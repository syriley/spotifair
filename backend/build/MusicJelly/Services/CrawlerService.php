<?php

namespace MusicJelly\Services;

use Symfony\Component\HttpFoundation\Request;
use MusicJelly\Crawlers\MldbCrawler;
use \DateTime;

class CrawlerService extends Service {

    public function __construct($app){
        parent::__construct($app);
        $this->crawler = new MldbCrawler;
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->get('/', array($this, 'startCrawler'));

    }
    
    public function startCrawler(Request $request){
            
            //Check for any new searches
        for($i = 0; $i < 1000; $i++) {
            $this->checkNewSearches();
            $this->crawlStartPaths();
            $this->crawlMldbTracks();
            sleep(1);
        }
        return $this->app->json('complete');
    }

    public function checkNewSearches(){
        $this->debug('checking new searches');
        $searchTermRepository = $this->entityManager->getRepository('MusicJelly\Entities\SearchTerm');
        $searchTerm = $searchTermRepository->getNewSearch();
        if($searchTerm){
            $this->debug('search term is '.$searchTerm->term);
            $this->crawler->search($searchTerm->term);
            $searchTerm->complete = true;
            $searchTermRepository->save($searchTerm);
        }
    }

    public function crawlStartPaths(){
        $startPathRepository = $this->entityManager->getRepository('MusicJelly\Entities\StartPath');
        $startPath = $startPathRepository->getNext();
        if($startPath) {
            $this->debug('Scraping the startPath '.$startPath->url);
            $this->crawler->scrapeStartPath($startPath->url);
            $startPathRepository->setCompleted($startPath);
            
        }
    }

    public function crawlMldbTracks(){
        $mldbTrackRepository = $this->entityManager->getRepository('MusicJelly\Entities\MldbTrack');
        $mldbTrack = $mldbTrackRepository->getNext();
        if($mldbTrack) {
            $this->debug('Crawling '.$mldbTrack->url);
            $this->crawler->getTrackDetails($mldbTrack->url);
            $mldbTrackRepository->setCompleted($mldbTrack);

        }
    }

}