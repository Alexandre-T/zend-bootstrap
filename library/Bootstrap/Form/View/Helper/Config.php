<?php
namespace Bootstrap\Form\View\Helper;

/**
 * 
 * @package zend-bootstrap
 * @copyright Alexandre-T (c) - http://www.at-it.fr
 * @license Apache License v2 https://github.com/Alexandre-T/zend-bootstrap/blob/master/LICENSE	
 * @link https://github.com/Alexandre-T/zend-bootstrap
 * @link http://www.at-it.fr
 * @author alexandre
 *        
 */

use Bootstrap\Util;
use Bootstrap\Form\Util as FormUtil;

use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Service manager configuration for form view helpers
 * 
 * @package zend-bootstrap
 * @copyright Alexandre-T (c) - http://www.at-it.fr
 * @license Apache License v2 https://github.com/Alexandre-T/zend-bootstrap/blob/master/LICENSE	
 * @link https://github.com/Alexandre-T/zend-bootstrap
 * @link http://www.at-it.fr
 */
class Config implements ConfigInterface
{
	/**
	 * @var array Pre-aliased view helpers
	 */
	protected $invokables = array(
//			'formcontrolgroup'                   => 'Bootstrap\Form\View\Helper\FormControlGroup',
//			'formcontrols'                       => 'Bootstrap\Form\View\Helper\FormControls',
//			'formdescription'                    => 'Bootstrap\Form\View\Helper\FormDescription',
//			'formelement'                        => 'Bootstrap\Form\View\Helper\FormElement',
//			'formhidden'                         => 'Bootstrap\Form\View\Helper\FormHidden',
//			'formhint'                           => 'Bootstrap\Form\View\Helper\FormHint',
	);

	/**
	 * @var Util
	*/
	protected $bootstrapUtil;

	/**
	 * @var FormUtil
	 */
	protected $formUtil;

	/**
	 * Constructor
	 * @param BootstrapUtil $bootstrapUtil
	 * @param FormUtil $formUtil
	 */
	public function __construct(Util $bootstrapUtil, FormUtil $formUtil)
	{
		$this->bootstrapUtil  = $bootstrapUtil;
		$this->formUtil = $formUtil;
	}

	/**
	 * Configure the provided service manager instance with the configuration
	 * in this class.
	 *
	 * In addition to using each of the internal properties to configure the
	 * service manager, also adds an initializer to inject ServiceManagerAware
	 * classes with the service manager.
	 *
	 * @param  ServiceManager $serviceManager
	 * @return void
	 */
	public function configureServiceManager(ServiceManager $serviceManager)
	{
		foreach ($this->invokables as $name => $service) {
			$serviceManager->setInvokableClass($name, $service);
		}
		$factories  = $this->getFactories();
		foreach ($factories as $name => $factory) {
			$serviceManager->setFactory($name, $factory);
		}
	}

	/**
	 * Returns an array of view helper factories
	 * @return array
	 */
	protected function getFactories()
	{
		$bootstrapUtil    = $this->bootstrapUtil;
		$formUtil   = $this->formUtil;
		return array(
		      /*
				'formactions'                    => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormActions($formUtil);
					return $instance;
				},
				'formbutton'                     => function($sm) use ($bootstrapUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormButton($bootstrapUtil);
					return $instance;
				},
				'formcheckbox'                   => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormCheckbox($formUtil);
					return $instance;
				},
				'formelementerrors'              => function($sm) use ($bootstrapUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormElementErrors($bootstrapUtil);
					return $instance;
				},*/
				'fieldset'                   => function($sm) use ($bootstrapUtil, $formUtil) {
					return new Fieldset($bootstrapUtil, $formUtil);
				},/*
				'formfile'                       => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormFile($formUtil);
					return $instance;
				},
				'forminput'                      => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormInput($formUtil);
					return $instance;
				},
				'formlabel'                      => function($sm) use ($bootstrapUtil) {
					$formLabelHelper    = $sm->get('formLabel');
					$instance           = new \Bootstrap\Form\View\Helper\FormLabel($formLabelHelper, $bootstrapUtil);
					return $instance;
				},
				'formmulticheckbox'              => function($sm) use ($bootstrapUtil) {
					$formMultiCheckboxHelper    = $sm->get('formMultiCheckbox');
					$instance                   = new \Bootstrap\Form\View\Helper\FormMultiCheckbox(
							$formMultiCheckboxHelper, $bootstrapUtil);
					return $instance;
				},
				'formpassword'                   => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormPassword($bootstrapUtil, $formUtil);
					return $instance;
				},
				'formradio'                      => function($sm) use ($bootstrapUtil) {
					$formRadioHelper            = $sm->get('formRadio');
					$instance                   = new \Bootstrap\Form\View\Helper\FormRadio(
							$formRadioHelper, $bootstrapUtil);
					return $instance;
				},
				'formreset'                      => function($sm) use ($bootstrapUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormReset($bootstrapUtil);
					return $instance;
				},
				'formrow'                        => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormRow($bootstrapUtil, $formUtil);
					return $instance;
				},
				'formselect'                     => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormSelect($bootstrapUtil, $formUtil);
					return $instance;
				},
				'formsubmit'                     => function($sm) use ($bootstrapUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormSubmit($bootstrapUtil);
					return $instance;
				},
				'formtext'                       => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormText($bootstrapUtil, $formUtil);
					return $instance;
				},
				'formtextarea'                   => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormTextarea($bootstrapUtil, $formUtil);
					return $instance;
				},*/
				'form'                           => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\Form($bootstrapUtil, $formUtil);
					return $instance;
				},
		);
	}
}