<?php

namespace Achie\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserGotAchievementType extends AbstractType
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
            ->add('reason')
            ->add('createdBy')
            ->add('updatedBy')
            ->add('user')
            ->add('achievement')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Achie\FrontendBundle\Entity\UserGotAchievement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'achie_backendbundle_usergotachievement';
    }
}
