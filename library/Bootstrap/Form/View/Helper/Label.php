<?php
namespace Bootstrap\Form\View\Helper;

use Bootstrap\Form\Util as FormUtil;
use Zend\View\Helper\HelperInterface;
use Zend\Form\View\Helper\FormLabel as ViewHelperFormLabel;
use Bootstrap\Util;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Radio;

/**
 * Form
 *
 * @package zend-bootstrap
 * @copyright Alexandre-T (c) - http://www.at-it.fr
 * @license Apache License v2 https://github.com/Alexandre-T/zend-bootstrap/blob/master/LICENSE
 * @link https://github.com/Alexandre-T/zend-bootstrap
 * @link http://www.at-it.fr
 * @author alexandre
 *        
 */
class Label extends ViewHelperFormLabel implements HelperInterface
{

    /**
     * Bootstrap\Form\Util
     */
    protected $formUtil;

    /**
     * Constructor
     *
     * @param FormUtil $formUtil            
     */
    public function __construct(FormUtil $formUtil)
    {
        $this->formUtil = $formUtil;
    }
    
    /**
     * Generate a form label, optionally with content
     *
     * Always generates a "for" statement, as we cannot assume the form input
     * will be provided in the $labelContent.
     *
     * @param  ElementInterface $element
     * @param  null|string      $labelContent
     * @param  null|FormUtil|string  $position
     * @throws Exception\DomainException
     * @return string|FormLabel
     */
    public function __invoke(ElementInterface $element = null, $labelContent = null, $position = null)
    {
    	if (!$element) {
    		return $this;
    	}
    	if ($position instanceof FormUtil){
    	    $this->formUtil = $position;
    	    $position = self::PREPEND;
    	}
        return parent::__invoke($element,$labelContent,$position);
    }
    
    /*
     * (non-PHPdoc) @see \Zend\Form\View\Helper\FormLabel::openTag() Generate an opening label tag @param null|array|ElementInterface $attributesOrElement @throws Exception\InvalidArgumentException @throws Exception\DomainException @return string
     */
    public function openTag($attributesOrElement = null, FormUtil $formUtil = null)
    {
        if (null === $formUtil){
            $formUtil = $this->formUtil;
        }
        
        if (null === $attributesOrElement) {            
            if (FormUtil::FORM_TYPE_INLINE == $formUtil->getDefaultFormType()) {
                return '<label class="sr-only">';
            } elseif (FormUtil::FORM_TYPE_HORIZONTAL == $formUtil->getDefaultFormType()) {
                $colSize = $this->formUtil->getCss();
                return '<label class="control-label '.$colSize.'">';
            }  {
                return '<label>';
            }
        }
        
        if (is_array($attributesOrElement)) {
            
            if (FormUtil::FORM_TYPE_INLINE == $formUtil->getDefaultFormType()
                && ! (isset($attributesOrElement['type']) && ( 'checkbox' == $attributesOrElement['type'] || 'radio' == $attributesOrElement['type']))){
                    // add class sr-only when Inline Form and not (checkbox or radio type)
                    // @todo add to test
                    $attributesOrElement = Util::addClassToArray($attributesOrElement,'sr-only');
            }elseif(FormUtil::FORM_TYPE_HORIZONTAL == $formUtil->getDefaultFormType()){
                $colSize = $this->formUtil->getCss();
                $attributesOrElement = Util::addClassToArray($attributesOrElement,"control-label $colSize");
            }
            $attributes = $this->createAttributesString($attributesOrElement);
            if ($attributes){
                return sprintf('<label %s>', $attributes);
            }else{
                return '<label>';
            }
        }
        
        if (! $attributesOrElement instanceof ElementInterface) {
            throw new Exception\InvalidArgumentException(sprintf('%s expects an array or Zend\Form\ElementInterface instance; received "%s"', __METHOD__, (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))));
        }
        
        $id = $this->getId($attributesOrElement);
        if (null === $id) {
            throw new Exception\DomainException(sprintf('%s expects the Element provided to have either a name or an id present; neither found', __METHOD__));
        }
        
        $labelAttributes = $attributesOrElement->getLabelAttributes();
        // add class sr-only when Inline Form
        // @todo add to test
        if (FormUtil::FORM_TYPE_INLINE == $formUtil->getDefaultFormType() && ! ($attributesOrElement instanceof Checkbox || $attributesOrElement instanceof Radio)) {
            if (is_array($labelAttributes) && array_key_exists('class', $labelAttributes)) {
                Util::addWords('sr-only', $labelAttributes['class']);
            } else {
                $labelAttributes['class'] = 'sr-only';
            }
        }elseif(FormUtil::FORM_TYPE_HORIZONTAL == $formUtil->getDefaultFormType()){
            $colSize = $this->formUtil->getCss();
            if (is_array($labelAttributes) && array_key_exists('class', $labelAttributes)) {
                Util::addWords("control-label $colSize", $labelAttributes['class']);
            } else {
                $labelAttributes['class'] = "control-label $colSize";
            }
        }
        $attributes = array(
            'for' => $this->getId($attributesOrElement)
        );
        
        if (! empty($labelAttributes)) {
            $attributes = array_merge($labelAttributes, $attributes);
        }
        
        $attributes = $this->createAttributesString($attributes);
        return sprintf('<label %s>', $attributes);
    }
    /**
     * Render Label Tag
     * 
     * @param string $content
     * @param  null|array|ElementInterface $attributesOrElement
     * @param FormUtil $formUtil
     * @return string
     */
    public function render($content,$attributesOrElement = null, FormUtil $formUtil = null){
        return $this->openTag($attributesOrElement,$formUtil) . $content . $this->closeTag();
    }
}

?>