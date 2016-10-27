<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Authenticator
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var EntityManager
     */
    protected $entityManager;


    /**
     * @var Session
     */
    private $session;

    /**
     * Authenticator constructor.
     * @param TokenStorage $tokenStorage
     * @param EntityManager $entityManager
     * @param Session $session
     */
    public function __construct(
        TokenStorage $tokenStorage,
        EntityManager $entityManager,
        Session $session
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->session = $session;
    }
    
    /**
     * @param User $user
     */
    public function addAuth(User $user)
    {
        $user->setLastLoginAt(new \DateTime('now'));
        $this->entityManager->flush();
        
        $token = new PreAuthenticatedToken($user, $user->getClid(), 'main', $user->getRoles());
        $this->tokenStorage->setToken($token);
        $this->session->set('_security_main', serialize($token));
    }
}
