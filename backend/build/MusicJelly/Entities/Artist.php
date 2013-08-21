<?php

namespace MusicJelly\Entities;
// src/Product.php
/**
 * @Entity @Table(name="artists")
 **/
class Artist
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string") **/
    public $name;
    /*
     * @OneToMany(targetEntity="MusicJelly\Entities\Track")
     */
    public $songs;

    public function toDto(){
    	return (object)array('name' => $this->name);
    }
}