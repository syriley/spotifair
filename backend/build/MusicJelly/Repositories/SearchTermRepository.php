<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use MusicJelly\Entities\SearchTerm;

class SearchTermRepository extends Repository
{
    public function addTerm($term){
        $search = $this->findOneBy(array(
            'term' => $term
        ));
        if($search){
            $search->count++;
            $this->_em->persist($search);
            $this->_em->flush();
        }
        else {
            $search = new SearchTerm();
            $search->term = $term;
            $this->_em->persist($search);
            $this->_em->flush();
        }

    }

    public function getNewSearch(){
        return $this->findOneBy(
            array('complete' => false),
            array('id' => 'ASC')
        );
    }

}