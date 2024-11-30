<?php

class ConfigLoader {
    
    private $configData = null;
    private $autoloaderNamespaces = [];

    public function __construct($configData) {
        $this->configData           = $configData;
        $this->autoloaderNamespaces = $this->configRead("namespaces", $this->autoloaderNamespaces);
    }

    public function configRead(string $key, mixed $defaultValue = null) {
        if (!$this->configData || !array_key_exists($key, $this->configData))
            return $defaultValue;

        return $this->configData[$key];
    }

    public function getAutoloaderNamespaces() {
        return $this->autoloaderNamespaces;
    }   
}