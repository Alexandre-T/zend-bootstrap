<?php
//Ini settings
ini_set('display_startup_errors', true);
ini_set('display_errors', true);
error_reporting( E_ALL | E_STRICT );

//ZF2 Path is taken form the ZF2_PATH environment variable
$zf2Path    = getenv('ZF2_PATH');
if (!$zf2Path) {
    $zf2Path = "/home/alexandre/Zend/workspaces/DefaultWorkspace/gmao/vendor/zendframework/zendframework/library/";
    //throw new \RuntimeException("Test bootstrap: Environment variable 'ZF2_PATH' not found."
    //                           . ' Set this variable to point to the ZF2 library and run the test again.');
}

chdir(dirname(__DIR__));

//ZF2 Autoloader
require_once ($zf2Path . '/Zend/Loader/AutoloaderFactory.php');
require_once ($zf2Path . '/Zend/Loader/AutoloaderFactory.php');
Zend\Loader\AutoloaderFactory::factory(array(
       'Zend\Loader\StandardAutoloader' => array(
           'autoregister_zf' => true
       ),
        'Zend\Loader\ClassMapAutoloader' => array(
        		__DIR__ . '/../autoload_classmap.php',
        ),
));
use BootstrapTest\Util\ServiceManagerFactory;

// use ModuleManager to load this module and it's dependencies
$config = require __DIR__ . '/TestConfiguration.php';
 
ServiceManagerFactory::setConfig($config);	

//Unset local vars
unset($zf2Path,$config);