<?php
// src/BugRepository.php
namespace MusicJelly\Repositories;

use Doctrine\ORM\EntityRepository;
use MusicJelly\Entities\User;
use Doctrine\DBAL\DBALException;
use \Exception;

class UserRepository extends EntityRepository
{
	const SALT = 'nonce';

	public function register($email, $password){
		$passwordHash = $this->getPasswordHash($password);
		$user = new User($email, $passwordHash);

		try {
			$token = md5(date(DATE_RFC822).$email.$password);
			$user->token = $token;
		 	$this->_em->persist($user);
			$this->_em->flush();
		}
		catch (DBALException $e) {
			if(strpos($e->getMessage(), 'Duplicate entry') !== false) {
				throw new Exception('An email with that address already exists');
			}
			throw $e;
		}
       
		return $user;
	}

	public function findByToken($token){
		return $this->findOneBy(array('token' => $token));
	}

	public function findByEmailAndPassword($email, $password) {
		$passwordHash = $this->getPasswordHash($password);
		// var_dump($email);
		// var_dump($passwordHash);
		return $this->findOneBy(array(
			'email'    => $email,
			'password' => $passwordHash,
			)
		);	
	}

	public function unlock($userId, $socialMedia){
		$user = $this->find($userId);
		$videosToUnlock = 0;
		switch ($socialMedia) {
			case 'plusone':
				$videosToUnlock = 3;
				$user->plusone = true;
				break;
			case 'facebook':
				$videosToUnlock = 5;
				$user->facebook = true;
				break;
			case 'twitter':
				$videosToUnlock = 7;
				$user->twitter = true;
				break;
			case 'paypal':
				$videosToUnlock = 20;
				$user->paypal = true;
				break;
		}
		$user->numberOfLoops += $videosToUnlock;
		$this->_em->persist($user);
		$this->_em->flush();
		return $user;
	}

	public function getPasswordHash($password){
		return md5(self::SALT.$password);
	}

}