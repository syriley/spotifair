<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use MusicJelly\Entities\SearchTerm;

class ArtistRepository extends EntityRepository
{
    public function save($artist){
    	$dbArtist = $this->findOneBy(array(
    		'name' => $artist->name)
    	);
    	if(!empty($dbArtist)){
    		return $dbArtist;
    	}

        $this->_em->persist($artist);
        $this->_em->flush($artist);
        return $artist;
    }
}