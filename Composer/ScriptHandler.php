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

			if (!file_exists("web/include")) mkdir("web/include");

			$ori_dir = "../bundles/sopinetbootstrapextend/export/img";
			$link = "web/include/img";
			if (file_exists($link)) unlink($link);
			symlink($ori_dir, $link);

			$ori_dir = "../bundles/sopinetbootstrapextend/export/font";
			$link = "web/include/font";
			if (file_exists($link)) unlink($link);
			symlink($ori_dir, $link);

		}
}
