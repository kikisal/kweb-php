<?php

if (!function_exists("includeFile")) {
    function includeFile($file) {
        return (function () use($file) {
            try {
                return @include_once $file;
            } catch(\Exception $ex) {
                echo "Exception caught: " . $ex->getMessage() . "<br>";
                return null;
            }
        })();
    }
}
