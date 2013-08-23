<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;

class TrackRepository extends Repository
{
    public function findLoopsForNumber($number=6){
        $loops = $this->findAll();

        return $loops;
    }

    public function save($track){
        $dbTrack = $this->findOneBy(array(
            'name' => $track->name)
        );
        if(!empty($dbTrack)){
            return $dbTrack;
        }

        $this->_em->persist($track);
        $this->_em->flush($track);
        return $track;
    }

    public function exists($track){
        $dql = "SELECT t 
                FROM MusicJelly\Entities\Track t 
                JOIN t.artist ar 
                JOIN t.album al 
                WHERE t.name = ?1
                    AND ar.name = ?2
                    AND al.name = ?3";

        $query = $this->_em->createQuery($dql);

        $query->setParameter(1, $track->name);
        $query->setParameter(2, $track->artist->name);
        if($track->album) {
            $query->setParameter(3, $track->album->name);
        }
        else {
            $query->setParameter(3, '');   
        }

        $tracks = $query->getResult();
        if(count($tracks) > 0){
            return true;
        }
        return false;
    }

    public function search($term){
         $dql = "SELECT t 
                FROM MusicJelly\Entities\Track t 
                JOIN t.artist ar 
                JOIN t.album al 
                WHERE t.name like ?1
                    OR ar.name like ?1
                    OR al.name like ?1";

        $query = $this->_em->createQuery($dql);
        $query->setMaxResults(20);

        $query->setParameter(1, '%'.$term.'%');
        return $query->getResult();
        
    }
}