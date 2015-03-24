<?php

namespace Acme\HappyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\User\User; 
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\ORM\EntityRepository;
use Acme\HappyBundle\Entity\Wards;
use Acme\HappyBundle\Entity\Users;
use Acme\HappyBundle\Entity\Equipments;
use Acme\HappyBundle\Entity\UsersToWards;
use Acme\HappyBundle\Entity\EquipmentReviews;
use Acme\HappyBundle\Entity\EquipmentBreakdowns;

use Acme\HappyBundle\Form\WardsType;
use Acme\HappyBundle\Form\UsersType;
use Acme\HappyBundle\Form\EquipmentsType;
use Acme\HappyBundle\Form\UsersToWardsType;
use Acme\HappyBundle\Form\EquipmentReviewsType;
use Acme\HappyBundle\Form\EquipmentBreakdownsType;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Column\TextColumn;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;
use APY\DataGridBundle\Grid\Action\RowAction;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker; 


/**
 * @Route("/{_locale}/admin", defaults={ "_locale"="pl"})
 */
class SecuredController extends Controller
{ 
    /**
     * @Route("/hello/", name="_demo_secured")
     * @Template()
     */
    public function indexAction(Request $request)
    { 
        return array(  );
    }
	
    /**
     * @Route("/users/", name="_admin_users")
     * @Template()
     */
    public function usersAction(Request $request)
    {
        $source = new Entity('AcmeHappyBundle:Users');
		
		$wardColumn = new TextColumn(array('id' => 'lang',  'sortable' => false,'title' => '', 'size' => '80','filter' => false));

        $grid = $this->get('grid');
		
		$grid->addColumn($wardColumn, 12);
		 
        $em = $this->getDoctrine()->getManager();		
		 
		$source->manipulateRow (
            function ($row) use ($em)
            { 
				$res = "";
				$em = $this->getDoctrine()->getManager();
				 
				$roles_all = $em->getRepository('AcmeHappyBundle:UsersToWards')->findBy(array('userid'=>$row->getField("id")));
			 
				if(count($roles_all))
				{
					foreach($roles_all as $roles_u)
					{
						$res .= $roles_u->getWardid()->getWardname() ." \n";
					}
				}
				
                $row->setField('lang', $res);
				 
                return $row;
            }
        );
		
		$grid->setDefaultOrder('id', 'DESC');
		
        $grid->setSource($source);
		
		$rowAction2 = new RowAction($this->get('translator')->trans('Edycja'), '_admin_edituser', false, '_self');
        $grid->addRowAction($rowAction2);
        $rowAction = new RowAction($this->get('translator')->trans('Skasuj'), '_admin_deleteuser', true, '_self');
        $rowAction->setConfirmMessage($this->get('translator')->trans('Czy na pewno chcesz skasować ?'));
        $grid->addRowAction($rowAction);
		
		return $grid->getGridResponse('AcmeHappyBundle:Secured:users.html.twig');
    }
	
	/**
     * @Route( "/newuser",  name="_admin_newuser" )
     * @Template()
     */
    public function newuserAction(Request $request)
    {
		$entity = new Users();
        $form   = $this->createForm(new UsersType('create'), $entity );
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
			
			$entity->setRoles("ROLE_USER");
			$entity->setActive(1);
			$entity->setSalt(md5(time())); 
			$entity->setCreated( new \DateTime('now') );  

			$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
			$password_set = $encoder->encodePassword($entity->getPass(), $entity->getSalt());
			$entity->setPassword($password_set);
			 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Użytkownik dodany'));

            return $this->redirect($this->generateUrl('_admin_users'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
	}
	
	/** 
     * @Route( "/edituser/{id}", defaults={ "id"="0" }, name="_admin_edituser" )
     * @Template()
     */
    public function edituserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('AcmeHappyBundle:Users')->find($id);
		$entityUsersToWards = new UsersToWards();

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }
 
		$usertoward = $em->getRepository('AcmeHappyBundle:UsersToWards')->findBy(array('userid'=>$id));
			
		$usertowardForm = $this->createForm(new UsersToWardsType('create'), $entityUsersToWards );	
        $usertowardForm->handleRequest($request);
			
		$editForm = $this->createForm(new UsersType('create'), $entity );
        $editForm->handleRequest($request);

        if ($editForm->isValid())
        {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Zmiany zachowane'));

            return $this->redirect($this->generateUrl('_admin_edituser', array('id' => $id)));
        }
		
		if ($usertowardForm->isValid())
        {  
			$useren = $em->getRepository('AcmeHappyBundle:Users')->find($id);
			
			$entityUsersToWards->setUserid($useren); 
            $em->persist($entityUsersToWards);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Zmiany zachowane'));

            return $this->redirect($this->generateUrl('_admin_edituser', array('id' => $id)));
        }
		
        return array( 
            'entity'      => $entity,
			'usertoward' => $usertoward,
			'usertowardForm' => $usertowardForm->createView(),
            'form'   => $editForm->createView(),
        );
	 
	}
	
