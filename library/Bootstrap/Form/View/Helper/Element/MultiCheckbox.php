<?php
namespace Bootstrap\Form\View\Helper\Element;
use Zend\Form\View\Helper\FormMultiCheckbox;
use Bootstrap\Form\Util as FormUtil;
use Bootstrap\Util;
use Zend\Form\ElementInterface;
use Zend\Form\Element\MultiCheckbox as ZE_MultiCheckbox;
use Bootstrap\Form\View\Helper\CheckboxTag as HelperCheckboxTag;

/**
 *
 * @author alexandre
 *        
 */
class MultiCheckbox extends FormMultiCheckbox
{
    /**
     * 
     * @var FormUtil
     */
    protected $formUtil;
    
    /**
     * 
     */
    protected $tagHelper;
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
	protected function renderOptions(ZE_MultiCheckbox $element, array $options, array $selectedOptions, array $attributes) {
	    
		if (FormUtil::FORM_TYPE_HORIZONTAL == $this->formUtil->getDefaultFormType()){
		    //Add class radio-inline to label
		    $labelAttributes = $element->getLabelAttributes();
		    $labelAttributes = Util::addClassToArray($labelAttributes,$this->getCssInline());
		    $element->setLabelAttributes($labelAttributes);
		    return parent::renderOptions($element, $options, $selectedOptions, $attributes);
		}elseif (FormUtil::FORM_TYPE_BASIC == $this->formUtil->getDefaultFormType()){
		    //Init var
		    $this->tagHelper = $this->getTagHelper(); 
		    $close = $this->tagHelper->closeTag();
		    $open  = $this->tagHelper->openTag();
		    $buffer = $this->getSeparator();
		    $this->setSeparator( $close.' '.$open);
		    $parent = parent::renderOptions($element, $options, $selectedOptions, $attributes);
            //restore Separator
		    $this->setSeparator($buffer);
		    
		    return $open . $parent . $close;
		}elseif (FormUtil::FORM_TYPE_INLINE == $this->formUtil->getDefaultFormType()){
		    //Remove class radio-inline to label
		    $labelAttributes = $element->getLabelAttributes();
		    $labelAttributes = Util::removeClassToArray($labelAttributes,$this->getCssInline());
		    $element->setLabelAttributes($labelAttributes);
		    return parent::renderOptions($element, $options, $selectedOptions, $attributes);
		}
		
		
	}
	/**
	 * Return checkbox-inline (or radio-inline if getInputType is overrided)
	 * 
	 * @return string
	 */
	protected function getCssInLine(){
	    return $this->getInputType(). '-inline';
	}
	    
    /**
     * Retrieve the RadioTag helper
     *
     * @return FormElement
     */
    protected function getTagHelper ()
    {
    	if ($this->tagHelper) {
    		return $this->tagHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->tagHelper = $this->view->plugin('bscheckboxtag');
    	}
    
    	if (! $this->tagHelper instanceof HelperCheckboxTag) {
    		$this->tagHelper = new HelperCheckboxTag();
    	}
    
    	return $this->tagHelper;
    }
}

?>