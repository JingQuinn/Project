<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RecipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('summary')->add('steps')->add('ingredients')->add('author')->add('votDown')->add('votUp')       ;
        $builder->add('tag',EntityType::class,[
            'class'=>'AppBundle:Tag',
            'choice_label'=>'name',
        ]);
        /*$builder->add('comment',TextareaType::class,array(
            'attr'=>array('class'=>'comment'),
        ));*/

        $builder->add('visibility', ChoiceType::class, array(
            'choices'  => array(
                'Private' => 0,
                'Public' => 1,
            ),
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
