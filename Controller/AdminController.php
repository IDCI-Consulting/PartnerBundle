<?php

namespace IDCI\Bundle\PartnerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Admin controller.
 *
 * @Route("/admin/partner")
 */
class AdminController extends Controller
{
    /**
     * Admin home action
     *
     * @Route("/", name="admin_partner")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
