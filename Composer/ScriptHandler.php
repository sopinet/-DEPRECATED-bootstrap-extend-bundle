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
			echo "Creating directory img and font link for BootstrapExtend";

			$ori_dir = "bundles/sopinetbootstrapextend/export/img";
			$link = "web/img";
			if (file_exists($link)) unlink($link);
			symlink($ori_dir, $link);

			$ori_dir = "bundles/sopinetbootstrapextend/export/font";
			$link = "web/font";
			if (file_exists($link)) unlink($link);
			symlink($ori_dir, $link);

		}
}
