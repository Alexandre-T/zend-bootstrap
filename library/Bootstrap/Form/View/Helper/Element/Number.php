<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\ElementInterface;
use Bootstrap\Util;
use Zend\Form\View\Helper\FormNumber;

/**
 *
 * @author alexandre
 *        
 */
class Number extends FormNumber
{
    /* (non-PHPdoc)
     * @see \Zend\Form\View\Helper\FormInput::render()
    */
    public function render(ElementInterface $element) {
    	$element->setAttribute('class',Util::addWords('form-control',$element->getAttribute('class')));
    	return parent::render ($element);
    }
}

?>