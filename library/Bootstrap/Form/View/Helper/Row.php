<?php
namespace Bootstrap\Form\View\Helper;
use Bootstrap\Form\View\Helper\CheckboxTag as HelperCheckboxTag;
use Bootstrap\Form\View\Helper\Element as HelperElement;
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
        
        //Init
        $markup = '';
        $elementHelper->setFormUtil($this->formUtil);
        
        //Helper order are called in different order 
        switch ($this->formUtil->getDefaultFormType()){
        	case FormUtil::FORM_TYPE_BASIC :
        	    if (Util::isButton($element)){
        	        $markup  = $elementHelper->render($element);        	        
        	    }elseif ($element instanceof MultiCheckbox){
        	        $markup = $elementHelper->render($element);
        	        if (!empty($label)){
                        $markup = $labelHelper->render($label,$element,$this->formUtil) . $markup;
        	        }
        	        $markup  = $helpBlockHelper->render($element,$markup);
        	        $markup  = $groupHelper->render($markup);
        	        
        	    }elseif ($element instanceof Checkbox){
        	        $markup  = $elementHelper->render($element);
        	        $markup .= $label;
        	        $markup  = $labelHelper->render($markup,$element,$this->formUtil);
                    $markup  = $checkboxTagHelper->render($markup);                    
                    $markup  = $helpBlockHelper->render($element,$markup);                    
                    $markup  = $groupHelper->render($markup);
        	    }else{
        	        if (!empty($label)){
                        $markup  = $labelHelper->render($label,$element,$this->formUtil);
        	        }
                    $markup .= $elementHelper->render($element);
                    $markup  = $helpBlockHelper->render($element,$markup);
                    $markup  = $groupHelper->render($markup);
        	    }
        	    break;
        	case FormUtil::FORM_TYPE_INLINE :
        	    if (Util::isButton($element)){
        	    	$markup  = $elementHelper->render($element);
        	    } elseif ($element instanceof MultiCheckbox) {
        	        $markup  = $elementHelper->render($element);
        	        $markup  = $radioTagHelper->render($markup);
        	    	$markup  = $groupHelper->render($markup);
        	    }elseif ($element instanceof Checkbox){
        	    	$markup  = $elementHelper->render($element);
        	    	$markup .= ' '.$label;
        	    	$markup  = $labelHelper->render($markup,$element,$this->formUtil);
        	    	$markup  = $checkboxTagHelper->render($markup);
        	    }else{
        	        if (!empty($label)){
        	           $markup  = $labelHelper->render($label,$element,$this->formUtil);
        	        }
        	    	$markup .= $elementHelper->render($element);
        	    	$markup  = $groupHelper->render($markup);
        	    }
                break;
        	case FormUtil::FORM_TYPE_HORIZONTAL :
                if (Util::isButton($element)) {
                    $markup = $elementHelper->render($element);
                    $markup = $offsetHelper->render($element, $markup, $this->formUtil);
                    $markup = $groupHelper->render($markup);
                } elseif ($element instanceof MultiCheckbox) {
                    //Be carefull MultiCheckbox is an instance of checkbox, so this tests must prepend the Checkbox test !
                    $markup = $elementHelper->render($element);
                    $markup = $helpBlockHelper->render($element,$markup);
                    $markup = $offsetHelper->render($element, $markup, $this->formUtil);
                    if (!empty($label)){
                        $markup = $strongHelper->render($label, $this->formUtil) . $markup;
                    }
                    $markup = $groupHelper->render($markup);
                } elseif ($element instanceof Checkbox) {                    
                    $markup = $elementHelper->render($element);
                    $markup .= $label;
                    $markup = $labelHelper->render($markup, $element, $this->formUtil);
                    $markup = $checkboxTagHelper->render($markup);
                    $markup = $helpBlockHelper->render($element,$markup);
                    $markup = $offsetHelper->render($element, $markup, $this->formUtil);
                    $markup = $groupHelper->render($markup);
                } else {
                    if (! empty($label)) {
                        $markup = $labelHelper->render($label, $element, $this->formUtil);
                    }
                    $tmp  = $helpBlockHelper->render($element,$elementHelper->render($element));
                    $markup .= $offsetHelper->render($element, $tmp, $this->formUtil);
                    $markup  = $groupHelper->render($markup);
                }
        	    break;
        }
        return $markup;
        
        
        
        
        
        
        
        
        
        
        /*
        
        
        
        
        
        
        
        
        // Position Label
        if ($element instanceof Checkbox || $element instanceof Radio) {
            $this->labelPosition = self::LABEL_APPEND;
            unset($this->labelAttributes['for']);
        } else {
            $this->labelPosition = self::LABEL_TOTAL_PREPEND;
            $id = $this->getId($element);
            $this->labelAttributes['for'] = $id;
            // if there is only name, we must have an id because of "for"
            // attribute label cf. HTML5 Spec
            $element->setAttribute('id', $id);
        }
        
        if ($this->partial) {
            $vars = array(
                    'element' => $element,
                    'label' => $label,
                    'labelAttributes' => $this->labelAttributes,
                    'labelPosition' => $this->labelPosition,
                    'renderErrors' => $this->renderErrors
            );
            
            return $this->view->render($this->partial, $vars);
        }
        
        if ($this->renderErrors) {
            $elementErrors = $elementErrorsHelper->render($element);
        }
        
        $elementString = $elementHelper->render($element);
        
        if (isset($label) && '' !== $label) {
            $label = $escapeHtmlHelper($label);
            $labelAttributes = $element->getLabelAttributes();
            
            if (empty($labelAttributes)) {
                $labelAttributes = $this->labelAttributes;
            }
            
            // Multicheckbox elements have to be handled differently as the HTML
            // standard does not allow nested
            // labels. The semantic way is to group them inside a fieldset
            $type = $element->getAttribute('type');
            if ($type === 'multi_checkbox' || $type === 'radio') {
                $markup = sprintf('<fieldset><legend>%s</legend>%s</fieldset>', 
                        $label, $elementString);
            } else {
                if ($element->hasAttribute('id')) {
                    $labelOpen = '';
                    $labelClose = '';
                    $label = $labelHelper($element, null, $this->formUtil);
                } else {
                    $labelOpen = $labelHelper->openTag($labelAttributes, null, 
                            $this->formUtil);
                    $labelClose = $labelHelper->closeTag();
                }
                
                // Bootstrap Css Form does not have span
                // if ($label !== '' && !$element->hasAttribute('id')) {
                // $label = '<span>' . $label . '</span>';
                // }
                
                // Button element is a special case, because label is always
                // rendered inside it
                if ($element instanceof Button) {
                    $labelOpen = $labelClose = $label = '';
                }
                
                switch ($this->labelPosition) {
                    case self::LABEL_PREPEND:
                        $markup = $labelOpen . $label . $elementString .
                                 $labelClose;
                        break;
                    case self::LABEL_TOTAL_PREPEND:
                        $markup = $labelOpen . $label . $labelClose .
                                 $elementString;
                        break;
                    case self::LABEL_APPEND:
                    default:
                        $markup = $labelOpen . $elementString . $label .
                                 $labelClose;
                        break;
                }
            }
            
            if ($this->renderErrors) {
                $markup .= $elementErrors;
            }
        } else {
            if ($this->renderErrors) {
                $markup = $elementString . $elementErrors;
            } else {
                $markup = $elementString;
            }
        }
        
        $formType = $this->formUtil->getDefaultFormType();
        if ($markup && $this->getHelpBlock()) {
            $content = $element->getOption('help-block');
            $this->helpBlockHelper = $this->getHelpBlockHelper();
            $markup = $this->helpBlockHelper->render($element, $markup);
        }
        
        if ($markup && $this->getFormGroup()) {
            // && ($formType == FormUtil::FORM_TYPE_HORIZONTAL )
            $this->formGroupHelper = $this->getFormGroupHelper();
            $markup = $this->formGroupHelper->render($element, $markup);
        }
        return $markup;*/
    }

    /**
     * Retrieve the FormLabel helper
     *
     * @return FormLabel
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
     * @return Group
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
     * @return FormElement
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
    
    /**
     * Retrieve the Strong helper
     *
     * @return HelperOffset
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
     * Retrieve the FormElement helper
     *
     * @return FormElement
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