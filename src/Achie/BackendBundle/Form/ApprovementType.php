<?php

namespace Achie\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ApprovementType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('updatedAt')
            ->add('request')
            ->add('accepted')
            ->add('reason')
            ->add('createdBy')
            ->add('updatedBy')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Achie\FrontendBundle\Entity\Approvement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'achie_backendbundle_approvement';
    }
}
