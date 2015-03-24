<?php

namespace Acme\HappyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
 
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Column\TextColumn;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;
use APY\DataGridBundle\Grid\Action\RowAction;

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

use Payum\Core\Request\BinaryMaskStatusRequest;
use Payum\Core\Request\GetHumanStatus;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
 * @Route("/{_locale}/account", defaults={ "_locale"="pl"})
 */
class AccountController extends Controller
{
	/**
     * EMPTY FOR TEST
     */
}
