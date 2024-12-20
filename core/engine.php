<?php

use KCoreApi\Theme;
use KCoreWeb\Utils\Path;
function engineRegisterNamespaces(array $namespaces) {
    foreach ($namespaces as $namespace) {
        spl_autoload_register(function($klass) use($namespace) {
            $klassNamespace = @explode("\\", $klass)[0];
            
            if ($namespace["name"] != $klassNamespace)
                return;
            
            $rest = substr($klass, strlen($klassNamespace) + 1);
            if (empty($rest))
                return;

            $classPath = $_SERVER["DOCUMENT_ROOT"] . "/" . $namespace["resolve"] . "/" . $rest . ".php";
            
            if (file_exists($classPath))
                require_once $classPath;
        });
    }
}


function includeControl() {
    // get route filesystem path excluding parameters
    $uri            = Theme::getBaseRouteFile(true);
    $controllerPath = Theme::controllerPath();
    
    $controllerPath = $controllerPath . Path::SLASH . $uri;

    if (!file_exists($controllerPath))
        throw new \Exception($uri . " doesn't define a controller");
    
    try {
        return includeFile($controllerPath);
    } catch(\Exception | \Error $ex) {
        throw new \Exception("Error occurred in controller " . Theme::CONTROLLER_PATH . "/" . $uri . ": " . $ex->getMessage() . " [line " . $ex->getLine() . "]");
    }
}

function setRunningTheme($theme) {
    global $engine;
    $engine["runningTheme"] = $theme;
}

function engineBootstrap($class): object | null {
    echo "engineBootstrap() ";
    return null;
}

return [
    "siteConfigurations" => null,
    "runningTheme"       => null
];