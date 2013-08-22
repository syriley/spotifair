<?php

namespace MusicJelly\Entities;
// src/Product.php
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\ArtistRepository") 
 *
 * @Table(name="artists",
 *                uniqueConstraints={@UniqueConstraint(name="name_unique", columns={"name"})})
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