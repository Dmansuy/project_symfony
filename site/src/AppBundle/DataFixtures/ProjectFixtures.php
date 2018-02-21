<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 20/02/2018
 * Time: 11:42
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article
            ->setName('Article #1')
            ->setDescription('Lorem ipsum dolor sit amet.')
            ->setPrice(random_int(0, 100))
            ->setLabel('Toto')
            ->setCategory($this->getReference('category-ref'));
        $manager->persist($article);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
        );
    }
}