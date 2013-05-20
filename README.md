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
    
Configuration
-------------

You can configure what librey include, by default only jquery and bootstrap, for add more:

sopinet_bootstrap_extend:
    include: [ jcrop, image-gallery, font-awesome, jqueryform, datepicker ]

Usage
-----

You can do any like in base.html.twig and after override it:

{% extends 'SopinetBootstrapExtendBundle:Base:normal.html.twig' %}

{% block title %}Yourweb{% endblock %}
    
Problems, bugs?
---------------
  Please report it via github
