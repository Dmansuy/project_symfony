<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 20/02/2018
 * Time: 13:23
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Form\ProjectType;
use AppBundle\Form\UserType;
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
        $projects= $projectManager->getArticles();
        if (!$projects) {
            $this->errorAction($projects);
        }
        return $this->render('project/list.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/projects/{id}", name="project_view", requirements={"id"="\d+"})
     * @param ProjectManager $projectManager
     * @param int $id
     * @return mixed
     */
    public function viewAction(ProjectManager $projectManager, int $id)
    {
        $project= $projectManager->getArticle($id);
        if (!$project) {
            $this->errorAction($project);
        }
        $this->generateUrl('project_view', ['id' => $project->getId()]);
        return $this->render('project/view.html.twig', ['article' => $project]);
    }

    /**
     * @Route("/projects/add", name="project_add")
     * @param Request $request
     * @param ProjectManager $projectManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, ProjectManager $projectManager)
    {
        $article = new Article();
        $form = $this->createForm(ProjectType::class, $article);
        $form->handleRequest($request);
        if (!$form) {
            $this->errorAction($article);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager();
            $projectManager->createArticle($form->getData());
            return $this->redirectToRoute('project_list');
        }
        return $this->render('project/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/projects/subscribe", name="project_subscribe")
     * @param Request $request
     * @param ProjectManager $projectManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addUserAction(Request $request, ProjectManager $projectManager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if (!$form) {
            $this->errorAction($user);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager();
            $projectManager->createUser($form->getData());
            return $this->redirectToRoute('project_list');
        }
        return $this->render('project/subscribe.html.twig', ['form' => $form->createView()]);
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