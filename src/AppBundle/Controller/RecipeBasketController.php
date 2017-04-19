<?php
/**
 * Created by PhpStorm.
 * User: BIJIN
 * Date: 28/03/2017
 * Time: 12:14
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RecipeBasketController
 * @package AppBundle\Controller
 *
 * @Route("/basket")
 */
class RecipeBasketController extends Controller{
    /**
     * @Route("/",name="recipes_basket_index")
     */
    public function indexAction(){
        $argsArray = [
        ];

        $templateName = "basket/index";
        return $this->render($templateName.'.html.twig',$argsArray);

    }

    /**
     * Lists all recipe entities.
     *
     * @Route("/list", name="recipes_basket_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('basket/list.html.twig', array(
            'recipes' => $recipes,
        ));
    }
    /**
     * @Route("/clear",name="recipes_basket_clear")
     */
    public function clearAction(){
        $session = new Session();
        $session->remove('basket');

        return $this->redirectToRoute('recipes_basket_index');
    }

    /**
     * Creates a new recipe entity.
     *
     * @Route("/new", name="recipes_basket_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm('AppBundle\Form\RecipeType', $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush($recipe);

            return $this->redirectToRoute('recipes_basket_index', array('id' => $recipe->getId()));
        }

        return $this->render('basket/new.html.twig', array(
            'recipe' => $recipe,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/add/{id}",name="recipes_basket_add")
     */
    public function addToRecipeCart(Recipe $recipe){
        //default - new empty array
        $recipes = [];

        //if no 'recipes' array in the session, add an empty array
        $session = new Session();
        if($session->has('basket')){
            $recipes = $session->get('basket');
        }
        //get ID of recipe
        $id = $recipe->getId();

        //only try to add to array if not already in the array
        if(!array_key_exists($id, $recipes)){
            //append $recipe to list
            $recipes[$id] = $recipe;

            //store updated array back into the session
            $session->set('basket', $recipes);
        }
        return $this->redirectToRoute('recipes_basket_index');
    }

    /**
     * @Route("/delete/{id}", name="recipes_basket_delete")
     */
    public function deleteAction(int $id){
        //default - new empty array
        $recipes = [];

        //if no 'recipre' array in the session, add an empty array
        $session = new Session();
        if($session->has('basket')){
            $recipes = $session->get('basket');
        }
        //only try to remove if it's in the array
        if(array_key_exists($id, $recipes)){
            //remove entry with $id
            unset($recipes[$id]);
            if(sizeof($recipes)<1){
                return $this->redirectToRoute('recipes_basket_clear');
            }
            //store updated array back into the session
            $session->set('basket',$recipes);
        }
        return $this->redirectToRoute('recipes_basket_index');
    }
}