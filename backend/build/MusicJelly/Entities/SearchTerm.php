<?php

namespace MusicJelly\Entities;

use \DateTime;
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\SearchTermRepository") 
 * @Table(name="searchedTerms")
 **/
class SearchTerm
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string", unique=true) **/
    public $term;
    /** @Column(type="integer") **/
    public $count;
    /** @Column(type="date") **/
    public $created;
    /** @Column(type="boolean") **/
    public $complete;
    
    public function __construct(){
        $this->complete = false;
        $this->count = 1;
        $this->created = new DateTime();
    }

    public function toDto(){
        $dto = clone $this;
        return $dto;
    }
}