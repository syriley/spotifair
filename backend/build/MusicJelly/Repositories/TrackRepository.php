<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;

class TrackRepository extends EntityRepository
{
	public function findLoopsForNumber($number=6){
		$loops = $this->findAll();

		return $loops;
	}

}