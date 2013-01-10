<?php

namespace IDCI\Bundle\PartnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api controller.
 *
 * @Route("/partner_api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/query", name="partner_api")
     */
    public function queryAction(Request $request)
    {
        $result = $this->get('idci_partner.manager')->query($request->query->all());

        $response = new Response();
        $response->setContent($result->getContent());
        $response->headers->set('Content-Type', $result->getContentType());

        return $response;
    }
}
