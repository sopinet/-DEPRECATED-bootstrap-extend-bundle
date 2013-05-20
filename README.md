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
    
Problems, bugs?
---------------
  Please report it via github
