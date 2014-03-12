<?php
namespace Bootstrap\Form\View\Helper;
use Bootstrap\Form\View\Helper\CheckboxTag as HelperCheckboxTag;
use Bootstrap\Form\View\Helper\Element as HelperElement;
use Bootstrap\Form\View\Helper\ElementErrors as HelperElementErrors;
use Bootstrap\Form\View\Helper\InlineSeparator as HelperInlineSeparator;
use Bootstrap\Form\View\Helper\Offset as HelperOffset;
use Bootstrap\Form\View\Helper\RadioTag as HelperRadioTag;
use Bootstrap\Form\View\Helper\Strong as HelperStrong;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\View\Helper\FormRow;
use Bootstrap\Form\Exception\UnsupportedHelperTypeException;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\MultiCheckbox;
use Bootstrap\Util;
use Zend\Form\Element\MonthSelect;

/**
 *
 * @author alexandre
 *        
 */
class Row extends FormRow
{

    const LABEL_TOTAL_PREPEND = 'totalprepend';

    /**
     * @var 
     */
    protected $elementHelper;

    /**
     * @var 
     */
    protected $elementErrorsHelper;

    /**
     * @var HelpBlock
     */
    protected $helpBlockHelper;
    
    /**
     * @var CheckboxTag
     */
    protected $checkboxTagHelper;

    /**
     * @var Group 
     */
    protected $groupHelper;
    
    /**
     * @var HelperInlineSeparator
     */
    protected $inlineSeparatorHelper;
    
    /**
     * @var Offset
     */
    protected $offsetHelper;

    /**
     * @var CheckboxTag
     */
    protected $radioTagHelper;
    
    /**
     * @var Strong
     */
    protected $strongHelper;

    /**
     * @var FormControlsTwb
     */
    protected $controlsHelper;
    
    /**
     * @var FormUtil
     */
    protected $formUtil;
    
    /**
     * Constructor
     *
     * @param FormUtil $formUtil
     */
    public function __construct (FormUtil $formUtil)
    {
		$this->formUtil = $formUtil;
    }

