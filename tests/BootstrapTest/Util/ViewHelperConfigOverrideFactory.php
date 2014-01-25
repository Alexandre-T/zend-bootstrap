<?php 

namespace BootstrapTest\Util;

use Zend\ServiceManager\FactoryInterface;
use Bootstrap\Form\Util as FormUtil;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bootstrap\Form\View\Helper\Config;

class ViewHelperConfigOverrideFactory implements FactoryInterface{
	/* (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {
        $formUtil = new FormUtil(null,false);
		return new Config($formUtil);
	}
    
}