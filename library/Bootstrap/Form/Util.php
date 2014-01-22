<?php

namespace Bootstrap\Form;

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
	 * Form type Vertical
	 * @var string
	 */
	const FORM_TYPE_VERTICAL    = 'vertical';
	
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
			self::FORM_TYPE_VERTICAL,
			self::FORM_TYPE_INLINE,
	);
	
	/**
	 * Default form type
	 * @var string
	 */
	protected $defaultFormType = self::FORM_TYPE_BASIC;
}

?>