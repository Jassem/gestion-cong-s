<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setRoles(['ROLE_EMPLOYEE']);
        $user->setUsername('yassine');
        $user->setIsAdmin(false);
        $user->setPassword($this->encoder->encodePassword($user, 'yassine*'));
        $manager->persist($user);

        $user = new User();
        $user->setRoles(['ROLE_EMPLOYEE']);
        $user->setUsername('ahmed');
        $user->setIsAdmin(false);
        $user->setPassword($this->encoder->encodePassword($user, 'ahmed*'));
        $manager->persist($user);

        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $user->setUsername('admin');
        $user->setIsAdmin(true);
        $user->setPassword($this->encoder->encodePassword($user, 'admin*'));
        $manager->persist($user);

        $manager->flush();
    }
}
