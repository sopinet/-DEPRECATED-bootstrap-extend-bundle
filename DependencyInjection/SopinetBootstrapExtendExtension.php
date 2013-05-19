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

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
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
						case 'jcrop':
							$output['include_css']['inputs'][] = $config['assets_dir']."/jcrop/css/jquery.Jcrop.min.css";
						break;
						case 'font-awesome':
							$output['include_css']['inputs'][] = $config['assets_dir']."/font-awesome/css/font-awesome.min.css";
						break;
					}
				}

				$output['include_js']['output'] = $config['output_dir'].'js/include.js';

				$output['include_css']['filters'][] = 'rewrite';
				$output['include_css']['output'] = $config['output_dir'].'css/include.css';

        return $output;
    }
}
