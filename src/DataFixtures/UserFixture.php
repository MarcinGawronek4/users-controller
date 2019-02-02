<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixture extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
        $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        
        for ($i = 0; $i < 20; $i++) {
        $user = new User();
        $user->setLogin('andrzej'.$i);
        $user->setName('Andrzej '.$i);
        $user->setSurname('Nowak '.$i);
        $user->setDateOfBirth(new \DateTime('1990-01-01'));
        $user->setDeleted(false);
        $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         'root'
                     ));
        $manager->persist($user);
        
                    }
        $manager->flush();
    }
}
