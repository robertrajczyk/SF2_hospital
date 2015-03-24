<?php

namespace Acme\HappyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipmentBreakdownsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateOfAccident', 'date', array( 
					// this is actually the default format for single_text
					'format' => 'dd-MM-yyyy',
				)) 
            ->add('descriptionDamage')
            ->add('dateOfDispatch', 'date', array(   
					'format' => 'dd-MM-yyyy',
					'required' => false,
				)) 
            ->add('dataRecovery', 'date', array(   
					'format' => 'dd-MM-yyyy',
					'required' => false,
				)) 
            ->add('serviceData')
            ->add('warranty')
            ->add('costs')
            ->add('comments') 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\HappyBundle\Entity\EquipmentBreakdowns'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_happybundle_equipmentbreakdowns';
    }
}
