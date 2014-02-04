<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\View\Helper\FormRadio;
use Bootstrap\Form\Util as FormUtil;
use Bootstrap\Util;
use Zend\Form\ElementInterface;
use Zend\Form\Element\MultiCheckbox;
use Bootstrap\Form\View\Helper\RadioTag as HelperRadioTag;



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
     */
    protected $radioTagHelper;
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
     * @see \Zend\Form\View\Helper\FormMultiCheckbox::render()
    */
    public function render(ElementInterface $element, FormUtil $formUtil = null) {
    	if (null != $formUtil){
    		$this->formUtil = $formUtil;
    	}
    	return parent::render($element);
    }
    
    
	/* (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormMultiCheckbox::renderOptions()
	 */
	protected function renderOptions(MultiCheckbox $element, array $options, array $selectedOptions, array $attributes) {
	    
		if (FormUtil::FORM_TYPE_HORIZONTAL == $this->formUtil->getDefaultFormType()){
		    //Add class radio-inline to label
		    $labelAttributes = $element->getLabelAttributes();
		    $labelAttributes = Util::addClassToArray($labelAttributes,'radio-inline');
		    $element->setLabelAttributes($labelAttributes);
		    return parent::renderOptions($element, $options, $selectedOptions, $attributes);
		}elseif (FormUtil::FORM_TYPE_BASIC == $this->formUtil->getDefaultFormType()){
		    //Init var
		    $this->radioTagHelper = $this->getRadioTagHelper(); 
		    $close = $this->radioTagHelper->closeTag();
		    $open  = $this->radioTagHelper->openTag();
		    $buffer = $this->getSeparator();
		    $this->setSeparator( $close.' '.$open);
		    $parent = parent::renderOptions($element, $options, $selectedOptions, $attributes);
            //restore Separator
		    $this->setSeparator($buffer);
		    
		    return $open . $parent . $close;
		}elseif (FormUtil::FORM_TYPE_INLINE == $this->formUtil->getDefaultFormType()){
		    //Remove class radio-inline to label
		    $labelAttributes = $element->getLabelAttributes();
		    $labelAttributes = Util::removeClassToArray($labelAttributes,'radio-inline');
		    $element->setLabelAttributes($labelAttributes);
		    return parent::renderOptions($element, $options, $selectedOptions, $attributes);
		}
		
		
	}
	    
    /**
     * Retrieve the RadioTag helper
     *
     * @return FormElement
     */
    protected function getRadioTagHelper ()
    {
    	if ($this->radioTagHelper) {
    		return $this->radioTagHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->radioTagHelper = $this->view->plugin('bsradiotag');
    	}
    
    	if (! $this->radioTagHelper instanceof HelperRadioTag) {
    		$this->radioTagHelper = new HelperRadioTag();
    	}
    
    	return $this->radioTagHelper;
    }
}

?>