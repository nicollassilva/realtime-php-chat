<?php
if(! function_exists('view')) {
    /**
     * @param string $nameView
     * @param array $resources
     */
    function view(String $nameView, Array $resources = [])
    {
        $pathFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $nameView . ".php";
        
        if (!file_exists($pathFile)) return null;

        if(!is_null($resources)) {
            extract($resources, EXTR_PREFIX_SAME, "wddx");
        }

        require_once $pathFile;
    }
}
