<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tag controller.
 *
 * @Route("tag")
 */
class TagController extends Controller
{
    /**
     * Lists all tag entities.
     *
     * @Route("/", name="tag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AppBundle:Tag')->findAll();

        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
        ));
    }

    /**
     * Lists all tag entities.
     *
     * @Route("/list", name="tag_list")
     * @Method({"GET", "POST"})
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AppBundle:Tag')->findAll();

        return $this->render('tag/list.html.twig', array(
            'tags' => $tags,
        ));
    }

    /**
     * Lists all tag entities.
     *
     * @Route("/search", name="tag_search")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('AppBundle\Form\TagType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tag_edit', array('id' => $tag->getId()));
        }

        return $this->render('tag/search.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
        ));


        //$name = $this->getDoctrine()->getRepository('AppBundle:Tag')->find($id);
        //$recipe = $name->getRecipes()->getName();

        /*$em = $this->getDoctrine()->getManager();
        $query = $em->createQuery( 'SELECT * FROM AppBundle: Tag t JOIN t.Recipe r WHERE t.id=:id')->setParameter('id',$id);

        try{
            return $query->getResult();
        }catch(\Doctrine\ORM\NoResultException $e){
            return null;
        }*/

        //return $this->render('tag/search.html.twig', array(
          //  'tag' => $name,
           // 'delete_form' => $deleteForm->createView(),
        //));
    }
    /**
     * Creates a new tag entity.
     *
     * @Route("/new", name="tag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('AppBundle\Form\TagType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush($tag);

            return $this->redirectToRoute('tag_show', array('id' => $tag->getId()));
        }

        return $this->render('tag/new.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tag entity.
     *
     * @Route("/{id}", name="tag_show")
     * @Method("GET")
     */
    public function showAction(Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);

        return $this->render('tag/show.html.twig', array(
            'tag' => $tag,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/edit", name="tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);
        $editForm = $this->createForm('AppBundle\Form\TagType', $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tag_edit', array('id' => $tag->getId()));
        }

        return $this->render('tag/edit.html.twig', array(
            'tag' => $tag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tag entity.
     *
     * @Route("/{id}", name="tag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tag $tag)
    {
        $form = $this->createDeleteForm($tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush($tag);
        }

        return $this->redirectToRoute('tag_index');
    }

    /**
     * Creates a form to delete a tag entity.
     *
     * @param Tag $tag The tag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tag $tag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tag_delete', array('id' => $tag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
