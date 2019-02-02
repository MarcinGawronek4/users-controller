<?php

namespace App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class AuthenticationSuccessListener
{

    
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data['data'] = array(
            'id' => $user->getId(),
            'name' => $user->getName(),
            'role' => $user->getRole()->getName(),
            'deleted' => $user->getDeleted()

        );

        $event->setData($data);
    }
}