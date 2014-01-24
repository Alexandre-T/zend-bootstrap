<?php

namespace Bootstrap\Form\View\Helper;

use Bootstrap\Util;
use Bootstrap\Form\Util as FormUtil;
use Bootstrap\Form\Exception\UnsupportedFormTypeException;

use Zend\Form\FormInterface;
use Zend\View\Helper\HelperInterface;
use Zend\Form\View\Helper\Form as ViewHelperForm;
use Zend\Form\FieldsetInterface;
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
class Form extends ViewHelperForm implements HelperInterface {
	/**
	 * Mapping of form types to form css classes
	 * @var array
	 */
	protected $formTypeMap      = array(
			FormUtil::FORM_TYPE_BASIC      => '',
			FormUtil::FORM_TYPE_HORIZONTAL => 'form-horizontal',
			FormUtil::FORM_TYPE_VERTICAL   => 'form-vertical',
			FormUtil::FORM_TYPE_INLINE     => 'form-inline',
	);
	
	/**
	 * Bootstrap utils
	 * @var Util
	 */
	protected $bootstrapUtil;
	
	/**
	 * @var FormUtil
	 */
	protected $formUtil;
	
	/**
	 * Constructor
	 * @param \Bootstrap\Util $genUtil
	 * @param \Bootstrap\Form\FormUtil $formUtil
	 */
	public function __construct(Util $genUtil, FormUtil $formUtil) {
		$this->bootstrapUtil  = $genUtil;
		$this->formUtil = $formUtil;
	}
	
	/**
	 * Invoke the helper
	 * @param FormInterface $form
	 * @param null $formType
	 * @param array $displayOptions
	 * @param bool $renderErrors
	 * @return $this|string|ViewHelperForm
	 */
	public function __invoke(FormInterface $form = null, $formType = null, array $displayOptions = array(), $renderErrors = true)
	{
		if(is_null($form)) {
			return $this;
		}
	
		return $this->render($form, $formType, $displayOptions, $renderErrors);
	}
	
	/**
	 * Renders a quick form
	 * @param FormInterface $form
	 * @param string|null $formType
	 * @param array $displayOptions
	 * @param bool $renderErrors
	 * @return string
	 */
	public function render(FormInterface $form, $formType = null, array $displayOptions = array(), $renderErrors = true)
	{
		$renderer = $this->getView();
		if (!method_exists($renderer, 'plugin')) {
			// Bail early if renderer is not pluggable
			return '';
		}
		
		if (method_exists($form, 'prepare')) {
			$form->prepare();
		}
		
		$formType   = $this->formUtil->filterFormType($formType);
		//Open Tag
		$html   = $this->openTag($form, $formType, $displayOptions);
		//Form content
	    $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                $formContent.= $this->getView()->collection($element);
            } else {
                $formContent.= $this->getView()->row($element);
            }
        }	
		//Close Tag
		$html   .= $formContent . $this->closeTag();
		return $html;
	}
	
	/**
	 * Generate an opening form tag
	 * @param  null|FormInterface $form
	 * @param null|string $formType
	 * @param array $displayOptions
	 * @throws \Bootstrap\Exception\InvalideParameterTypeException
	 * @throws \Bootstrap\Form\Exception\UnsupportedTypeException
	 * @return string
	 */
	public function openTag(FormInterface $form = null, $formType = null, $displayOptions = array())
	{
		$formType   = $this->formUtil->filterFormType($formType);
		if (!array_key_exists($formType, $this->formTypeMap)) {
			throw new UnsupportedFormTypeException("Unsupported form type '$formType'.");
		}
		//Add the good Class Attribute
		if ($form) {
		    //remove all formTypeMap
		    $class  = $this->bootstrapUtil->removeWords($this->formTypeMap, $form->getAttribute('class'));
		    //add selected formTypeMap
			$class  = $this->bootstrapUtil->addWords($this->formTypeMap[$formType], $class);
			if (array_key_exists('class', $displayOptions)) {
				$class  = $this->bootstrapUtil->addWords($displayOptions['class'], $class);
			}
			$escapeHtmlAttrHelper   = $this->getEscapeHtmlAttrHelper();
			$class                  = $this->bootstrapUtil->escapeWords($class, $escapeHtmlAttrHelper);
			$form->setAttribute('class', $class);
		}
		return parent::openTag($form);
	}
	
}

?>