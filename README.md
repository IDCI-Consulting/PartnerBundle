PartnerBundle
===============

A Partner Bundle for Symfony2

Content
=======

This bundle was developped for a specific project, but is made to suit with more. It allows to add Partners management in a project.
You have also an API usable for web-service. With a partner comes locations, offers from partners, a partner category and social links.
Feel free to contribute, fork this bundle and add what you need.

Installation
============

To install this bundle please follow the next steps:

First add the dependencies to your `composer.json` file:

```json
"require": {
    ...
    "pagerfanta/pagerfanta": "dev-master",
    "white-october/pagerfanta-bundle": "dev-master",
    "idci/partner-bundle": "dev-master"
},
```

And install the bundle with the command:

```sh
php composer.phar update
```

Enable the bundle in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
        new IDCI\Bundle\PartnerBundle\IDCIPartnerBundle(),
    );
}
```

In your routing.yml file, add the following:

```yml
idci_partner:
    resource: "../../vendor/idci/partner-bundle/IDCI/Bundle/PartnerBundle/Controller"
    type:     annotation
```

As you can see, we use [WhiteOctoberPagerFantaBundle](https://github.com/whiteoctober/WhiteOctoberPagerfantaBundle) to paginate list results.
So you have to define the `max_per_page` parameter in your `app/config/parameters.yml`

```yml
parameters:
    ...
    max_per_page:  25
```
Now, you have to install bootstrap: 

 * Download bootstrap at http://twitter.github.com/bootstrap/assets/bootstrap.zip
 * Then extract it into your /web directory which is at the root of the project.

If it isn't done yet, configure your database.

Edit your parameters.yml file. Here is an exemple which might help you:

```yml
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
```

Run theses commands in your workspace directory:

```sh
php app/console doctrine:database:create
php app/console doctrine:schema:create
```

Else, just run the following:

```sh
php app/console doctrine:schema:update
```

Now the Bundle is installed and ready to use. You will find new routes by running this command:

    php app/console router debug

    ...
    admin_partner                 ANY    ANY  /admin/partner/
    admin_partner_category        ANY    ANY  /admin/partner/category/
    admin_partner_category_show   ANY    ANY  /admin/partner/category/{id}/show
    admin_partner_category_new    ANY    ANY  /admin/partner/category/new
    admin_partner_category_create POST   ANY  /admin/partner/category/create
    admin_partner_category_edit   ANY    ANY  /admin/partner/category/{id}/edit
    admin_partner_category_update POST   ANY  /admin/partner/category/{id}/update
    admin_partner_category_delete POST   ANY  /admin/partner/category/{id}/delete
    admin_partner_partner         ANY    ANY  /admin/partner/partner/
    admin_partner_partner_show    ANY    ANY  /admin/partner/partner/{id}/show
    admin_partner_partner_new     ANY    ANY  /admin/partner/partner/new
    admin_partner_partner_create  POST   ANY  /admin/partner/partner/create
    admin_partner_partner_edit    ANY    ANY  /admin/partner/partner/{id}/edit
    admin_partner_partner_update  POST   ANY  /admin/partner/partner/{id}/update
    admin_partner_partner_delete  POST   ANY  /admin/partner/partner/{id}/delete
