<?php
/*
-------------------------------------------------------------------

██████╗ ██╗   ██╗    ██╗  ██╗██╗██╗  ██╗██╗███████╗ █████╗ ██╗     
██╔══██╗╚██╗ ██╔╝    ██║ ██╔╝██║██║ ██╔╝██║██╔════╝██╔══██╗██║     
██████╔╝ ╚████╔╝     █████╔╝ ██║█████╔╝ ██║███████╗███████║██║     
██╔══██╗  ╚██╔╝      ██╔═██╗ ██║██╔═██╗ ██║╚════██║██╔══██║██║     
██████╔╝   ██║       ██║  ██╗██║██║  ██╗██║███████║██║  ██║███████╗
╚═════╝    ╚═╝       ╚═╝  ╚═╝╚═╝╚═╝  ╚═╝╚═╝╚══════╝╚═╝  ╚═╝╚══════╝
                                                                   
-------------------------------------------------------------------
                        No Comment.
*/


ini_set( 'display_errors', 'on' );

require_once __DIR__   . '/constants.php';
require_once __UTILS__ . 'includer.php';
require_once __DIR__   . '/autoloader.php';


$engine             = require_once      __CORE__ . 'engine.php';
$siteConfigurations = includeFile(__DIR__  . '/config.php');

autoloaderConfigure();

use KCoreWeb\SimpleTheme;

$theme = SimpleTheme::create('root', THEME_DIR);
$theme->updateRootDir(false);

$theme->setTitle('DJShop');
$theme->addResource('static');

header("Access-Control-Allow-Origin: *");

$theme->load();
