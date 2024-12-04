<?php

namespace KCoreApi;

use KCoreWeb\Utils\Path;

class Theme {

    const CONTROLLER_PATH = "controller/route";

    static function runningTheme() {
        global $engine;
        $runningTheme = $engine["runningTheme"];

        if (!$runningTheme)
            throw new \Exception("No current running theme.");

        return $runningTheme;
    }
    static function getURI() {
        return static::runningTheme()->getUri()->getRaw();
    }

    static function getBaseRoute() {
        // TODO: Exclude parameters of the current route:
        // Example /users/1234 uri should return just: /users
        return static::getURI();
    }

    static function absolutePath() {
        return self::runningTheme()->getRootDir();
    }

    static function getBaseRouteFile(bool $skipFirst = false) {
        $uri = static::getBaseRoute();

        if (empty($uri) || $uri == "/")
            $uri = "/index.php";
        else {
            if (is_dir(Theme::absolutePath() . $uri))
                $uri = $uri . "/index.php";
            else $uri = $uri . ".php";
        }

        if ($skipFirst)
            $uri = substr($uri, 1);

        return $uri;
    }
    
    static function controllerPath() {
        return Theme::absolutePath() . Path::SLASH . "controller/route"; 
    }

    static function importFile($file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        if ($extension != ".php")
            $file .= ".php";

        $relativeFile = $file;
        $file         = self::absolutePath() . Path::SLASH . $file;

        if (!file_exists($file))
            throw new \Exception("Theme::importFile('$relativeFile') failed. File doen't exists.");

        
        return includeFile($file);
    }
}