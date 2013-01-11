<?php

namespace IDCI\Bundle\PartnerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\PartnerBundle\Entity\SocialLink;
use IDCI\Bundle\PartnerBundle\Form\SocialLinkType;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * SocialLink controller.
 *
 * @Route("/admin/partner/sociallink")
 */
class SocialLinkController extends Controller
{
    /**
     * Lists all SocialLink entities.
     *
     * @Route("/", name="admin_partner_sociallink")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('IDCIPartnerBundle:SocialLink')->findAll();

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
     * Finds and displays a SocialLink entity.
     *
     * @Route("/{id}/show", name="admin_partner_sociallink_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:SocialLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new SocialLink entity.
     *
     * @Route("/new", name="admin_partner_sociallink_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SocialLink();
        $form   = $this->createForm(new SocialLinkType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new SocialLink entity.
     *
     * @Route("/create", name="admin_partner_sociallink_create")
     * @Method("POST")
     * @Template("IDCIPartnerBundle:SocialLink:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SocialLink();
        $form = $this->createForm(new SocialLinkType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'SocialLink',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('admin_partner_sociallink_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SocialLink entity.
     *
     * @Route("/{id}/edit", name="admin_partner_sociallink_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:SocialLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialLink entity.');
        }

        $editForm = $this->createForm(new SocialLinkType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SocialLink entity.
     *
     * @Route("/{id}/update", name="admin_partner_sociallink_update")
     * @Method("POST")
     * @Template("IDCIPartnerBundle:SocialLink:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:SocialLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SocialLinkType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                    '%entity%' => 'SocialLink',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('admin_partner_sociallink_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SocialLink entity.
     *
     * @Route("/{id}/delete", name="admin_partner_sociallink_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIPartnerBundle:SocialLink')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SocialLink entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'SocialLink',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('admin_partner_sociallink'));
    }

    /**
     * Display SocialLink deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IDCIPartnerBundle:SocialLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialLink entity.');
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
