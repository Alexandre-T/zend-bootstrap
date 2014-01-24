<?php 

namespace BootstrapTest\Util;

use Zend\ServiceManager\FactoryInterface;
use Bootstrap\Util;
use Bootstrap\Form\Util as FormUtil;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bootstrap\Form\View\Helper\Config;

class ViewHelperConfigFactory implements FactoryInterface{
	/* (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {
        $formUtil = new FormUtil();
		return new Config($formUtil);
	}
    
}