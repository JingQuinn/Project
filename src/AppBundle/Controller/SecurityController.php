<?php
/**
 * Created by PhpStorm.
 * User: BIJIN
 * Date: 28/03/2017
 * Time: 23:43
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{

    /**
     * login form
     *
     * @Route("/login", name="login")
     * @Method({"GET","POST"})
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $templateName = 'login';
        $argsArray = [
            'username' => $lastUsername,
            'error' => $error,

        ];

        return $this->render($templateName . '.html.twig', $argsArray);
    }


    private function createrLoginForm(User $user){
        return $this->createForm('AppBundle\Form\UserType',$user);
    }

    /**
     *
     * @Route("/logout",name="logout")
     */
    public function logoutAction(){
        $session = new Session();

        if($session->has('user')){
            $session->remove('user');
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function canAuthenticate(User $user){
        $username = $user->getUsername();
        $password = $user->getPassword();

        return ('admin' == $username)&&('admin'==$password);
    }
}