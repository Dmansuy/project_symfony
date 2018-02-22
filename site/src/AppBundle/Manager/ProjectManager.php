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

    public function getArticles()
    {
        return $this->em->getRepository(Article::class)->findAll();
    }

    public function getArticle(int $id)
    {
        return $this->em->getRepository(Article::class)->find($id);
    }

    /*public function createArticle()
    {
        $article = new Article();
        return $this->em->createForm(ProjectType::class, $article);
    }*/
}