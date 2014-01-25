<?php 

namespace BootstrapTest\Util;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;
class ServiceManagerFactory
{
    /**
     * @var array
     */
    protected static $config;

    /**
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        static::$config = $config;
    }

    /**
     * Builds a new service manager
     * Emulates {@see \Zend\Mvc\Application::init()}
     */
    public static function getServiceManager()
    {
        $serviceManager = new ServiceManager(new ServiceManagerConfig(
            isset(static::$config['service_manager']) 
                ? static::$config['service_manager'] 
                : array()
        ));
        
        $serviceManager->setService('ApplicationConfig', static::$config);
        $serviceManager->setFactory(
            'ServiceListener',
            'Zend\Mvc\Service\ServiceListenerFactory'
        );
        $serviceManager->setFactory(
            'bootstrap_view_helper_configurator', 
            'BootstrapTest\Util\ViewHelperConfigOverrideFactory'
        );
        /** @var $moduleManager \Zend\ModuleManager\ModuleManager */
        $moduleManager = $serviceManager->get('ModuleManager');
        $moduleManager->loadModules();
        
        $viewHelperPluginManager    = $serviceManager->get('view_helper_manager');
        /* @var $viewHelperPluginManager \Zend\View\HelperPluginManager */

        $viewHelperConfigurator     = $serviceManager->get('bootstrap_view_helper_configurator');
        /* @var $viewHelperConfigurator \Bootstrap\Form\View\Helper\Config */
        
        $viewHelperConfigurator->configureServiceManager($viewHelperPluginManager);
        //var_dump($viewHelperPluginManager->getRegisteredServices());die();

        return $serviceManager;
    }
}