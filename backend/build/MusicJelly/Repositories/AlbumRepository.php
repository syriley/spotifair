<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use MusicJelly\Entities\SearchTerm;

class AlbumRepository extends Repository
{
    public function save($album){
        if(empty($album->name)){
            return null;
        }
        $dbArtist = $this->findOneBy(array(
            'name' => $album->name)
        );
        if(!empty($dbArtist)){
            return $dbArtist;
        }

        $this->_em->persist($album);
        $this->_em->flush($album);
        return $album;
    }

}