<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 22/02/2018
 * Time: 09:37
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = (new User())->setEmail('user@test.fr')
            // password : bcrypt('password')
            ->setPassword('$2y$10$LlPMShQH0oM1pYY1UvRCDuVI8Rin8bMhHoSgXinF48dqSsKdJ5LAa');
        $manager->persist($user);
        $manager->flush();
    }
}