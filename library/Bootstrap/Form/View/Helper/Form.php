<?php

namespace Bootstrap\Form\View\Helper;

use Bootstrap\Form\Util;

/**
 * Form
 * @package zend-bootstrap
 * @copyright Alexandre-T (c) - http://www.at-it.fr
 * @license Apache License v2 https://github.com/Alexandre-T/zend-bootstrap/blob/master/LICENSE	
 * @link https://github.com/Alexandre-T/zend-bootstrap
 * @link http://www.at-it.fr
 * @author alexandre
 *        
 */
class Form {
	/**
	 * Mapping of form types to form css classes
	 * @var array
	 */
	protected $formTypeMap      = array(
			Form::FORM_TYPE_BASIC      => '',
			Form::FORM_TYPE_HORIZONTAL => 'form-horizontal',
			Form::FORM_TYPE_VERTICAL   => 'form-vertical',
			Form::FORM_TYPE_INLINE     => 'form-inline',
	);
	
	
	
}

?>