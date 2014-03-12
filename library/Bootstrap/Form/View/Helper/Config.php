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
use Bootstrap\Form\View\Helper\Element\MultiCheckbox;

use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;
use Bootstrap\Form\View\Helper\Fieldset\ButtonGroup;



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
	        'bscaptcha'       => 'Bootstrap\Form\View\Helper\Element\Captcha',
	        'bscheckbox'      => 'Bootstrap\Form\View\Helper\Element\Checkbox',
			'bscheckboxtag'   => 'Bootstrap\Form\View\Helper\CheckboxTag',
	        'bscaptcha'       => 'Bootstrap\Form\View\Helper\Element\Captcha',
	        'bscolor'         => 'Bootstrap\Form\View\Helper\Element\Color',
	        'bsdate'          => 'Bootstrap\Form\View\Helper\Element\Date',
	        'bsdateselect'    => 'Bootstrap\Form\View\Helper\Element\DateSelect',
	        'bsdatetime'      => 'Bootstrap\Form\View\Helper\Element\DateTime',
	        'bsdatetimelocal' => 'Bootstrap\Form\View\Helper\Element\DateTimeLocal',
	        'bsdatetimeselect'=> 'Bootstrap\Form\View\Helper\Element\DateTimeSelect',
	        'bselement'       => 'Bootstrap\Form\View\Helper\Element',
	        'bselementerrors' => 'Bootstrap\Form\View\Helper\ElementErrors',
	        'bsemail'         => 'Bootstrap\Form\View\Helper\Element\Email',
	        'bsfile'          => 'Bootstrap\Form\View\Helper\Element\File',
	        'bsgroup'         => 'Bootstrap\Form\View\Helper\Group',
			'bshelp'          => 'Bootstrap\Form\View\Helper\HelpBlock',
			'bsimage'         => 'Bootstrap\Form\View\Helper\Element\Image',
			'bsinlineseparator' => 'Bootstrap\Form\View\Helper\InlineSeparator',
			'bsmonth'         => 'Bootstrap\Form\View\Helper\Element\Month',
	        'bsmonthselect'   => 'Bootstrap\Form\View\Helper\Element\MonthSelect',
	        'bsnumber'        => 'Bootstrap\Form\View\Helper\Element\Number',
	        'bspassword'      => 'Bootstrap\Form\View\Helper\Element\Password',
			'bsradiotag'      => 'Bootstrap\Form\View\Helper\RadioTag',
			'bsrange'         => 'Bootstrap\Form\View\Helper\Element\Range',
			'bsreset'         => 'Bootstrap\Form\View\Helper\Element\Reset',
	        'bssearch'        => 'Bootstrap\Form\View\Helper\Element\Search',
	        'bsselect'        => 'Bootstrap\Form\View\Helper\Element\Select',
	        'bsstrong'        => 'Bootstrap\Form\View\Helper\Strong',
	        'bssubmit'        => 'Bootstrap\Form\View\Helper\Element\Submit',
	        'bstel'           => 'Bootstrap\Form\View\Helper\Element\Tel',
	        'bstext'          => 'Bootstrap\Form\View\Helper\Element\Text',
	        'bstextarea'      => 'Bootstrap\Form\View\Helper\Element\Textarea',
	        'bstime'          => 'Bootstrap\Form\View\Helper\Element\Time',
	        'bsurl'           => 'Bootstrap\Form\View\Helper\Element\Url',
	        'bsweek'          => 'Bootstrap\Form\View\Helper\Element\Week',
//	        'bsbuttongroup'   => 'Bootstrap\Form\View\Helper\Fieldset\ButtonGroup',
//			'formdescription'                    => 'Bootstrap\Form\View\Helper\FormDescription',
//			'formelement'                        => 'Bootstrap\Form\View\Helper\FormElement',
//			'formhidden'                         => 'Bootstrap\Form\View\Helper\FormHidden',
//			'formhint'                           => 'Bootstrap\Form\View\Helper\FormHint',
	);
	protected $overrideInvokables = array(
//			'formgroup'         => 'Bootstrap\Form\View\Helper\Group',
//			'formhelp'          => 'Bootstrap\Form\View\Helper\HelpBlock',            
			'formbutton'        => 'Bootstrap\Form\View\Helper\Element\Button',
	        'formcaptcha'       => 'Bootstrap\Form\View\Helper\Element\Captcha',
	        'formcheckbox'      => 'Bootstrap\Form\View\Helper\Element\Checkbox',
	        'formcolor'         => 'Bootstrap\Form\View\Helper\Element\Color',
	        'formdate'          => 'Bootstrap\Form\View\Helper\Element\Date',
	        'formdateselect'    => 'Bootstrap\Form\View\Helper\Element\DateSelect',
	        'formdatetime'      => 'Bootstrap\Form\View\Helper\Element\DateTime',
	        'formdatetimelocal' => 'Bootstrap\Form\View\Helper\Element\DateTimeLocal',
	        'formdatetimeselect'=> 'Bootstrap\Form\View\Helper\Element\DateTimeSelect',
	        'formelement'       => 'Bootstrap\Form\View\Helper\Element',
	        'formelementerrors' => 'Bootstrap\Form\View\Helper\ElementErrors',
	        'formemail'         => 'Bootstrap\Form\View\Helper\Element\Email',
	        'formfile'          => 'Bootstrap\Form\View\Helper\Element\File',
	        'formmonth'         => 'Bootstrap\Form\View\Helper\Element\Month',
	        'formmonthselect'   => 'Bootstrap\Form\View\Helper\Element\MonthSelect',
	        'formnumber'        => 'Bootstrap\Form\View\Helper\Element\Number',
	        'formpassword'      => 'Bootstrap\Form\View\Helper\Element\Password',
	        'formrange'         => 'Bootstrap\Form\View\Helper\Element\Range',
	        'formreset'         => 'Bootstrap\Form\View\Helper\Element\Reset',
	        'formsearch'        => 'Bootstrap\Form\View\Helper\Element\Search',
	        'formselect'        => 'Bootstrap\Form\View\Helper\Element\Select',
	        'formsubmit'        => 'Bootstrap\Form\View\Helper\Element\Submit',
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
				'multicheckbox' => function($sm) use ($formUtil) {
					$instance       = new MultiCheckbox($formUtil);
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
				'buttongroup'  => function($sm) use ($formUtil) {
					$instance       = new ButtonGroup($formUtil);
					return $instance;
				},
				/*
				'formelementerrors'              => function($sm) use ($bootstrapUtil) {
					$instance       = new \Bootstrap\Form\View\Helper\FormElementErrors($bootstrapUtil);
					return $instance;
				},
				'fieldset'                   => function($sm) use ($bootstrapUtil, $formUtil) {
					return new Fieldset($bootstrapUtil, $formUtil);
				},*/
				'label'                      => function($sm) use ($formUtil) {
					//$formLabelHelper    = $sm->get('formLabel');
					$instance           = new Label($formUtil);
					return $instance;
				},
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