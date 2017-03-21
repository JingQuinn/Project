<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Student;
class StudentController extends Controller
{
    /**
     * @Route("/students/list",name="students_list")
     */
    public function listAction(Request $request)
    {
        $studentRepository = $this->getDoctrine()->getRepository("AppBundle:Student");
        $students = $studentRepository->findAll();
        $argsArray = [
            'students' => $students
        ];
        $templateName = 'students/list';
        return $this->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @Route("students/create/{name}")
     */
    public function createAction(Student $student){
        //entity manager
        $em = $this->getDoctrine()->getManager();

        $em->persist($student);

        $em->flush();

        return $this->redirectToRoute('students_list');
    }

    /**
     * @Route("students/deleted/{id}")
     */
    public function deleteAction($id){
        //entity manager
        $em = $this->getDoctrine()->getManager();
        $studentRepository = $this->getDoctrine()->getRepository("AppBundle:Student");

        //find the student with this ID
        $student = $studentRepository->find($id);

        //tells Doctrine want to (eventually) delete the Student
        $em->remove($student);

        //actually executes the queries
        $em->flush();

        return new Response(';Deleted student with id'.$id);
    }

    /**
     * @Route("/students/update/{id}/{newName}")
     */
    public function updateAction($id,$newName){
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository("AppBundle:Student")->find($id);

        if(!$student){
            throw $this->createNotFoundException(
                'No student found for id'.$id
            );
        }

        $student->setName($newName);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/students/show/{id}", name="students_show")
     */
    public function showAction(Student $student)
    {
        /*$em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'No student found for id' . $id
            );
        }*/

        $templateName = 'students/show';
        $args = [
            'student' => $student
        ];
        return $this->render($templateName . '.html.twig', $args);
    }

    /**
     * @Route("/students/new",name="students_new_form")
     */
    public function newFormAction(Request $request){
        $student = new Student();

        $form = $this->createFormBuilder($student)
            ->add('name',TextType::class)
            ->add('save',SubmitType::class,array('label'=> 'Create Student'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $student = $form->getData();

            return $this->createAction($student);
        }
        $argsArray = [
            'form' => $form->createView(),
        ];

        $templateName = 'students/new';
        return $this->render($templateName.'.html.twig',$argsArray);
    }

    /**
     * @Route("/students/processNewForm",name="students_process_new_form")
     */
    public function processNewFormAction(Requet $request){
        $name = $request->request->get('name');

        if(empty($name)){
            $this->addFlash(
                'error',
                'student name cannot be an empty string'
            );
            return $this->newFormAction($request);
        }
        return $this->createAction($name);
    }
}