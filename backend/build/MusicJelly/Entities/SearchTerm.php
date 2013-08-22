<?php

namespace MusicJelly\Entities;
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\SearchTermRepository") 
 * @Table(name="searchedTerms")
 **/
class SearchTerm
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string") **/
    public $term;
    /** @Column(type="integer") **/
    public $count;
    
    public function __construct(){
        $this->count = 1;
    }

    public function toDto(){
        $dto = clone $this;
        return $dto;
    }
}