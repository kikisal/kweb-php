<?php

if (!function_exists("includeFile")) {
    function includeFile($file) {
        return (function () use($file) {
            return @include_once $file;
        })();
    }
}
