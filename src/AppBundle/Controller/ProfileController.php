<?php
/**
 * Created by PhpStorm.
 * User: BIJIN
 * Date: 13/04/2017
 * Time: 17:34
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfileController extends Controller
{
    /**
     * @Route("/profile",name="profile")
     */
    public function indexAction(Request $request){

        $templateName = 'profile';
        return $this->render($templateName.'.html.twig');
    }
}