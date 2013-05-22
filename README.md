bootstrap-extend-bundle
=======================

What is it?
-----------

It is alpha bundle for Symfony2, you can add jquery, bootstrap and other libraries with easy and fast method.

Thanks to [Florian Eckerstorfer](http://florianeckerstorfer.com)
Inspirated in https://github.com/braincrafted/bootstrap-bundle

Installation via composer
-------------------------

    {
       "require": {
            "sopinet/bootstrap-extend-bundle": "dev-master"
        }
    },
    "scripts": {
      "post-install-cmd": [
        "Sopinet\\Bundle\\BootstrapExtendBundle\\Composer\\ScriptHandler::copyExport"
      ],
      "post-update-cmd": [
        "Sopinet\\Bundle\\BootstrapExtendBundle\\Composer\\ScriptHandler::copyExport"
      ]
    }
    
Add in AppKernel the bundle

    new Sopinet\Bundle\BootstrapExtendBundle\SopinetBootstrapExtendBundle(),

After execute:

		sudo php app/console assets:install
    
Configuration
-------------

You can configure what librey include, by default only jquery and bootstrap, for add more:

    sopinet_bootstrap_extend:
        include: [ jcrop, image-gallery, font-awesome, jqueryform, datepicker ]

Usage
-----

In your twig, you can do any like:

    {% extends 'SopinetBootstrapExtendBundle:Base:normal.html.twig' %}

    {% block title %}Yourweb{% endblock %}
    
    {% block body %}
        <div class="container">
            Hello world!
        </div>
    {% endblock %}
    
Problems, bugs?
---------------
  Please report it via github
