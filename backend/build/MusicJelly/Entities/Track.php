<?php

namespace MusicJelly\Entities;
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\TrackRepository") 
 * @Table(name="tracks")
 **/
class Track
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string") **/
    public $name;
    /** @Column(type="string") **/
    public $url;
    /** 
     *  @ManyToOne(targetEntity="MusicJelly\Entities\Artist", fetch="EAGER")
     */
    public $artist;

    /** 
     *  @ManyToOne(targetEntity="MusicJelly\Entities\Album", fetch="EAGER")
     */
    public $album;
    


    public function toDto(){
        $dto = clone $this;
        return $dto;
    }
}