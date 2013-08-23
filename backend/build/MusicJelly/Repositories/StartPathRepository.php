<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use \DateTime;

class StartPathRepository extends Repository
{
    public function save($startPath){
        $dbStartPath = $this->findOneBy(array(
            'url' => $startPath->url)
        );
        if(!empty($dbStartPath)){
            return $dbStartPath;
        }

        parent::save($startPath);
        return $startPath;
    }

    public function getNext(){
        $dql = "SELECT s
                FROM MusicJelly\Entities\StartPath s 
                WHERE s.completed < '2010-01-01'";

        $query = $this->_em->createQuery($dql);
        $query->setMaxResults(1);
        $result = $query->getResult();
        return $result[0];
    }

    public function setCompleted($startPath){
        $startPath->completed = new DateTime();
        parent::save($startPath);
    }
}