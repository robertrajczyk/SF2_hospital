<?php

namespace Acme\HappyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersToWardsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    
		$builder 
			->add('wardid','entity', array(
				'class' => 'AcmeHappyBundle:Wards',
				'property' => 'wardname',
			));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\HappyBundle\Entity\UsersToWards'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_happybundle_userstowards';
    }
}
