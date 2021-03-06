<?php

namespace AppBundle\Form;

use AppBundle\Repository\RecipeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;

class RecipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('summary');
        $builder->add('summaryImage', FIleType::class, array(
            'data_class' => null,
        ));
        $builder->add('steps');
        $builder->add('stepImage', FIleType::class, array(
            'data_class' => null,
        ));
        $builder->add('ingredients')->add('author');
        $builder->add('votDown', IntegerType::class,['attr'=>['step'=>'5','min'=>'-100','max'=>'0']]);
        $builder->add('votUp',IntegerType::class,['attr'=>['step'=>'5','min'=>'0','max'=>'100']])       ;
        $builder->add('tag',EntityType::class,[
            'placeholder'=>'Choose a Tag',
            'class'=>'AppBundle:Tag',
            //'query_builder'=>function(RecipeRepository $repo){
              //  return $repo->createAlphabeticalQueryBuilder();
            //}
            'choice_label'=>'name',
        ]);
        $builder->add('comment',EntityType::class,[
            'placeholder'=>'Choose a Comment',
            'class'=>'AppBundle:Comment',
            //'query_builder'=>function(RecipeRepository $repo){
            //  return $repo->createAlphabeticalQueryBuilder();
            //}
            'choice_label'=>'name',
        ]);
        /*$builder->add('comment', TextareaType::class, array(
            'attr' => array('class' => 'comment'),
        ));*/
        $builder->add('visibility', ChoiceType::class, array(
            'choices'  => array(
                'Private' => 0,
                'Public' => 1,
            ),
        ));
        $builder->add('createDate', DateType::class, array(
            'widget'=>'single_text',
        ));
        $builder->add('editDate', DateType::class, array(
            'widget'=>'single_text',
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recipe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_recipe';
    }


}
