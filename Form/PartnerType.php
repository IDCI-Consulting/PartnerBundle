<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\PartnerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('mail')
            ->add('phone')
            ->add('categories', null, array("required" => false))
            ->add('offers', 'collection', array(
                'type'         => new OfferType(),
                'allow_add'    => true,
                'by_reference' => false
            ))
            ->add('socialLinks', 'collection', array(
                'type'         => new SocialLinkType(),
                'allow_add'    => true,
                'by_reference' => false
            ))
            ->add('locations', 'collection', array(
                'type'         => new LocationType(),
                'allow_add'    => true,
                'by_reference' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'IDCI\Bundle\PartnerBundle\Entity\Partner',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'idci_bundle_partnerbundle_partnertype';
    }
}
