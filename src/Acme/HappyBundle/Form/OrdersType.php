<?php

namespace Acme\HappyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {  
	
		$countries = [	'Albania'=>'Albania',
						'Andorra'=>'Andorra',
						'Austria'=>'Austria',
						'Azerbaijan'=>'Azerbaijan',
						'Belarus'=>'Belarus',
						'Belgium'=>'Belgium',
						'Bosnia and Herzegovina'=>'Bosnia and Herzegovina',
						'Bulgaria'=>'Bulgaria',
						'Croatia'=>'Croatia',
						'Cyprus'=>'Cyprus',
						'Czech Republic'=>'Czech Republic',
						'Denmark'=>'Denmark',
						'Estonia'=>'Estonia',
						'Finland'=>'Finland',
						'France'=>'France',
						'Georgia'=>'Georgia',
						'Germany'=>'Germany',
						'Greece'=>'Greece',
						'Hungary'=>'Hungary',
						'Iceland'=>'Iceland',
						'Italy'=>'Italy',
						'Kazakhstan'=>'Kazakhstan',
						'Latvia'=>'Latvia',
						'Liechtenstein'=>'Liechtenstein',
						'Lithuania'=>'Lithuania',
						'Luxembourg'=>'Luxembourg',
						'Macedonia'=>'Macedonia',
						'Malta'=>'Malta',
						'Moldova'=>'Moldova',
						'Monaco'=>'Monaco',
						'Montenegro'=>'Montenegro',
						'Netherlands'=>'Netherlands',
						'Norway'=>'Norway',
						'Poland'=>'Poland',
						'Portugal'=>'Portugal',
						'Republic of Ireland'=>'Republic of Ireland',
						'Romania'=>'Romania',
						'San Marino'=>'San Marino',
						'Serbia'=>'Serbia',
						'Slovakia'=>'Slovakia',
						'Slovenia'=>'Slovenia',
						'Spain'=>'Spain',
						'Sweden'=>'Sweden',
						'Switzerland'=>'Switzerland',
						'Turkey'=>'Turkey',
						'Ukraine'=>'Ukraine',
						'United Kingdom'=>'United Kingdom',
						'Vatican City'=>'Vatican City']; 
		
 
        $builder
			->add('name', 'text', array( 'label'    => 'Your Name', ))
            ->add('address', 'text', array(  ))
            ->add('county', 'text', array(  ))
			->add('country', 'choice', [
					'label'    => 'Country',
					'required' => true,
					'choices'  => $countries,
            ])
			
            ->add('city', 'text', array(  ))
			->add('zip', 'text', array( ) )
            ->add('address', 'text', array(  )) 
			
        ; 
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\HappyBundle\Entity\Orders',
            '_locale' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_happybundle_orders';
    }
}