	/**
     * @Route( "/removeuserfromward/{id}", defaults={ "id"="0" }, name="_admin_removeuserfromward" )
     * @Template()
     */
    public function removeuserfromwardAction($id = 0)
    {
		$em = $this->getDoctrine()->getEntityManager();
     
		$foo = $em->getRepository('AcmeHappyBundle:UsersToWards')->findOneBy( array(  'id' => $id) );
		 
		if($foo)
		{
			$userid =  $foo->getUserid()->getId();
			
			$em->remove($foo);
			$em->flush();
			
            $this->get('session')->getFlashBag()->set('success', 'Użytkownik skasowany');
			return $this->redirect($this->generateUrl('_admin_edituser', array('id' => $userid)));
		}
		else
		{
            $this->get('session')->getFlashBag()->set('error', 'Błąd podczas operacji');
			return $this->redirect($this->generateUrl('_admin_users'));
		} 
	}
	
	/**
     * @Route( "/deleteuser/{id}", defaults={ "id"="0" }, name="_admin_deleteuser" )
     * @Template()
     */
    public function deleteuserAction($id = 0)
    {
		$em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();	
		
		$user = $em->getRepository('AcmeHappyBundle:Users')->findOneBy( array(  'id' => $id) );
		 
		if($user)
		{
			$em->remove($user);
			$em->flush();
			
            $this->get('session')->getFlashBag()->set('success', 'Użytkownik skasowany');
		}
		else
		{
            $this->get('session')->getFlashBag()->set('error', 'Błąd podczas operacji');
		}
		
		return $this->redirect($this->generateUrl('_admin_users'));
	}
	 
    /**
     * @Route("/equipments/", name="_admin_equipments")
     * @Template()
     */
    public function equipmentsAction(Request $request)
    { 
        $em = $this->getDoctrine()->getManager();	 
		$source = new Entity('AcmeHappyBundle:Equipments');
 
		$eq_Date = new TextColumn(array('id' => 'eq_date',  'safe'=>false, 'sortable' => false, 'title' => 'Ostatni przegląd', 'size' => '80','filter' => false));
      
        $grid = $this->get('grid');
		$grid->addColumn($eq_Date, 12);
		
		$source->manipulateRow(
			function ($row) use ($em)
			{  
					 
				$res = $em->getRepository('AcmeHappyBundle:EquipmentReviews')
					  ->findOneBy(
						 array('equipment'=> $row->getField("id")), 
						 array('reviewdate' => 'DESC')
					   );
			   
				if(isset($res))
				{
					$row->setField('eq_date', $rew_date );
				}
				else
				{
					$row->setField('eq_date', "-");
				}

				return $row;
			}
		);

        $em = $this->getDoctrine()->getManager();		

		$rowAction = new RowAction($this->get('translator')->trans('Szczegóły'), '_admin_detailsequipment', false, '_self');
        $grid->addRowAction($rowAction);
		$rowAction = new RowAction($this->get('translator')->trans('Edycja'), '_admin_editequipment', false, '_self'/*, array('type'=>'pencil fa fa-pencil fa-lg')*/);
        $grid->addRowAction($rowAction);
        $rowAction = new RowAction($this->get('translator')->trans('Skasuj'), '_admin_deleteequipment', true, '_self');
        $rowAction->setConfirmMessage($this->get('translator')->trans('Czy na pewno chcesz skasować ?'));
        $grid->addRowAction($rowAction);

		$grid->setDefaultOrder('title', 'ASC');

        $grid->setSource($source);
		return $grid->getGridResponse('AcmeHappyBundle:Secured:equipments.html.twig');
    }

