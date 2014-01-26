<?php
namespace Bootstrap\Form\View\Helper;

use Bootstrap\Form\Util as FormUtil;
use Zend\View\Helper\HelperInterface;
use Zend\Form\View\Helper\FormLabel as ViewHelperFormLabel;
use Bootstrap\Util;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

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
    
    /*
     * (non-PHPdoc) @see \Zend\Form\View\Helper\FormLabel::openTag() Generate an opening label tag @param null|array|ElementInterface $attributesOrElement @throws Exception\InvalidArgumentException @throws Exception\DomainException @return string
     */
    public function openTag($attributesOrElement = null)
    {
        if (null === $attributesOrElement) {
            if (FormUtil::FORM_TYPE_INLINE == $this->formUtil->getDefaultFormType()) {
                return '<label class="sr-only">';
            } else {
                return '<label>';
            }
        }
        
        if (is_array($attributesOrElement)) {
            // add class sr-only when Inline Form
            if (FormUtil::FORM_TYPE_INLINE == $this->formUtil->getDefaultFormType()) {
                $attributesOrElement = Util::addClassToArray($attributesOrElement,'sr-only');
            }
            $attributes = $this->createAttributesString($attributesOrElement);
            
            return sprintf('<label %s>', $attributes);
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
        if (FormUtil::FORM_TYPE_INLINE == $this->formUtil->getDefaultFormType()) {
            if (is_array($labelAttributes) && array_key_exists('class', $labelAttributes)) {
                Util::addWords('sr-only', $labelAttributes['class']);
            } else {
                $labelAttributes['class'] = 'sr-only';
            }
        }
        $attributes = array(
            'for' => $id
        );
        
        if (! empty($labelAttributes)) {
            $attributes = array_merge($labelAttributes, $attributes);
        }
        
        $attributes = $this->createAttributesString($attributes);
        return sprintf('<label %s>', $attributes);
    }
}

?>