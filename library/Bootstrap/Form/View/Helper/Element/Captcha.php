<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\View\Helper\FormCaptcha;
use Zend\Form\ElementInterface;
use Bootstrap\Util;

/**
 *
 * @author alexandre
 *        
 */
class Captcha extends FormCaptcha
{
	/* (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormCaptcha::render()
	 */
	public function render(ElementInterface $element) {
	    $element->setAttribute('class',Util::addWords('form-control',$element->getAttribute('class')));
		return parent::render($element);
	}

    
    
}

?>