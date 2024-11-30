<?php

require_once __UTILS__ . "/path.php";
require_once __CORE__  . "/utils/config-loader.php";


function loadConfig() {
    global $siteConfigurations;
    global $engine;

    if ($engine["siteConfigurations"])
        return $engine["siteConfigurations"];

    $configFile = @file_get_contents( $_SERVER["DOCUMENT_ROOT"] . "/" . parsePath($siteConfigurations["AUTOLOADER"]["CONFIG_PATH"]) . "autoloader.config.json");
    if (!$configFile)
        return null;

    return $engine["siteConfigurations"] = new ConfigLoader(@json_decode($configFile, true));
}

function autoloaderConfigure() {

    global $engine;
    
    $config = loadConfig();
    if (!$config)
        throw new Exception("config file corrupted.");

    engineRegisterNamespaces($config->getAutoloaderNamespaces());
}