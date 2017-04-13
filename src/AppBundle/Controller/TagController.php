<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Tag;

class TagController extends Controller{
    /**
     * @Route("/tags/list",name="tags_list")
     */
    public function listAction(Request $request){
        $tagRepository = $this->getDoctrine()->getRepository('AppBundle:Tag');
        $tags = $tagRepository->findAll();

        $argsArray = [
            'tags' => $tags
        ];

        $templateName = 'tags/list';
        return $this->render($templateName.'.html.twig', $argsArray);
    }

    /**
     * @Route("/tags/index",name="tags_index")
     */
    public function indexAction(Request $request){
        $tagRepository = $this->getDoctrine()->getRepository('AppBundle:Tag');
        $tags = $tagRepository->findAll();

        $argsArray = [
            'tags' => $tags
        ];

        $templateName = 'tags/index';
        return $this->render($templateName.'.html.twig', $argsArray);
    }
    /**
     * @param Tag $tag
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Tag $tag){
        //entity manager
        $em = $this->getDoctrine()->getManager();
        //tell Doctrine dwant to save Tag
        $em->persist($tag);
        //actually executes queries
        $em->flush();

        return $this->redirectToRoute('tags_list');
    }

    /**
     * @Route("tags/delete/{id}")
     */
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $tagRepository = $this->getDoctrine()->getRepository('AppBundle:Tag');

        $tag = $tagRepository->find($id);
        $em->remove($tag);
        $em->flush();

        return new Response('Deleted tag with id'.$id);
    }

    /**
     * @Route("tags/update/{id}/{newName}")
     */
    public function update($id, $newName){
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository("AppBundle:Tag")->find($id);

        if(!$tag){
            throw $this->createNotFoundException("No tag found for id".$id);
        }
        $tag->setName($newName);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/tags/show/{id}",name="tags_show")
     */
    public function showAction($id){
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('AppBundle:Tag')->find($id);

        if(!$tag){
            throw $this->createNotFoundException('No tag found for id '.$id);
        }

        $argsArray =[
            'tag' => $tag
        ];

        $templateName = 'tag/show';
        return $this->render($templateName.'.html.twig',$argsArray);
    }

    /**
     * @Route("/tags/new",name="tags_new_form")
     */
    public function newFormAction(Request $request){
        //create a task and give it some dummy data
        $tag = new Tag();

        $form = $this->createFormBuilder($tag)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label'=>'Create Tag'))
            ->getForm();

        //start process POST submission of form
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $tag = $form->getData();
            return $this->createAction($tag);
        }

        $argsArray=[
            'form' => $form->createView(),
        ];

        $templateName = 'tags/new';
        return $this->render($templateName.'.html.twig',$argsArray);
    }

    /**
     * @Route("/tags/processNewForm",name="tags_process_new_form")
     */
    public function processNewFormAction(Request $request)
    {
        //extrace 'name' parameter from POST data
        $name = $request->request->get('name');

        if (empty($name)) {
            $this->addFlash(
                'error',
                'tag name cannot be an empty'
            );
            //forward this to the createdAction() method
            return $this->newFormAction($name);
        }
        //forward this to the createAction() method
        return $this->createAction($name);
    }
}