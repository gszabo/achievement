<?php

namespace Achie\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AchievementType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('required' => true, 'label' => 'Cím: '))
            ->add('description', 'textarea', array('required' => true, 'label' => 'Leírás: '))
            ->add('color', 'text', array('required' => false, 'data' => 'blue', 'label' => 'Szín: '))
            ->add('picture', 'text', array('required' => false, 'label' => 'Kép url: '))
            ->add('onetime', 'checkbox', array('required' => true, 'data' => true, 'label' => 'Egyszer megkapható? '))
            ->add('value', 'text', array('required' => false, 'label' => 'Értéke: '))
            ->add('level', null, array('required' => true, 'label' => 'Szint: '))
            ->add('category', null, array('required' => true, 'label' => 'Kategória: '))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Achie\FrontendBundle\Entity\Achievement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'achie_frontendbundle_achievement';
    }
}
