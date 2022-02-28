<?php

namespace App\EventSubscriber;

use App\Controller\ApiController;
use App\Controller\TokenAuthenticatedController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class TokenSubscriber implements EventSubscriberInterface {

    private $tokens;

    public function __construct() {
        $this->tokens = [
            'user1' => 'token1',
            'user2' => 'token2'
        ];
    }

    public function beforeController(ControllerEvent $event) {
        $controller = $event -> getController();

        if(is_array($controller) && $controller[0] instanceOf TokenAuthenticatedController) {
            $token = $event -> getRequest() -> query -> get( key: 'token' );
            if(!in_array($token, $this -> tokens)) {
                throw new AccessDeniedHttpException( message: 'this needs a valid token' );
            }
        }

    }
    public static function getSubscribedEvents() {
        return [
            KernelEvents::CONTROLLER => 'beforeController'
        ];
    }
}