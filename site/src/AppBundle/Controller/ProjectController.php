<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 20/02/2018
 * Time: 13:23
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ProjectType;
use AppBundle\Manager\ProjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectController extends Controller
{
    /**
     * @Route("/projects", name="project_list")
     * @param ProjectManager $projectManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(ProjectManager $projectManager)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findAll();
        if (!$articles) {
            $this->errorAction($articles);
        }
        return $this->render('project/list.html.twig', ['articles' => $articles]);

        $projects= $projectManager->getProjects();
        return $this->render('project/list.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/projects/{id}", name="project_view", requirements={"id"="\d+"})
     * @param int $id
     * @return mixed
     */
    public function viewAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        if (!$article) {
            $this->errorAction($article);
        }
        $this->generateUrl('project_view', ['id' => $article->getId()]);
        return $this->render('project/view.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/projects/add", name="project_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(ProjectType::class, $article);
        $form->handleRequest($request);
        if (!$form) {
            $this->errorAction($article);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('project_list');

        }
        return $this->render('project/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/projects/edit/{id}", name="project_edit")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        if (!$article) {
            $this->errorAction($article);
        }
        $form = $this->createForm(ProjectType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('project_list');
        }
        return $this->render('project/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $article
     * @return void
     */
    private function errorAction($article)
    {
        throw new NotFoundHttpException('404, Article not found.');
        throw new BadRequestHttpException('400, Bad request.');
        throw new HttpException('404', 'Article not found');
    }
}