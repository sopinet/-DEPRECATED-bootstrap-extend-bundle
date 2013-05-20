<?php

/*
 */

namespace Sopinet\Bundle\BootstrapExtendBundle\Composer;

use Composer\Script\CommandEvent;

/**
 */
class ScriptHandler
{
    /**
     *
     * @param $event CommandEvent A instance
     */
    public static function copyExport(CommandEvent $event)
    {
			global $kernel;
			if ( 'AppCache' == get_class($kernel) )
			{
				 $kernel = $kernel->getKernel();
			}
			$path = $kernel->getRootDir();
			echo $path;
			exit();
		}
}
