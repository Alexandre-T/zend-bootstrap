<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\View\Helper\FormRadio;
use Bootstrap\Form\Util as FormUtil;
use Bootstrap\Util;
use Zend\Form\ElementInterface;


/**
 *
 * @author alexandre
 *        
 */
class Radio extends FormRadio
{
    /**
     * 
     * @var FormUtil
     */
    protected $formUtil;
    /**
     * 
     * @param FormUtil $formUtil
     */
    public function __construct(FormUtil $formUtil = null){
        if (is_null($formUtil)){
            $formUtil = new FormUtil();
        }
        $this->formUtil = $formUtil;
    }

    
	/* (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormMultiCheckbox::renderOptions()
	 */
	protected function renderOptions(\Zend\Form\Element\MultiCheckbox $element, array $options, array $selectedOptions, array $attributes) {
	    
		if (FormUtil::FORM_TYPE_HORIZONTAL == $this->formUtil->getDefaultFormType()){
		    //Add class radio-inline to label
		    $labelAttributes = $element->getLabelAttributes();
		    $labelAttributes = Util::addClassToArray($labelAttributes,'radio-inline');
		    $element->setLabelAttributes($labelAttributes);
		}
	    
		return parent::renderOptions($element, $options, $selectedOptions, $attributes);
		
	}
	/* (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormMultiCheckbox::render()
	 */
	public function render(ElementInterface $element, FormUtil $formUtil = null) {
		if (null != $formUtil){
		    $this->formUtil = $formUtil;
		}
		return parent::render($element);
	}


    

}

?>