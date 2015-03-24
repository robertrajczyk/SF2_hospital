<?php

namespace Acme\HappyBundle\Form;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
 

class EquipmentsType extends AbstractType
{
	public $ward_arry;
	
	function __construct( $ward_arry ) {
		$this->ward_arry = $ward_arry; 
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$ward_arry = $this->ward_arry;
	 
        $builder
            ->add('title')
            ->add('producer')
            ->add('typ')
            ->add('numbersr')
            ->add('numberinw')
            //->add('dateofreview')
            ->add('wardid','entity', array(
				 'class' => 'AcmeHappyBundle:Wards',  
					'query_builder' => function(EntityRepository $er) use($ward_arry) {
					return $er->createQueryBuilder('u')
						->andwhere('u.id IN (:miarray)') 
						->setParameter('miarray', $ward_arry)
						->orderBy('u.wardname', 'DESC');
				}, 
				'property' => 'wardname',
			)) 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\HappyBundle\Entity\Equipments'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_happybundle_equipments';
    }
}
