<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 21/02/2018
 * Time: 13:28
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category
            ->setLabel('Toto');
        $manager->persist($category);
        $manager->flush();

        $this->addReference('category-ref', $category);
    }
}