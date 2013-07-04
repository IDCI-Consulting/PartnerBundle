<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\PartnerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\PartnerBundle\Entity\Partner;
use IDCI\Bundle\PartnerBundle\Entity\Offer;
use IDCI\Bundle\PartnerBundle\Entity\SocialLink;
use IDCI\Bundle\PartnerBundle\Entity\Location;
use IDCI\Bundle\PartnerBundle\Form\PartnerType;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Partner controller.
 *
 * @Route("/partner/partner")
 */
class PartnerController extends Controller
{
    /**
     * Lists all Partner entities.
     *
     * @Route("/", name="admin_partner_partner")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('IDCIPartnerBundle:Partner')->findAll();

        $adapter = new ArrayAdapter($entities);
        $pager = new PagerFanta($adapter);
        $pager->setMaxPerPage($this->container->getParameter('max_per_page'));

        try {
            $pager->setCurrentPage($request->query->get('page', 1));
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        return array(
            'pager' => $pager,
        );
    }

    /**
     * Finds and displays a Partner entity.
     *
     * @Route("/{id}/show", name="admin_partner_partner_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:Partner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Partner entity.
     *
     * @Route("/new", name="admin_partner_partner_new")
     * @Template()
     */
    public function newAction()
    {
        $entity  = new Partner();
        $entity->addOffer(new Offer());
        $entity->addSocialLink(new SocialLink());
        $entity->addLocation(new Location());
        $form = $this->createForm(new PartnerType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Partner entity.
     *
     * @Route("/create", name="admin_partner_partner_create")
     * @Method("POST")
     * @Template("IDCIPartnerBundle:Partner:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Partner();
        $form = $this->createForm(new PartnerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'Partner',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('admin_partner_partner_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Partner entity.
     *
     * @Route("/{id}/edit", name="admin_partner_partner_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:Partner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partner entity.');
        }

        $editForm = $this->createForm(new PartnerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Partner entity.
     *
     * @Route("/{id}/update", name="admin_partner_partner_update")
     * @Method("POST")
     * @Template("IDCIPartnerBundle:Partner:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:Partner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partner entity.');
        }

        $originalFields = array();

        $partnerFields = array(
            "offers"      => $entity->getOffers(),
            "socialLinks" => $entity->getSocialLinks(),
            "locations"   => $entity->getLocations()
        ); 

        // Create an array of the current Offer/SocialLink/Location objects in the database
        foreach ($partnerFields as $key => $field) {
            foreach ($field as $element) {
              $originalFields[$key][] = $element;
            }
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PartnerType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {

            // filter $originalFields to contain offers/socialLinks/locations no longer present
            foreach ($partnerFields as $fieldKey => $field) {
                foreach ($field as $element) {
                    if(isset($originalFields[$fieldKey])) {
                        foreach ($originalFields[$fieldKey] as $key => $toDel) {
                            if ($toDel->getId() === $element->getId()) {
                                unset($originalFields[$fieldKey][$key]);
                            }
                        }
                    }
                }
            }

            // remove the relationship between the offer/socialLink/location and the Partner
            foreach ($partnerFields as $key => $field) {
                if(isset($originalFields[$key])) {
                    foreach ($originalFields[$key] as $element) {
                        // remove the offer
                        $em->remove($element);
                    }
                }
            }

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                    '%entity%' => 'Partner',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('admin_partner_partner_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Partner entity.
     *
     * @Route("/{id}/delete", name="admin_partner_partner_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIPartnerBundle:Partner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Partner entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'Partner',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('admin_partner_partner'));
    }

    /**
     * Display Partner deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:Partner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
