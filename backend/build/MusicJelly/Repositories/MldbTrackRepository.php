<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use \DateTime;

class MldbTrackRepository extends Repository
{
    public function save($track){
        $dbMldbTrack = $this->findOneBy(array(
            'url' => $track->url)
        );
        if(!empty($dbMldbTrack)){
            return $dbMldbTrack;
        }

        parent::save($track);
        return $track;
    }

    public function getNext(){
        $dql = "SELECT m 
                FROM MusicJelly\Entities\MldbTrack m 
                WHERE m.completed < '2010-01-01'";
        $query = $this->_em->createQuery($dql);
        $query->setMaxResults(1);
        $result = $query->getResult();
        return $result[0];
    }

    public function setCompleted($track){
        $track->completed = new DateTime();
        parent::save($track);
    }
}