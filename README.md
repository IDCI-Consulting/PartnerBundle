PartnerBundle
===============

A Partner Bundle for Symfony2

Content
=======

This bundle was developped for a specific project, but is made to suit with more. It allows to add Partners management in a project.
You have also an API usable for web-service. With a partner comes :
    - locations
    - offers from partners
    - a partner category
    - social links

Feel free to contribute, fork this bundle and add what you need.

Installation
============

To install this bundle please follow the next steps:

First add the dependencie to your `composer.json` file:

    "require": {
        ...
        "idci/partner-bundle": "dev-master"
    },

And install the bundle with the command:

    php composer.phar update

Then, enable the bundle in your application kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new IDCI\Bundle\PartnerBundle\IDCIPartnerBundle(),
        );
    }

In your routing.yml file, add the following:

    idci_partner:
        resource: "../../vendor/idci/partner-bundle/IDCI/Bundle/PartnerBundle/Controller"
        type:     annotation

If it isn't done yet, configure your database.

Edit your parameters.yml file. Here is an exemple which might help you:

    parameters:
        database_driver:   pdo_mysql
        database_host:     localhost
        database_port:     ~
        database_name:     sf_partner
        database_user:     root
        database_password: MyPassword

        mailer_transport:  smtp
        mailer_host:       localhost
        mailer_user:       ~
        mailer_password:   ~

        locale:            en
        secret:            ThisTokenIsNotSoSecretChangeIt

Run theses commands in your workspace directory:

    php app/console doctrine:database:create
    php app/console doctrine:schema:create

Else, just run the following:

    php app/console doctrine:schema:update

Now the Bundle is installed and ready to use. You will find new routes by running this command:

    php app/console router debug

    admin_partner_category            ANY    /admin/partner/category/
    admin_partner_category_show       ANY    /admin/partner/category/{id}/show
    admin_partner_category_new        ANY    /admin/partner/category/new
    admin_partner_category_create     POST   /admin/partner/category/create
    admin_partner_category_edit       ANY    /admin/partner/category/{id}/edit
    admin_partner_category_update     POST   /admin/partner/category/{id}/update
    admin_partner_category_delete     POST   /admin/partner/category/{id}/delete
    admin_partner_location            ANY    /admin/partner/location/
    admin_partner_location_show       ANY    /admin/partner/location/{id}/show
    admin_partner_location_new        ANY    /admin/partner/location/new
    admin_partner_location_create     POST   /admin/partner/location/create
    admin_partner_location_edit       ANY    /admin/partner/location/{id}/edit
    admin_partner_location_update     POST   /admin/partner/location/{id}/update
    admin_partner_location_delete     POST   /admin/partner/location/{id}/delete
    admin_partner_offer               ANY    /admin/partner/offer/
    admin_partner_offer_show          ANY    /admin/partner/offer/{id}/show
    admin_partner_offer_new           ANY    /admin/partner/offer/new
    admin_partner_offer_create        POST   /admin/partner/offer/create
    admin_partner_offer_edit          ANY    /admin/partner/offer/{id}/edit
    admin_partner_offer_update        POST   /admin/partner/offer/{id}/update
    admin_partner_offer_delete        POST   /admin/partner/offer/{id}/delete
    admin_partner_partner             ANY    /admin/partner/partner/
    admin_partner_partner_show        ANY    /admin/partner/partner/{id}/show
    admin_partner_partner_new         ANY    /admin/partner/partner/new
    admin_partner_partner_create      POST   /admin/partner/partner/create
    admin_partner_partner_edit        ANY    /admin/partner/partner/{id}/edit
    admin_partner_partner_update      POST   /admin/partner/partner/{id}/update
    admin_partner_partner_delete      POST   /admin/partner/partner/{id}/delete
    admin_partner_sociallink          ANY    /admin/partner/sociallink/
    admin_partner_sociallink_show     ANY    /admin/partner/sociallink/{id}/show
    admin_partner_sociallink_new      ANY    /admin/partner/sociallink/new
    admin_partner_sociallink_create   POST   /admin/partner/sociallink/create
    admin_partner_sociallink_edit     ANY    /admin/partner/sociallink/{id}/edit
    admin_partner_sociallink_update   POST   /admin/partner/sociallink/{id}/update
    admin_partner_sociallink_delete   POST   /admin/partner/sociallink/{id}/delete