<?php

namespace Acme\HappyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
 
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
 
/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{_locale}", name="_demo", defaults={ "_locale"="pl"})
     * @Template()
     */
    public function indexAction(Request $request)
    {   
        return array( );
    }

	/**
     * EMPTY FOR TEST
     */
}
