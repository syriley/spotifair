<?php

namespace MusicJelly\Entities;
/**
 * @Entity(repositoryClass="MusicJelly\Repositories\UserRepository") 
 * @Table(name="users", 
 *        uniqueConstraints={@UniqueConstraint(name="email_unique", columns={"email"})})
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string") **/
    public $email;
    /** @Column(type="string") **/
    public $password;
    /** @Column(type="string") **/
    public $token;
    /** @Column(type="integer") **/
    public $numberOfLoops;
    /** @Column(type="boolean") **/
    public $plusone;
    /** @Column(type="boolean") **/
    public $facebook;
    /** @Column(type="boolean") **/
    public $twitter;
    /** @Column(type="boolean") **/
    public $paypal;

    public function __construct($email, $password, $numberOfLoops=8){
        $this->email    = $email;
        $this->password = $password;
        $this->numberOfLoops = $numberOfLoops;
        $this->plusone  = false;
        $this->facebook = false;
        $this->twitter  = false;
        $this->paypal   = false;

    }

    public function toDto(){
        $dto = clone $this;
        $dto->password = '';
        return $dto;
    }
}