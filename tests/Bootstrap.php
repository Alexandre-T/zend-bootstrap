<?php
// Ini settings
ini_set('display_startup_errors', true);
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// ZF2 Path is taken form the ZF2_PATH environment variable
$zf2Path = getenv('ZF2_PATH');
if (! $zf2Path) {
    throw new \RuntimeException("Test bootstrap: Environment variable 'ZF2_PATH' not found." . ' Set this variable in phpunit.xml file to point to the ZF2 library and run the test again.');
}

chdir(dirname(__DIR__));

// ZF2 Autoloader
require_once ($zf2Path . '/Zend/Loader/AutoloaderFactory.php');

		\Zend\Loader\AutoloaderFactory::factory ( array (
				'Zend\Loader\StandardAutoloader' => array (
						'autoregister_zf' => true,
						'namespaces' => array (
						       'Bootstrap' => __DIR__ . '/../library/Bootstrap', 
						       __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
						) 
				) 
		) )
;
