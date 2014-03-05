<?php
namespace Bootstrap\Form\View\Helper\Fieldset;

use Bootstrap\Util;
use Bootstrap\Form\Exception\UnsupportedHelperTypeException;
use Bootstrap\Form\Exception\UnsupportedButtonTypeException;
use Bootstrap\Form\View\Helper\Group;
use Bootstrap\Form\View\Helper\Offset as HelperOffset;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Element as FormElement;
use Zend\Form\FieldsetInterface;
use Zend\Form\View\Helper\AbstractHelper;

/**
 *
 * @author alexandre
 *        
 */
class ButtonGroup extends AbstractHelper
{
    /**
     * 
     * @var FormUtil
     */
    protected $formUtil;

    /**
     * @var Group
     */
    protected $groupHelper;

    /**
     * @var Offset
     */
    protected $offsetHelper;
    
    public function __construct(FormUtil $formUtil = null){
        if (isset ($formUtil)){
            $this->formUtil = $formUtil;
        }else{
            $this->formUtil = new FormUtil();
        }
    }
    /**
     * Rendering Fieldset as BtnGroup
     * 
     * @param FieldsetInterface $fieldset
     * @param FormUtil $formUtil
     * @throws UnsupportedButtonTypeException
     * @return string
     */
    public function render (FieldsetInterface $fieldset, FormUtil $formUtil = null)
    {
        
        // Is view pluggable ?
        $renderer = $this->getView();
        if (! method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }
        // Check buttons
        foreach ($fieldset->getElements() as $button) {
            if (! (Util::isButton($button))) {
                $message = 'Element %s is not a valid button input type. ButtonGroupHelper can only render buttons, submit and reset inputs.';
                throw new UnsupportedButtonTypeException(sprintf($message, $button->getName()));
            }
        }
        
        // Rendering
        $result = '<div class="btn-group">';
        foreach ($fieldset->getElements() as $button) {
            if ($button instanceof FormElement\Button) {
                $helper = $renderer->plugin('bs_button');
                $result.= $helper($button, $button->getLabel());
            }else{
                switch ($button->getAttribute('type')) {
                    case 'reset':
                    	$helper = $renderer->plugin('bs_reset');
                    	$result.= $helper($button);
                    	break;
                    case 'submit':
                    	$helper = $renderer->plugin('bs_submit');
                    	$result.= $helper($button);
                    	break;
                }
            }
        }
        $result.='</div>';

        //Parameter formUtil
        if (isset($formUtil)){
        	$this->formUtil = $formUtil;
        }
        
        switch ($this->formUtil->getDefaultFormType()){
        	case FormUtil::FORM_TYPE_INLINE :
        	    return $result;
        	case FormUtil::FORM_TYPE_HORIZONTAL :
        	    $offsetHelper = $this->getOffsetHelper();
        	    $result = $offsetHelper->render($button, $result, $this->formUtil);        	    
        	    $groupHelper = $this->getGroupHelper();
        	    return $groupHelper->render($result);  
        	case FormUtil::FORM_TYPE_BASIC :
        	    $groupHelper = $this->getGroupHelper();
        	    return $groupHelper->render($result);
        }
        
    }

    /**
     * Render fieldset
     *
     * @param FieldsetInterface $fieldset            
     */
    public function __invoke (FieldsetInterface $fieldset, FormUtil $formUtil = null)
    {
        return self::render($fieldset,$formUtil);
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

    /****************** Getters and Setters ****************/
    
    /**
     * @return the $formUtil
     */
    public function getFormUtil() {
    	return $this->formUtil;
    }
    
    /**
     * @param \Bootstrap\Form\Util $formUtil
     */
    public function setFormUtil(FormUtil $formUtil) {
    	$this->formUtil = $formUtil;
    }
    
}

?>