<?php

namespace IDCI\Bundle\PartnerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('zip_code')
            ->add('country')
            ->add('city')
            ->add('partner')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\PartnerBundle\Entity\Location'
        ));
    }

    public function getName()
    {
        return 'idci_bundle_partnerbundle_locationtype';
    }
}