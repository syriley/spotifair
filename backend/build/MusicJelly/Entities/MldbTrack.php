<?php

namespace MusicJelly\Entities;
use \DateTime;
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\MldbTrackRepository") 
 * @Table(name="mldbTracks")
 **/
class MldbTrack
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string", unique=true) **/
    public $url;

    /** @Column(type="date") **/
    public $created;

    /** @Column(type="date") **/
    public $completed;
    
    public function __construct(){
        $this->count = 1;
        $this->created = new DateTime();
        $this->completed = new DateTime('2000-01-01');

    }

    public function toDto(){
        $dto = clone $this;
        return $dto;
    }
}