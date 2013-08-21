<?php

namespace MusicJelly\Services;

use Symfony\Component\HttpFoundation\Request;

class UserService extends Service {

	public function __construct($app){
		parent::__construct($app);
	}

	public function addEndpoints(){
		$app = $this->app;
		$app->post('/users/unlock', array($this, 'unlock'));
		$app->post('/users', array($this, 'all'));

	}
	
	public function unlock(Request $request){
		$userRepository = $this->entityManager->getRepository('MusicJelly\Entities\User');
		$socialMedia = $request->get('socialMedia');
		$userId = $request->get('userId');
		
		$user = $userRepository->unlock($userId, $socialMedia);

	    return $this->app->json($user->toDto());
	}

	public function all(Request $request){
		$userRepository = $this->entityManager->getRepository('MusicJelly\Entities\User');
		$email = $request->get('email');
		$password = $request->get('password');
		$user = $userRepository->register($email, $password);

	    return $this->app->json($user->toDto());
	}
}