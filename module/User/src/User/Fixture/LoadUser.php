<?php

/**
 * Created by PhpStorm.
 * User: koga
 * Date: 03/02/16
 * Time: 21:02
 */
namespace User\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUser
 * @package User\Entity
 */
class LoadUser extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNome("Koga")
            ->setEmail("brunokoga187@koga187.com")
            ->setPassword(123456)
            ->setActive(true);

        $manager->persist($user);
        $manager->flush();
    }
}