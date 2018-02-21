<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 21/02/2018
 * Time: 17:11
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ProjectManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getProjects()
    {
        return $this->em->getRepository(Article::class)->findAll();
    }
}