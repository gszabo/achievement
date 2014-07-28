<?php

namespace Achie\BackendBundle\Form;

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
            ->add('name')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('color')
            ->add('picture')
            ->add('public')
            ->add('approved')
            ->add('onetime')
            ->add('max')
            ->add('value')
            ->add('createdBy')
            ->add('updatedBy')
            ->add('level')
            ->add('category')
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
        return 'achie_backendbundle_achievement';
    }
}
