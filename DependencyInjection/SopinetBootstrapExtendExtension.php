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
                    $container->prependExtensionConfig(
                    		$name,
                    		array(
                    				'bundles' => $this->buildBundles($config)
                    		)
                    );
                    break;
            }
        }
    }
    
    private function buildBundles(array $config) {
		$output = array();
		$output[] = "SopinetBootstrapExtendBundle";
		return $output;
    }

    private function buildIncludes(array $config)
    {
        $output = array();
        
        		// Scripts before
				// Nothing
		        
				// Default true
				if ($config['include_jquery']) {
					$output['include_js']['inputs'][] = $config['assets_dir']."/jquery/js/jquery-1.9.1.min.js";	
				}

				// Default true
				if ($config['include_bootstrap']) {
					$output['include_css']['inputs'][] = $config['assets_dir']."/bootstrap/css/bootstrap.min.css";
					$output['include_css']['inputs'][] = $config['assets_dir']."/bootstrap/css/bootstrap-responsive.min.css";
					$output['include_js']['inputs'][] = $config['assets_dir']."/bootstrap/js/bootstrap.min.js";
				}

				// Scripts after
				foreach($config['include'] as $inc) {
					switch($inc) {
						case 'jqueryuitouch':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jqueryuitouch/js/jquery.ui.touch-punch.min.js";
						break;
						case 'jquery-chosen':
							$output['include_css']['inputs'][] = $config['assets_dir']."/jquery-chosen/css/chosen.css";
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-chosen/js/jquery.chosen.min.js";
						case 'xeditable':
							$output['include_css']['inputs'][] = $config['assets_dir']."/bootstrap-editable/css/bootstrap-editable.css";
							$output['include_js']['inputs'][] = $config['assets_dir']."/bootstrap-editable/js/bootstrap-editable.min.js";
						break;						
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
							$output['include_js']['inputs'][] = $config['assets_dir']."/load-image/load-image.min.js";
							$output['include_js']['inputs'][] = $config['assets_dir']."/image-gallery/js/bootstrap-image-gallery.min.js";
						break;
						case 'jcrop':
							$output['include_css']['inputs'][] = $config['assets_dir']."/jcrop/css/jquery.Jcrop.min.css";
							$output['include_js']['inputs'][] = $config['assets_dir']."/jcrop/js/jquery.Jcrop.min.js";
						break;
						case 'jqueryform':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jqueryform/jquery.form.js";
						break;
						case 'jwplayer':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jwplayer/jwplayer.js";
						break;
						case 'flexslider':
							$output['include_js']['inputs'][] = $config['assets_dir']."/flexslider/jquery.flexslider-min.js";
							$output['include_css']['inputs'][] = $config['assets_dir']."/flexslider/flexslider.css";
						break;
						case 'jqueryui':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jqueryui/js/jquery-ui.min.js";
							$output['include_css']['inputs'][] = $config['assets_dir']."/jqueryui/css/jquery-ui.min.css";
						break;
						case 'jsplumb':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jsplumb/js/jquery.jsPlumb-1.4.1-all-min.js";
						break;
						case 'easy-pie-chart':
							$output['include_js']['inputs'][] = $config['assets_dir']."/easy-pie-chart/jquery.easy-pie-chart.js";
							$output['include_css']['inputs'][] = $config['assets_dir']."/easy-pie-chart/jquery.easy-pie-chart.css";
						break;
						case 'jquery-flot':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-flot/jquery.flot.min.js";
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-flot/jquery.flot.pie.min.js";
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-flot/jquery.flot.resize.min.js";
						break;
						case 'fuelux-wizard':
							$output['include_js']['inputs'][] = $config['assets_dir']."/fuelux/fuelux.wizard.min.js";
						break;
						case 'jquery-mask':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-mask/jquery.maskedinput.min.js";
						break;
						case 'jquery-validate':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-validate/jquery.validate.min.js";
						break;
						case 'jquery-collagePlus':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-collagePlus/jquery.collagePlus.min.js";
						break;
						case 'jquery-md5':
							$output['include_js']['inputs'][] = $config['assets_dir']."/jquery-md5/jquery.md5.js";
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
