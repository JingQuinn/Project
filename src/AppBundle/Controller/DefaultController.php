<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //create colours array
        $colours = [
            'foreground' => 'brown',
            'background' => 'lightyellow'
        ];

        //store colours in session 'colours'
        $session = new Session();
        $session->set('colours', $colours);

        //return $this->render('default/index.html.twig', [
          //  'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        //]);
        $argsArray = [
            'name' => 'Chinese'
        ];
        $templateName = 'index';
        return $this->render($templateName.'.html.twig',$argsArray);
    }
}