	/**
     * @Route( "/newequipment",  name="_admin_newequipment" )
     * @Template()
     */
    public function newequipmentAction(Request $request)
    {
		$entity = new Equipments();

		$arr_utw = $this->getAllWards();  

		$form = $this
				->get('form.factory')
				->create(new EquipmentsType($arr_utw), $entity);
	
        $form->handleRequest($request);

        if ($form->isValid()) {
		
			$entity->setInserteddate(new \DateTime('now') ); 

            $em = $this->getDoctrine()->getManager(); 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Dodano sprzęt'));

            return $this->redirect($this->generateUrl('_admin_equipments'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
	}
	
	/**
     * @Route( "/editequipment/{id}", defaults={ "id"="0" }, name="_admin_editequipment")
     * @Template()
     */
    public function editequipmentAction(Request $request, $id)
    { 
        $em = $this->getDoctrine()->getManager();	
		$entity = $em->getRepository('AcmeHappyBundle:Equipments')->find($id);
		
		if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }

		$arr_utw = $this->getAllWards();  

		$form = $this
				->get('form.factory')
				->create(new EquipmentsType($arr_utw), $entity);
	  
        $form->handleRequest($request);

        if ($form->isValid()) {
		 
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Zmiany zachowano'));

            return $this->redirect($this->generateUrl('_admin_equipments'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
	}

	/**
     * @Route( "/deleteequipment/{id}", defaults={ "id"="0" }, name="_admin_deleteequipment" )
     * @Template()
     */
    public function deleteequipmentAction($id = 0)
    {
		$em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();	
		
		$equipment = $em->getRepository('AcmeHappyBundle:Equipments')->findOneBy( array(  'id' => $id) );

		if($equipment)
		{
			try{
				$em->remove($equipment);
				$em->flush();
				
				$this->get('session')->getFlashBag()->set('success', 'Sprzęt skasowany');
		 
			 } catch (\Exception $e) {
					 
					$this->get('session')->getFlashBag()->set('error', 'Błąd podczas operacji');
				} 
		}
		else
		{
            $this->get('session')->getFlashBag()->set('error', 'Sprzęt nie znaleziony');
		}
		
		return $this->redirect($this->generateUrl('_admin_equipments'));
	}	  
	
	
	/** 
     * @Route( "/detailsequipment/{id}", defaults={ "id"="0" }, name="_admin_detailsequipment" )
     * @Template()
     */
    public function detailsequipmentAction( $id)
    {
		$em = $this->getDoctrine()->getManager();	
		
		$equipment = $em->getRepository('AcmeHappyBundle:Equipments')->findOneBy( array(  'id' => $id) );
		
		if (!$equipment) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }

		//Breakdowns
			
			$gridBreakdowns = $this->get('grid');

			$itemsColumn = new TextColumn(array('id' => 'dateOfAccident_str', 'safe'=>false, 'type'=>'text',  'sortable' => false, 'title' => 'Data awarii', 'size' => '150' ));
			$gridBreakdowns->addColumn($itemsColumn, 2);
 
			$designColumn = new TextColumn(array('id' => 'dateOfDispatch_str', 'safe'=>false, 'type'=>'text',  'sortable' => false, 'title' => 'Data wysyłki', 'size' => '150' ));
			$gridBreakdowns->addColumn($designColumn, 3);

			$dataColumn = new TextColumn(array('id' => 'dataRecovery_str', 'safe'=>false, 'type'=>'text',  'sortable' => false, 'title' => 'Data naprawy', 'size' => '150' ));
			$gridBreakdowns->addColumn($dataColumn, 6);
			
			$sourceBreakdowns = new Entity('AcmeHappyBundle:EquipmentBreakdowns');
			$sourceBreakdowns->manipulateRow(
				function ($row) use ($id)
				{
					//DateTime field - date format
					if($row->getField("dateOfAccident"))
					{
						$form_date = $row->getField("dateOfAccident");
						if(is_object($form_date))
						$row->setField('dateOfAccident_str', $form_date->format('d-m-Y'));
					}
					
					if($row->getField("dateOfDispatch"))
					{
						$form_date = $row->getField("dateOfDispatch");
						if(is_object($form_date))
						$row->setField('dateOfDispatch_str', $form_date->format('d-m-Y'));
					}
					
					if($row->getField("dataRecovery"))
					{
						$form_date = $row->getField("dataRecovery");
						if(is_object($form_date))
						$row->setField('dataRecovery_str', $form_date->format('d-m-Y'));
					}
					
					if ($id == $row->getField("equipment.id"))
						return $row;
					else
						return null;
				
				}
			);
 
			$em = $this->getDoctrine()->getManager();		
	 
			$rowAction = new RowAction($this->get('translator')->trans('Edycja'), '_admin_editequipmentbreakdown', false, '_self' );
			$gridBreakdowns->addRowAction($rowAction);
			$rowAction = new RowAction($this->get('translator')->trans('Skasuj'), '_admin_removeequipmentbreakdowns', true, '_self');
			$rowAction->setConfirmMessage($this->get('translator')->trans('Czy na pewno chcesz skasować ?'));
			$gridBreakdowns->addRowAction($rowAction);

			$gridBreakdowns->setDefaultOrder('id', 'ASC');

			$gridBreakdowns->setSource($sourceBreakdowns);
			$gridBreakdowns->isReadyForRedirect();
			 
		//Reviews
			$sourceReviews = new Entity('AcmeHappyBundle:EquipmentReviews');
			
			$sourceReviews->manipulateRow(
				function ($row) use ($id)
				{
					//DateTime field - date format
					if($row->getField("reviewdate"))
					{
						$form_date = $row->getField("reviewdate");
						if(is_object($form_date))
						$row->setField('reviewdate_str', $form_date->format('d-m-Y'));
					}
					
					if ($id == $row->getField("equipment.id"))
						return $row;
					else
						return null;
				
				}
			);
			 
			$gridReviews = $this->get('grid');

			$itemsColumn = new TextColumn(array('id' => 'reviewdate_str', 'safe'=>false, 'type'=>'text',  'sortable' => false, 'title' => 'Data przeglądu', 'size' => '150' ));
			$gridReviews->addColumn($itemsColumn, 3);
			
			$em = $this->getDoctrine()->getManager();		
	 
			$rowAction = new RowAction($this->get('translator')->trans('Edycja'), '_admin_editequipmentreview', false, '_self'/*, array('type'=>'pencil fa fa-pencil fa-lg')*/);
			$gridReviews->addRowAction($rowAction);
			$rowAction = new RowAction($this->get('translator')->trans('Skasuj'), '_admin_removeequipmentreview', true, '_self');
			$rowAction->setConfirmMessage($this->get('translator')->trans('Czy na pewno chcesz skasować ?'));
			$gridReviews->addRowAction($rowAction);

			$gridReviews->setDefaultOrder('id', 'ASC');

			$gridReviews->setSource($sourceReviews);
			$gridReviews->isReadyForRedirect();
		 
		return $this->render('AcmeHappyBundle:Secured:detailsequipment.html.twig',   
		  
			array( 
				'gridBreakdowns'  => $gridBreakdowns,
				'gridReviews'	=> $gridReviews ,
				'id' => $id,
				'equipment' => $equipment
			)
		); 
	}
	
	/**
     * @Route( "/newequipmentreview/{id}", defaults={ "id"="0" },   name="_admin_newequipmentreview" )
     * @Template()
     */
    public function newequipmentreviewAction(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();	
		
		$equipment = $em->getRepository('AcmeHappyBundle:Equipments')->findOneBy( array(  'id' => $id));
		
		if (!$equipment) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
		}

		$entity = new EquipmentReviews();
        $form   = $this->createForm(new EquipmentReviewsType('create'), $entity );
        $form->handleRequest($request);

        if ($form->isValid()) {
		
			$entity->setEquipment( $equipment ); 
			
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Przegląd sprzętu został zapisany'));

            return $this->redirect($this->generateUrl('_admin_detailsequipment', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
	} 
	
	/**
     * @Route( "/editequipmentreview/{id}", defaults={ "id"="0" }, name="_admin_editequipmentreview" )
     * @Template()
     */
    public function editequipmentreviewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('AcmeHappyBundle:EquipmentReviews')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }

        $editForm = $this->createForm(new EquipmentReviewsType(), $entity );

        $editForm->handleRequest($request);

        if ($editForm->isValid())
        {   
			$equipmentid =  $entity->getEquipment()->getId();
			
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Zmiany zachowane'));

            return $this->redirect($this->generateUrl('_admin_detailsequipment', array('id' => $equipmentid)));
        }

        return array( 
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
	}
	
	/**
     * @Route( "/removeequipmentreview/{id}", defaults={ "id"="0" }, name="_admin_removeequipmentreview" )
     * @Template()
     */
    public function removeequipmentreviewAction($id = 0)
    {
		$em = $this->getDoctrine()->getEntityManager();
     
		$foo = $em->getRepository('AcmeHappyBundle:EquipmentReviews')->findOneBy( array(  'id' => $id) );

		if($foo)
		{
			$equipmentid =  $foo->getEquipment()->getId();
			
			$em->remove($foo);
			$em->flush();
			
            $this->get('session')->getFlashBag()->set('success', 'Przegląd skasowany');
			return $this->redirect($this->generateUrl('_admin_detailsequipment', array('id' => $equipmentid)));
		}
		else
		{
            $this->get('session')->getFlashBag()->set('error', 'Błąd podczas operacji');
			return $this->redirect($this->generateUrl('_admin_equipments'));
		} 
	}
	
	/**
     * @Route( "/newequipmentbreakdown/{id}", defaults={ "id"="0" },   name="_admin_newequipmentbreakdown" )
     * @Template()
     */
    public function newequipmentbreakdownAction(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();	
		
		$equipment = $em->getRepository('AcmeHappyBundle:Equipments')->findOneBy( array(  'id' => $id) );
		
		if (!$equipment) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }

		$entity = new EquipmentBreakdowns();
        $form   = $this->createForm(new EquipmentBreakdownsType('create'), $entity );
        $form->handleRequest($request);

        if ($form->isValid()) {
		
			$entity->setEquipment( $equipment ); 
			
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Awaria zapisana'));

            return $this->redirect($this->generateUrl('_admin_detailsequipment', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
	}
	
	/**
     * @Route( "/editequipmentbreakdown/{id}", defaults={ "id"="0" }, name="_admin_editequipmentbreakdown" )
     * @Template()
     */
    public function editequipmentbreakdownAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('AcmeHappyBundle:EquipmentBreakdowns')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }

        $editForm = $this->createForm(new EquipmentBreakdownsType(), $entity );

        $editForm->handleRequest($request);

        if ($editForm->isValid())
        {   
			$equipmentid =  $entity->getEquipment()->getId();
			
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Zmiany zachowane'));

            return $this->redirect($this->generateUrl('_admin_detailsequipment', array('id' => $equipmentid)));
        }

        return array( 
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
	}
	
	/**
     * @Route( "/removeequipmentbreakdowns/{id}", defaults={ "id"="0" }, name="_admin_removeequipmentbreakdowns" )
     * @Template()
     */
    public function removeequipmentbreakdownsAction($id = 0)
    {
		$em = $this->getDoctrine()->getEntityManager();
     
		$foo = $em->getRepository('AcmeHappyBundle:EquipmentBreakdowns')->findOneBy( array(  'id' => $id) );
		
		if($foo)
		{
			$equipmentid =  $foo->getEquipment()->getId();
			
			$em->remove($foo);
			$em->flush();
			
            $this->get('session')->getFlashBag()->set('success', 'Awaria skasowana');
			return $this->redirect($this->generateUrl('_admin_detailsequipment', array('id' => $equipmentid)));
		}
		else
		{
            $this->get('session')->getFlashBag()->set('error', 'Błąd podczas operacji');
			return $this->redirect($this->generateUrl('_admin_equipments'));
		} 
	}
	
    /**
     * @Route("/wards/", name="_admin_wards")
     * @Template()
     */
    public function wardsAction(Request $request)
    { 
        $em = $this->getDoctrine()->getManager();	
  
        $source = new Entity('AcmeHappyBundle:Wards');

		$grid = $this->get('grid');
		 
        $em = $this->getDoctrine()->getManager();		
 
		$rowAction = new RowAction($this->get('translator')->trans('Edycja'), '_admin_editward', false, '_self'/*, array('type'=>'pencil fa fa-pencil fa-lg')*/);
		$grid->addRowAction($rowAction);
		$rowAction = new RowAction($this->get('translator')->trans('Skasuj'), '_admin_deleteward', true, '_self');
		$rowAction->setConfirmMessage($this->get('translator')->trans('Czy na pewno chcesz skasować ?'));
		$grid->addRowAction($rowAction);
		
		$grid->setDefaultOrder('wardname', 'ASC');
		
        $grid->setSource($source);
		return $grid->getGridResponse('AcmeHappyBundle:Secured:wards.html.twig');
    }
	
	/**
     * @Route( "/editward/{id}", defaults={ "id"="0" }, name="_admin_editward" )
     * @Template()
     */
    public function editwardAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('AcmeHappyBundle:Wards')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('Nie znaleziono'));
        }

        $editForm = $this->createForm(new WardsType(), $entity );

        $editForm->handleRequest($request);

        if ($editForm->isValid())
        {  
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Zmiany zachowane'));

            return $this->redirect($this->generateUrl('_admin_wards', array('id' => $id)));
        }

        return array( 
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
	}
	
	/**
     * @Route( "/newward",  name="_admin_newward" )
     * @Template()
     */
    public function newwardAction(Request $request)
    {
		$entity = new Wards();
        $form   = $this->createForm(new WardsType('create'), $entity );
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Oddział zapisany'));

            return $this->redirect($this->generateUrl('_admin_wards'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
	}

	/**
     * @Route( "/deleteward/{id}", defaults={ "id"="0" }, name="_admin_deleteward" )
     * @Template()
     */
    public function deletewardAction($id = 0)
    {
		$em = $this->getDoctrine()->getEntityManager();
 
		$ward = $em->getRepository('AcmeHappyBundle:Wards')->findOneBy( array(  'id' => $id) );

		if($ward)
		{
			try{
				$em->remove($ward);
				$em->flush();
				
				$this->get('session')->getFlashBag()->set('success', 'Oddział skasowany');
		 
			 } catch (\Exception $e) {
					 
					$this->get('session')->getFlashBag()->set('error', 'Oddział nie jest pusty');
				} 
		}
		else
		{
            $this->get('session')->getFlashBag()->set('error', 'Oddział nie istanieje');
		}
		
		return $this->redirect($this->generateUrl('_admin_wards'));
	}
	 
	   
    /**
     * @Route("/login", name="_demo_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_demo_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/hello/admin/", name="_demo_secured_hello_admin")
     * @Template()
     */
    public function helloadminAction()
    {
        return array('name' => 'Hello');
    }	
	
    public function getAllWards()
    {
        $em = $this->getDoctrine()->getManager();
		
        $user = $this->getUser();	 
		$usertoward = $em->getRepository('AcmeHappyBundle:Wards')->findAll();
		$arr_utw = array();
		foreach($usertoward as $utw)
		{
			$arr_utw[] = $utw->getId();
		}
		
		return $arr_utw;
    } 
		
}
