<?php

namespace Acme\HappyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipmentReviewsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employee')
            ->add('reviewdate', 'date', array( 
					// this is actually the default format for single_text
					'format' => 'dd-MM-yyyy',
				)) 
            ->add('description') 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\HappyBundle\Entity\EquipmentReviews'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_happybundle_equipmentreviews';
    }
}
