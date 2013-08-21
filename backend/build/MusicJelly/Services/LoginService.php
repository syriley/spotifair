<?php

namespace MusicJelly\Services;

use Symfony\Component\HttpFoundation\Request;

class LoginService extends Service {

    public function __construct($app){
        parent::__construct($app);
    }

    public function addEndpoints(){
        $app = $this->app;
        $app->post('/login', array($this, 'login'));

    }
    
    public function login(Request $request){
        $userRepository = $this->entityManager->getRepository('MusicJelly\Entities\User');
        $email = $this->getParameter('email');
        $password = $this->getParameter('password');
        $user = $userRepository->findByEmailAndPassword($email, $password);
        if(!$user) {
            throw new Exception('Your email and password are incorrect');
        }

        return $this->app->json($user->toDto());
    }

}