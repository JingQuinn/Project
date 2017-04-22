<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class AdminController
 * @package AppBundle\Controller
 *
 * @Route("/admin")
 */
class AdminController extends Controller{
    /**
     * @Route("/",name="admin_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request){
        $templateName = '/admin/index';
        return $this->render($templateName.'.html.twig');
    }

}