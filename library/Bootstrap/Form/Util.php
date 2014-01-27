<?php

namespace Bootstrap\Form;

use Bootstrap\Exception\InvalidParameterException;
/**
 *
 * @author alexandre
 *        
 */
class Util {
	/**
	 * Form type Basic
	 * @var string
	 */
	const FORM_TYPE_BASIC  = 'basic';
	
	/**
	 * Form type Horizontal
	 * @var string
	 */
	const FORM_TYPE_HORIZONTAL  = 'horizontal';
	
	/**
	 * Form type Inline
	 * @var string
	 */
	const FORM_TYPE_INLINE      = 'inline';
	
	/**
	 * Supported form types
	 * @var array
	 */
	protected $supportedFormTypes   = array(
			self::FORM_TYPE_BASIC,
			self::FORM_TYPE_HORIZONTAL,
			self::FORM_TYPE_INLINE,
	);
	
	/**
	 * Default form type
	 * @var string
	 */
	protected $defaultFormType = self::FORM_TYPE_BASIC;
	
	/**
	 * Override the DefaultZendViewHelper
	 * 
	 * @var boolean
	 */
	protected $overrideZendHelper = true;
	
	/**
	 * Constructor
	 * @param string|null $defaultFormType
	 */
	public function __construct($defaultFormType = self::FORM_TYPE_BASIC,$override = true)
	{
		$this->setDefaultFormType($defaultFormType);
		$this->overrideZendHelper = (boolean)$override;
	}
	
	/**
	 * Returns the default form type
	 * @return string
	 */
	public function getDefaultFormType()
	{
		return $this->defaultFormType;
	}
	
	/**
	 * Sets the default form type
	 * @param string $defaultFormType
	 */
	public function setDefaultFormType($defaultFormType)
	{
		if (!$this->isFormTypeSupported($defaultFormType)) {
			$defaultFormType    = self::FORM_TYPE_BASIC;
		}
		$this->defaultFormType = $defaultFormType;
	}
	
	/**
	 * Is the specified form type supported?
	 * @param string $formType
	 * @return bool
	 */
	public function isFormTypeSupported($formType)
	{
		return in_array($formType, $this->supportedFormTypes);
	}
	
	/**
	 * Filters the specified form type and returns it - if null, uses the default, otherwise checks if the type is supported
	 * @param $formType
	 * @return string
	 * @throws \Bootstrap\Exception\InvalidParameterException
	 */
	public function filterFormType($formType)
	{
		if (is_null($formType)) {
			$formType   = $this->getDefaultFormType();
		}
		if (!$this->isFormTypeSupported($formType)) {
			throw new InvalidParameterException(sprintf("Form type '%s' is not supported.", $formType));
		}
		return $formType;
	}
	
	public function positionLabel($formType){
	    if (is_null($formType)) {
	    	$formType   = $this->getDefaultFormType();
	    }
	    if (!$this->isFormTypeSupported($formType)) {
	    	throw new InvalidParameterException(sprintf("Form type '%s' is not supported.", $formType));
	    }
	    //@FIXME
	    return $formType;
	}
	/**
	 * @return the $override
	 */
	public function getOverride() {
		return $this->overrideZendHelper;
	}

	/**
	 * @param boolean $override
	 */
	public function setOverride($override = true) {
		$this->overrideZendHelper = (boolean)$override;
	}

	
}

?>