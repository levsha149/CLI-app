<?php

class Autoloader{
    protected $namespaces = array();

    /**
     * @param $namespace
     * @param $rootDir
     * @return bool
     */
    public function registerNamespace($namespace, $rootDir)
    {

        if (is_dir($rootDir)) {

            $this->namespaces[$namespace] = $rootDir;
            return true;
        }

        return false;
    }

    /**
     *
     */
    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }

    /**
     * @param $class
     * @return bool
     */
    protected function load($class)
    {
        $classNameParts = explode('\\', $class);

        if (is_array($classNameParts)) {

            $namespace = array_shift($classNameParts);

            if (isset($this->namespaces[$namespace])) {
                $filePath = $this->namespaces[$namespace] . '/' . implode('/', $classNameParts) . '.php';

                if(is_file($filePath)){
                    require_once $filePath;
                    return true;
                }
            }
        }

        return false;
    }
}