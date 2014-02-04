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
use Bootstrap\Form\View\Helper\Collection;
use Bootstrap\Form\View\Helper\Element\Radio;

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
			'bsbutton'        => 'Bootstrap\Form\View\Helper\Element\Button',
	        'bscheckbox'      => 'Bootstrap\Form\View\Helper\Element\Checkbox',
			'bscheckboxtag'   => 'Bootstrap\Form\View\Helper\CheckboxTag',
	        'bscolor'         => 'Bootstrap\Form\View\Helper\Element\Color',
	        'bsdate'          => 'Bootstrap\Form\View\Helper\Element\Date',
	        'bsdatetime'      => 'Bootstrap\Form\View\Helper\Element\DateTime',
	        'bsdatetimelocal' => 'Bootstrap\Form\View\Helper\Element\DateTimeLocal',
	        'bselement'       => 'Bootstrap\Form\View\Helper\Element',
	        'bsemail'         => 'Bootstrap\Form\View\Helper\Element\Email',
	        'bsgroup'         => 'Bootstrap\Form\View\Helper\Group',
			'bshelp'          => 'Bootstrap\Form\View\Helper\HelpBlock',
			'bsmonth'         => 'Bootstrap\Form\View\Helper\Element\Month',
	        'bsnumber'        => 'Bootstrap\Form\View\Helper\Element\Number',
	        'bspassword'      => 'Bootstrap\Form\View\Helper\Element\Password',
	        'bssearch'        => 'Bootstrap\Form\View\Helper\Element\Search',
	        'bsselect'        => 'Bootstrap\Form\View\Helper\Element\Select',
	        'bsstrong'        => 'Bootstrap\Form\View\Helper\Strong',
	        'bstel'           => 'Bootstrap\Form\View\Helper\Element\Tel',
	        'bstext'          => 'Bootstrap\Form\View\Helper\Element\Text',
	        'bstextarea'      => 'Bootstrap\Form\View\Helper\Element\Textarea',
	        'bstime'          => 'Bootstrap\Form\View\Helper\Element\Time',
	        'bsurl'           => 'Bootstrap\Form\View\Helper\Element\Url',
	        'bsweek'          => 'Bootstrap\Form\View\Helper\Element\Week',
//			'formdescription'                    => 'Bootstrap\Form\View\Helper\FormDescription',
//			'formelement'                        => 'Bootstrap\Form\View\Helper\FormElement',
//			'formhidden'                         => 'Bootstrap\Form\View\Helper\FormHidden',
//			'formhint'                           => 'Bootstrap\Form\View\Helper\FormHint',
	);
	protected $overrideInvokables = array(
//			'formgroup'         => 'Bootstrap\Form\View\Helper\Group',
//			'formhelp'          => 'Bootstrap\Form\View\Helper\HelpBlock',
			'formbutton'        => 'Bootstrap\Form\View\Helper\Element\Button',
	        'formcheckbox'      => 'Bootstrap\Form\View\Helper\Element\Checkbox',
	        'formcolor'         => 'Bootstrap\Form\View\Helper\Element\Color',
	        'formdate'          => 'Bootstrap\Form\View\Helper\Element\Date',
	        'formdatetime'      => 'Bootstrap\Form\View\Helper\Element\DateTime',
	        'formdatetimelocal' => 'Bootstrap\Form\View\Helper\Element\DateTimeLocal',
	        'formelement'       => 'Bootstrap\Form\View\Helper\Element',
	        'formemail'         => 'Bootstrap\Form\View\Helper\Element\Email',
	        'formmonth'         => 'Bootstrap\Form\View\Helper\Element\Month',
	        'formnumber'        => 'Bootstrap\Form\View\Helper\Element\Number',
	        'formpassword'      => 'Bootstrap\Form\View\Helper\Element\Password',
	        'formsearch'        => 'Bootstrap\Form\View\Helper\Element\Search',
	        'formselect'        => 'Bootstrap\Form\View\Helper\Element\Select',
	        'formtel'           => 'Bootstrap\Form\View\Helper\Element\Tel',
	        'formtext'          => 'Bootstrap\Form\View\Helper\Element\Text',
	        'formtextarea'      => 'Bootstrap\Form\View\Helper\Element\Textarea',
	        'formtime'          => 'Bootstrap\Form\View\Helper\Element\Time',
	        'formurl'           => 'Bootstrap\Form\View\Helper\Element\Url',
	        'formweek'          => 'Bootstrap\Form\View\Helper\Element\Week',
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
	public function __construct(FormUtil $formUtil)
	{
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
		if ($this->formUtil->getOverride()){
		    $serviceManager->setAllowOverride(true);
		    
		    foreach ($this->overrideInvokables as $name => $service) {
		    	$serviceManager->setInvokableClass($name, $service);
		    }
		}
		$factories  = $this->getFactories($serviceManager);
		foreach ($factories as $name => $factory) {
			$serviceManager->setFactory($name, $factory);
		}
	}

	/**
	 * Returns an array of view helper factories
	 * @return array
	 */
	protected function getFactories(ServiceManager $serviceManager)
	{
		$formUtil   = $this->formUtil;
		$results = array(
				'collection'    => function($sm) use ($formUtil) {
					$instance       = new Collection($formUtil);
					return $instance;
				},
				'offset'           => function($sm) use ($formUtil) {
					$instance       = new Offset($formUtil);
					return $instance;
				},
				'radio'           => function($sm) use ($formUtil) {
					$instance       = new Radio($formUtil);
					return $instance;
				},
				'row'           => function($sm) use ($formUtil) {
					$instance       = new Row($formUtil);
					return $instance;
				},
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
				},
				'fieldset'                   => function($sm) use ($bootstrapUtil, $formUtil) {
					return new Fieldset($bootstrapUtil, $formUtil);
				},
				'formfile'                       => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormFile($formUtil);
					return $instance;
				},
				'forminput'                      => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormInput($formUtil);
					return $instance;
				},*/
				'label'                      => function($sm) use ($formUtil) {
					//$formLabelHelper    = $sm->get('formLabel');
					$instance           = new Label($formUtil);
					return $instance;
				},/*
				'formmulticheckbox'              => function($sm) use ($bootstrapUtil) {
					$formMultiCheckboxHelper    = $sm->get('formMultiCheckbox');
					$instance                   = new \Bootstrap\Form\View\Helper\FormMultiCheckbox(
							$formMultiCheckboxHelper, $bootstrapUtil);
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
				'formselect'                     => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormSelect($bootstrapUtil, $formUtil);
					return $instance;
				},
				'formsubmit'                     => function($sm) use ($bootstrapUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormSubmit($bootstrapUtil);
					return $instance;
				},
				'formtextarea'                   => function($sm) use ($bootstrapUtil, $formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormTextarea($bootstrapUtil, $formUtil);
					return $instance;
				},*/
				'form'                           => function($sm) use ($formUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\Form($formUtil);
					return $instance;
				},
		);
		$factories = array();
		foreach ($results as $name => $factory){
		    $factories['bs'.$name] = $factory;
		    if ('form' == $name && $formUtil->getOverride()){
		        $factories[$name] = $factory;
		    }elseif($formUtil->getOverride() && $serviceManager->has('form'.$name)){
		        $factories['form'.$name] = $factory;
		    }
		}
		return $factories;
	}
}