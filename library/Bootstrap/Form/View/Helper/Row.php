<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormRow;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Button;

/**
 *
 * @author alexandre
 *        
 */
class Row extends FormRow
{
    /**
     * Add <div class="form-group"></div> when true
     * 
     * @var boolean
     */
    protected $formGroup = true; 
    
    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param  ElementInterface $element
     * @throws \Zend\Form\Exception\DomainException
     * @return string
     */    
    public function render(ElementInterface $element)
    {
    	$markup = parent::render($element);
        if ($markup && $this->getFormGroup()){
            $markup = '<div class="form-group">' . $markup . '</div>';
        }
    	return $markup;
    }
	/**
	 * @return the $formGroup
	 */
	public function getFormGroup() {
		return $this->formGroup;
	}

	/**
	 * @param boolean $formGroup
	 */
	public function setFormGroup($formGroup = true) {
		$this->formGroup = (boolean)$formGroup;
	}

    
}

?>