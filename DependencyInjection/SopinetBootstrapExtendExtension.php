<?php
/**
* This file is part of SopinetBootstrapExtendBundle.
*
* (c) 2013 by Fernando Hidalgo - Sopinet
*/

namespace Sopinet\Bundle\BootstrapExtendBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
* SopinetBootstrapExtendExtension
*
* @codeCoverageIgnore
*/
class SopinetBootstrapExtendExtension extends Extension implements PrependExtensionInterface
{
    /**
		* {@inheritDoc}
		*/
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

				/*
				* No need services
				*
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
				*/
    }

    /**
		* {@inheritDoc}
		*/
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        // Add includes if Assetic is activated
        if (isset($bundles['AsseticBundle'])) {
            $this->addIncludes($container, $config);
        }
    }

    /**
		* Add includes
		*
		* @param ContainerBuilder $container The service container
		* @param array $config The bundle configuration
		*
		* @return void
		*
		* @SuppressWarnings(PHPMD.UnusedLocalVariable)
		*/
    private function addIncludes(ContainerBuilder $container, array $config)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'assetic':
                    $container->prependExtensionConfig(
                        $name,
                        array(
                            'assets' => $this->buildIncludes($config)
                        )
                    );
                    break;
            }
        }
    }

    private function buildIncludes(array $config)
    {
        $output = array();

				foreach($config['include'] as $inc) {
					switch($inc) {
						case 'datepicker':
							$output['include_css']['inputs'][] = $config['assets_dir']."/datepicker/css/datepicker.css";
							$output['include_js']['inputs'][] = $config['assets_dir']."/datepicker/js/bootstrap-datepicker.js";
						break;
						case 'font-awesome':
							$output['include_css']['inputs'][] = $config['assets_dir']."/font-awesome/css/font-awesome.min.css";
							$output['include_css']['inputs'][] = $config['assets_dir']."/font-awesome/css/font-awesome-ie7.css";
						break;
						case 'image-gallery':
							$output['include_css']['inputs'][] = $config['assets_dir']."/image-gallery/css/bootstrap-image-gallery.min.css";
							$output['include_js']['inputs'][] = $config['assets_dir']."/image-gallery/js/bootstrap-image-gallery.min.js";
						break;						
						case 'jcrop':
							$output['include_css']['inputs'][] = $config['assets_dir']."/jcrop/css/jquery.Jcrop.min.css";
							$output['include_css']['inputs'][] = $config['assets_dir']."/jcrop/js/jquery.Jcrop.min.js";
						break;
						case 'jqueryform':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jqueryform/jquery.form.js";
						break;
						case 'jwplayer':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jwplayer/jwplayer.js";
						break;
					}
				}

				$output['include_js']['output'] = $config['output_dir'].'js/include.js';

				//TODO: Active filters by default, $output['include_css']['filters'][] = 'rewrite';
				$output['include_css']['output'] = $config['output_dir'].'css/include.css';

        return $output;
    }

    public function getAlias()
    {
        return 'sopinet_bootstrap_extend';
    }
}
