<?php
/**
 * Created by IntelliJ IDEA.
 * User: dmansuy
 * Date: 22/02/2018
 * Time: 14:19
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Manager\ProjectManager;
use AppBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @Route("/projects/addUser", name="project_addUser")
     * @param Request $request
     * @param UserManager $userManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addUserAction(Request $request, UserManager $userManager)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if (!$form) {
            $this->errorAction($user);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->createUser($form->getData());
            return $this->redirectToRoute('project_list');
        }
        return $this->render('project/addUser.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $user
     * @return void
     */
    private function errorAction($user)
    {
        throw new NotFoundHttpException('404, Article not found.');
        throw new BadRequestHttpException('400, Bad request.');
        throw new HttpException('404', 'Article not found');
    }
}