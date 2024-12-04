<?php


namespace KCoreWeb\App;

use KCoreWeb\ATheme;

abstract class WkWebApp extends ServiceProvider {

    private ATheme | null $theme = null;

    public function __construct($theme) {
        parent::__construct();

        $this->theme = $theme;
    }

    public abstract function init(): void;

    public function getTheme() {
        return $this->theme;
    }
}