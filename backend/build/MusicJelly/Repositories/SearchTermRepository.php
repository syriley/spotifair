<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use MusicJelly\Entities\SearchTerm;

class SearchTermRepository extends EntityRepository
{
    public function isAlreadySearched($term){
        $search = $this->findOneBy(array(
            'term' => $term
        ));
        if($search){
            $search->count++;
            $this->_em->persist($search);
            $this->_em->flush();
            return true;
        }
        else {
            $search = new SearchTerm();
            $search->term = $term;
            $this->_em->persist($search);
            $this->_em->flush();
        }

        return false;
    }

}