    /**
     * Utility form helper that renders a label (if it exists), an element and
     * errors
     *
     * @param ElementInterface $element            
     * @throws \Zend\Form\Exception\DomainException
     * @return string
     */
    public function render (ElementInterface $element, FormUtil $formUtil = null)
    {
        $elementErrors = '';
        $hasError     = false;
        
        
        $renderer = $this->getView();
        if (! method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }
        
        if (null == $formUtil) {
            $formUtil = $this->formUtil;
        }
        
        //Retrieving Helpers  
        $checkboxTagHelper = $this->getCheckboxTagHelper();
        $radioTagHelper = $this->getRadioTagHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();
        $elementHelper = $this->getElementHelper();
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $groupHelper = $this->getGroupHelper();
        $helpBlockHelper = $this->getHelpBlockHelper();
        $inlineSeparatorHelper = $this->getInlineSeparatorHelper();
        $labelHelper = $this->getLabelHelper();
        $offsetHelper = $this->getOffsetHelper();
        $strongHelper = $this->getStrongHelper();
        
        //Label computing
        $label = $element->getLabel();
        if (!empty($label)) {
        	// Translate the label
        	if (null !== ($translator = $this->getTranslator())) {
        		$label = $translator->translate($label,
        				$this->getTranslatorTextDomain());
        	}
        }
        
        //Errors computing
        $inputErrorClass = $this->getInputErrorClass();
        // Does this element have errors ?
        if (count($element->getMessages()) > 0 && ! empty($inputErrorClass)) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute(
                    'class') . ' ' : '');
            $classAttributes = $classAttributes . $inputErrorClass;
            $element->setAttribute('class', $classAttributes);
        }
        
        if ($this->renderErrors) {
        	$elementErrors = $elementErrorsHelper->render($element);
        	$hasError     = !empty($elementErrors);        	
        }
        
        //Init
        $markup = '';
        $elementHelper->setFormUtil($this->formUtil);
        
        //Helper order are called in different order 
        switch ($this->formUtil->getDefaultFormType()){
        	case FormUtil::FORM_TYPE_BASIC :
        	    if ($element instanceof MonthSelect){
        	        if (! empty($label)) {
                        $markup = $labelHelper->render($label, $element, $this->formUtil);
                    }
                    $tmp     = $elementHelper->render($element);
                    $tmp     = $inlineSeparatorHelper->render($tmp,' <select','</select>');
                    $tmp     = $helpBlockHelper->render($element,$tmp);
                    //$tmp    .= $elementErrors;
                    $markup .= $offsetHelper->render($element, $tmp, $this->formUtil);
                    unset($tmp);
                    $markup  = $groupHelper->render($markup,$hasError);
        	    }elseif (Util::isButton($element)){
        	        $markup  = $elementHelper->render($element);        	        
        	    }elseif ($element instanceof MultiCheckbox){
        	        $markup = $elementHelper->render($element);
        	        if (!empty($label)){
                        $markup = $labelHelper->render($label,$element,$this->formUtil) . $markup;
        	        }
        	        $markup  = $helpBlockHelper->render($element,$markup);
        	        $markup  = $groupHelper->render($markup,$hasError);
        	        
        	    }elseif ($element instanceof Checkbox){
        	        $markup  = $elementHelper->render($element);
        	        $markup .= $label;
        	        $markup  = $labelHelper->render($markup,$element,$this->formUtil);
                    $markup  = $checkboxTagHelper->render($markup);                    
                    $markup  = $helpBlockHelper->render($element,$markup);                    
                    $markup  = $groupHelper->render($markup,$hasError);
        	    }else{
        	        if (!empty($label)){
                        $markup  = $labelHelper->render($label,$element,$this->formUtil);
        	        }
                    $markup .= $elementHelper->render($element);
                    $markup  = $helpBlockHelper->render($element,$markup);
                    $markup  = $groupHelper->render($markup,$hasError);
        	    }
        	    break;
        	case FormUtil::FORM_TYPE_INLINE :
                if (Util::isButton($element)){
        	    	$markup  = $elementHelper->render($element);
        	    } elseif ($element instanceof MultiCheckbox) {
        	        $markup  = $elementHelper->render($element);
        	        $markup  = $radioTagHelper->render($markup);
        	    	$markup  = $groupHelper->render($markup,$hasError);
        	    }elseif ($element instanceof Checkbox){
        	    	$markup  = $elementHelper->render($element);
        	    	$markup .= ' '.$label;
        	    	$markup  = $labelHelper->render($markup,$element,$this->formUtil);
        	    	//@todo : Add the errors border for the inline Form
        	    	$markup  = $checkboxTagHelper->render($markup);
        	    	//@todo : Add the errorText in a box for the collection ?
        	    }else{
        	        if (!empty($label)){
        	           $markup  = $labelHelper->render($label,$element,$this->formUtil);
        	        }
        	    	$markup .= $elementHelper->render($element);
        	    	$markup  = $groupHelper->render($markup,$hasError);
        	    }
                break;
        	case FormUtil::FORM_TYPE_HORIZONTAL :
                if ($element instanceof MonthSelect){
        	        if (! empty($label)) {
                        $markup = $labelHelper->render($label, $element, $this->formUtil);
                    }
                    $tmp     = $elementHelper->render($element);
                    $tmp     = $inlineSeparatorHelper->render($tmp,' <select','</select>');
                    $tmp     = $helpBlockHelper->render($element,$tmp);
                    $markup .= $offsetHelper->render($element, $tmp, $this->formUtil);
                    unset($tmp);
                    $markup  = $groupHelper->render($markup,$hasError);
        	    }elseif (Util::isButton($element)) {
                    $markup = $elementHelper->render($element);
                    $markup = $offsetHelper->render($element, $markup, $this->formUtil);
                    $markup = $groupHelper->render($markup,$hasError);
                } elseif ($element instanceof MultiCheckbox) {
                    //Be carefull MultiCheckbox is an instance of checkbox, so this tests must prepend the Checkbox test !
                    $markup = $elementHelper->render($element);
                    $markup = $helpBlockHelper->render($element,$markup);
                    $markup = $offsetHelper->render($element, $markup, $this->formUtil);
                    if (!empty($label)){
                        $markup = $strongHelper->render($label, $this->formUtil) . $markup;
                    }
                    $markup = $groupHelper->render($markup,$hasError);
                } elseif ($element instanceof Checkbox) {                    
                    $markup = $elementHelper->render($element);
                    $markup .= $label;
                    $markup = $labelHelper->render($markup, $element, $this->formUtil);
                    $markup = $checkboxTagHelper->render($markup);
                    $markup = $helpBlockHelper->render($element,$markup);
                    $markup.= $elementErrors;
                    $markup = $offsetHelper->render($element, $markup, $this->formUtil);
                    $markup = $groupHelper->render($markup,$hasError);
                } else {
                    if (! empty($label)) {
                        $markup = $labelHelper->render($label, $element, $this->formUtil);
                    }
                    $tmp  = $helpBlockHelper->render($element,$elementHelper->render($element));
                    $tmp    .= $elementErrors;
                    $markup .= $offsetHelper->render($element, $tmp, $this->formUtil);
                    $markup  = $groupHelper->render($markup,$hasError);
                }
        	    break;
        }
        
        return $markup;
        
    }

    /**
     * Retrieve the Label helper
     *
     * @return Label
     */
    protected function getLabelHelper ()
    {
        if ($this->labelHelper) {
            return $this->labelHelper;
        }
        
        if (method_exists($this->view, 'plugin')) {
            $this->labelHelper = $this->view->plugin('bs_label');
        }
        
        if (! $this->labelHelper instanceof Label) {
            throw new UnsupportedHelperTypeException(
                    'Label helper Bootstrap\Form\View\Helper\Label unavailable or unsupported type (' .
                             get_class($this->labelHelper) . ' instead).');
            $this->labelHelper = new Label($this->formUtil);
        }
        
        if ($this->hasTranslator()) {
            $this->labelHelper->setTranslator($this->getTranslator(), 
                    $this->getTranslatorTextDomain());
        }
        
        return $this->labelHelper;
    }

    /**
     * Retrieve the Form Group helper
     *
     * @return Group
     * @throws \Bootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getGroupHelper ()
    {
        if (! $this->groupHelper) {
            if (method_exists($this->view, 'plugin')) {
                $this->groupHelper = $this->view->plugin('bs_group');
            }
            if (! $this->groupHelper instanceof Group) {
                throw new UnsupportedHelperTypeException(
                        'Form group helper Bootstrap\Form\View\Helper\Group unavailable or unsupported type.');
            }
        }
        return $this->groupHelper;
    }

    /**
     * Retrieve the Help Block helper
     *
     * @return HelpBlock
     * @throws \Bootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getHelpBlockHelper ()
    {
        if (! $this->helpBlockHelper) {
            if (method_exists($this->view, 'plugin')) {
                $this->helpBlockHelper = $this->view->plugin('bshelp');
            }
            if (! $this->helpBlockHelper instanceof HelpBlock) {
                throw new UnsupportedHelperTypeException(
                        'Help block helper Bootstrap\Form\View\Helper\HelpBlock unavailable or unsupported type.');
            }
            if ($this->hasTranslator()) {
                $this->helpBlockHelper->setTranslator($this->getTranslator(), 
                        $this->getTranslatorTextDomain());
            }
        }
        return $this->helpBlockHelper;
    }

    /**
     * Retrieve the CheckboxTag helper
     *
     * @return HelperCheckboxTag
     */
    protected function getCheckboxTagHelper ()
    {
    	if ($this->checkboxTagHelper) {
    		return $this->checkboxTagHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->checkboxTagHelper = $this->view->plugin('bscheckboxtag');
    	}
    
    	if (! $this->checkboxTagHelper instanceof HelperCheckboxTag) {
    		$this->checkboxTagHelper = new HelperCheckboxTag();
    	}
    
    	return $this->checkboxTagHelper;
    }

    /**
     * Retrieve the Offset helper
     *
     * @return HelperOffset
     */
    protected function getOffsetHelper ()
    {
    	if ($this->offsetHelper) {
    		return $this->offsetHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->offsetHelper = $this->view->plugin('bsoffset');
    	}
    
    	if (! $this->offsetHelper instanceof HelperOffset) {
    		$this->offsetHelper = new HelperOffset();
    	}
    
    	return $this->offsetHelper;
    }
    
    /**
     * Retrieve the RadioTag helper
     *
     * @return HelperRadioTag
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
    
    /**
     * Retrieve the Strong helper
     *
     * @return HelperStrong
     */
    protected function getStrongHelper ()
    {
    	if ($this->strongHelper) {
    		return $this->strongHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->strongHelper = $this->view->plugin('bsstrong');
    	}
    
    	if (! $this->strongHelper instanceof HelperStrong) {
    		$this->strongHelper = new HelperStrong();
    	}
    
    	return $this->strongHelper;
    }
    
    /**
     * Retrieve the HelperElement helper
     *
     * @return HelperElement
     */
    protected function getElementHelper ()
    {
        if ($this->elementHelper) {
            return $this->elementHelper;
        }
        
        if (method_exists($this->view, 'plugin')) {
            $this->elementHelper = $this->view->plugin('bselement');
        }
        
        if (! $this->elementHelper instanceof HelperElement) {
            $this->elementHelper = new HelperElement();
        }
        
        return $this->elementHelper;
    }

    /**
     * Retrieve the FormElement helper
     *
     * @return HelperInlineSeparator
     */
    protected function getInlineSeparatorHelper ()
    {
        if ($this->inlineSeparatorHelper) {
            return $this->inlineSeparatorHelper;
        }
        
        if (method_exists($this->view, 'plugin')) {
            $this->inlineSeparatorHelper = $this->view->plugin('bsinlineseparator');
        }
        
        if (! $this->inlineSeparatorHelper instanceof HelperInlineSeparator) {
            $this->inlineSeparatorHelper = new HelperInlineSeparator();
        }
        
        return $this->inlineSeparatorHelper;
    }
    
    /**
     * Retrieve the FormElementErrors helper
     *
     * @return FormElementErrors
     */
    protected function getElementErrorsHelper()
    {
    	if ($this->elementErrorsHelper) {
    		return $this->elementErrorsHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->elementErrorsHelper = $this->view->plugin('bs_element_errors');
    	}
    
    	if (!$this->elementErrorsHelper instanceof HelperElementErrors) {
    		$this->elementErrorsHelper = new HelperElementErrors();
    	}
    
    	return $this->elementErrorsHelper;
    }
    
    /*
     * (non-PHPdoc) @see \Zend\Form\View\Helper\FormRow::__invoke()
     */
    public function __invoke (\Zend\Form\ElementInterface $element = null, $labelPosition = null, $renderErrors = null, $partial = null)
    {
        if (! $element) {
            return $this;
        }
        
        if ($labelPosition !== null) {
            if ($labelPosition instanceof FormUtil) {
                $this->formUtil = $labelPosition;
            } else {
                $this->setLabelPosition($labelPosition);
            }
        } elseif ($this->labelPosition === null) {
            $this->setLabelPosition(self::LABEL_PREPEND);
        }
        
        if ($renderErrors !== null) {
            $this->setRenderErrors($renderErrors);
        }
        
        if ($partial !== null) {
            $this->setPartial($partial);
        }
        
        return $this->render($element, $this->formUtil);
    }
    
}

?>