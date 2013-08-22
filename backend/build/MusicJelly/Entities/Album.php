<?php

namespace MusicJelly\Entities;
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\AlbumRepository") 
 * @Table(name="albums")
 **/
class Album
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string", unique=true) **/
    public $name;
    /** 
     *  @ManyToOne(targetEntity="MusicJelly\Entities\Artist", fetch="EAGER")
     */
    public $artist;
    

    public function toDto(){
        $dto = clone $this;
        return $dto;
    }
}