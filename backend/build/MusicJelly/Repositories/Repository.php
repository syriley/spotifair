<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;

class Repository extends EntityRepository
{
    public function save($entity){
        $this->_em->persist($entity);
        $this->_em->flush($entity);
        return $entity;
    }

}