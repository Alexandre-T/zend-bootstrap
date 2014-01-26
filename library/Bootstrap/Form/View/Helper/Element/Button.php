<?php
namespace Bootstrap\Form\View\Helper\Element;

use Zend\Form\View\Helper\FormButton;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Bootstrap\Util;
/**
 *
 * @author alexandre
 *        
 */
class Button extends FormButton
{
    
    const BUTTON_OPTION = 'bs-type';
    const BUTTON_SIZE   = 'bs-size';
    const BUTTON_BLOCK  = 'bs-block';
    const BUTTON_ACTIVE = 'bs-active';
    
    const BUTTON_CLASS = 'btn';

    const BUTTON_OPTION_DEFAULT = 'default';
    const BUTTON_OPTION_PRIMARY = 'primary';
    const BUTTON_OPTION_SUCCESS = 'success';
    const BUTTON_OPTION_WARNING = 'warning';
    const BUTTON_OPTION_DANGER  = 'danger';
    const BUTTON_OPTION_LINK    = 'link';
    
    const BUTTON_SIZE_XS        = 'xs';
    const BUTTON_SIZE_SM        = 'sm';
    const BUTTON_SIZE_DEFAULT   = 'default';
    const BUTTON_SIZE_LG        = 'lg';
    /**
     * Valid Options Style (color) 
     * 
     * @var array
     */
    protected $validOptionButton = array (
    	self::BUTTON_OPTION_DEFAULT  => 'btn-default',
        self::BUTTON_OPTION_PRIMARY  => 'btn-primary',
        self::BUTTON_OPTION_SUCCESS  => 'btn-success',
        self::BUTTON_OPTION_WARNING  => 'btn-warning',
        self::BUTTON_OPTION_DANGER   => 'btn-danger',
        self::BUTTON_OPTION_LINK     => 'btn-link',
    );
    /**
     * Valid Size Style
     *
     * @var array
     */
    protected $validSizeButton = array (
    	self::BUTTON_SIZE_LG      => 'btn-lg',
    	self::BUTTON_SIZE_SM      => 'btn-sm',
    	self::BUTTON_SIZE_XS      => 'btn-xs',
    	self::BUTTON_SIZE_DEFAULT => '',
    );
    
    /*
     * (non-PHPdoc) @see \Zend\Form\View\Helper\FormButton::openTag()
     */
    public function openTag($attributesOrElement = null)
    {
        if (null === $attributesOrElement) {
            return '<button class="btn btn-default">';
        }
        
        if (is_array($attributesOrElement)) {
            $attributesOrElement = Util::addClassToArray($attributesOrElement,'btn btn-default');
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<button %s>', $attributes);
        }
        
        if (! $attributesOrElement instanceof ElementInterface) {
            throw new Exception\InvalidArgumentException(sprintf('%s expects an array or Zend\Form\ElementInterface instance; received "%s"', __METHOD__, (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))));
        }
        
        $element = $attributesOrElement;
        $name = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf('%s requires that the element has an assigned name; none discovered', __METHOD__));
        }
        
        $class = self::BUTTON_CLASS;
        $class = Util::addWords($class,$this->getBootstrapActive($element));
        $class = Util::addWords($class,$this->getBootstrapBlock($element));
        $class = Util::addWords($class,$this->getBootstrapSize($element));
        $class = Util::addWords($class,$this->getBootstrapType($element));
                
        $attributes = $element->getAttributes();
        if (! array_key_exists('class',$attributes) ){
            $attributes['class'] = '';
        }
        $attributes['class'] = Util::addWords($attributes['class'],$class);
        $attributes['name'] = $name;
        $attributes['type'] = $this->getType($element);
        $attributes['value'] = $element->getValue();
        
        return sprintf('<button %s>', $this->createAttributesString($attributes));
    }
    
    /**
     * Determine button Css Option to use
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getBootstrapType(ElementInterface $element)
    {
    	$option = $element->getOption(self::BUTTON_OPTION);
    	if (empty($option)) {
    		return 'btn-default';
    	}
    
    	$option = strtolower($option);
    	if (!array_key_exists($option, $this->validOptionButton)) {
    		return 'btn-default';
    	}
    
    	return $this->validOptionButton[$option];
    }
    
    /**
     * Determine button Css Size to use
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getBootstrapSize(ElementInterface $element)
    {
    	$size = $element->getOption(self::BUTTON_SIZE);
    	if (empty($size)) {
    		return '';
    	}
    
    	$size = strtolower($size);
    	if (!array_key_exists($size, $this->validSizeButton)) {
    		return '';
    	}
    
    	return $this->validSizeButton[$size];
    }
    
    /**
     * Determine button Css is a block or not
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getBootstrapBlock(ElementInterface $element)
    {
    	if ($element->getOption(self::BUTTON_BLOCK)) {
    		return 'btn-block';
    	}
    
    	return '';
    }
    
    /**
     * Determine button Css is activated (pressed) or not
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getBootstrapActive(ElementInterface $element)
    {
    	if ($element->getOption(self::BUTTON_ACTIVE)) {
    		return 'active';
    	}
    
    	return '';
    }
    
}

?>