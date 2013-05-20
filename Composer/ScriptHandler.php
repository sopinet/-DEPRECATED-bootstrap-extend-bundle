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
			echo "Creating directory img link for BootstrapExtend";
			$ori_dir = "bundles/sopinetbootstrapextend/export/img";
			$link = "web/img";

			symlink($ori_dir, $link);
		}
}
