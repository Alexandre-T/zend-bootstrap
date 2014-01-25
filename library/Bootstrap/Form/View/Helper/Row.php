<?php
namespace Bootstrap\Form\View\Helper;

use Bootstrap\Form\Util as FormUtil;
use Zend\Form\View\Helper\FormRow;
use Bootstrap\Form\Exception\UnsupportedHelperTypeException;
use Zend\Form\ElementInterface;

/**
 *
 * @author alexandre
 *        
 */
class Row extends FormRow
{

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
     * @var 
     */
    protected $formGroupHelper;

    /**
     * @var FormControlsTwb
     */
    protected $controlsHelper;
    
    /**
     * Add The Form Group Helper render
     * 
     * @var boolean
     */
    protected $formGroup = true;

    /**
     * Add The Help Block Helper render
     * 
     * @var boolean
     */
    protected $helpBlock = true;
    
    /**
     * @var FormUtil
     */
    protected $formUtil;
    
    /**
     * Constructor
     * @param GenUtil $genUtil
     * @param FormUtil $formUtil
     */
    public function __construct(FormUtil $formUtil)
    {
    	$this->formUtil = $formUtil;
    }
    
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
    	$formType = $this->formUtil->getDefaultFormType();
    	if ($markup && $this->getHelpBlock()){
    	    $content = $element->getOption('help-block');
    	    $this->helpBlockHelper = $this->getHelpBlockHelper();
    	    $markup = $this->helpBlockHelper->render($element,$markup);
    	}
    	 
        if ($markup && $this->getFormGroup()){ 
            // && ($formType == FormUtil::FORM_TYPE_HORIZONTAL || $formType == FormUtil::FORM_TYPE_VERTICAL)
            $this->formGroupHelper = $this->getFormGroupHelper();            
            $markup = $this->formGroupHelper->render($element,$markup);
        }
    	return $markup;
    }
    /**
     * Retrieve the FormLabel helper
     *
     * @return FormLabel
     */
    protected function getLabelHelper()
    {
    	if ($this->labelHelper) {
    		return $this->labelHelper;
    	}
    
    	if (method_exists($this->view, 'plugin')) {
    		$this->labelHelper = $this->view->plugin('bs_label');
    	}
    
    	if (!$this->labelHelper instanceof Label) {
    		$this->labelHelper = new Label($this->formUtil);
    	}
    
    	if ($this->hasTranslator()) {
    		$this->labelHelper->setTranslator(
    				$this->getTranslator(),
    				$this->getTranslatorTextDomain()
    		);
    	}
    
    	return $this->labelHelper;
    }
    
    /**
     * Retrieve the Form Group helper
     * @return Group
     * @throws \Bootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getFormGroupHelper()
    {
    	if (!$this->formGroupHelper) {
    		if (method_exists($this->view, 'plugin')) {
    			$this->formGroupHelper = $this->view->plugin('bs_group');
    		}
    		if (!$this->formGroupHelper instanceof Group) {
    			throw new UnsupportedHelperTypeException('Form group helper Bootstrap\Form\View\Helper\Group unavailable or unsupported type.');
    		}
    	}
    	return $this->formGroupHelper;
    }
    
    /**
     * Retrieve the Help Block helper
     * @return Group
     * @throws \Bootstrap\Form\Exception\UnsupportedHelperTypeException
     */
    protected function getHelpBlockHelper()
    {
    	if (!$this->helpBlockHelper) {
    		if (method_exists($this->view, 'plugin')) {
    			$this->helpBlockHelper = $this->view->plugin('bshelp');
    		}
    		if (!$this->helpBlockHelper instanceof HelpBlock) {
    			throw new UnsupportedHelperTypeException('Help block helper Bootstrap\Form\View\Helper\HelpBlock unavailable or unsupported type.');
    		}
    		if ($this->hasTranslator()) {
    			$this->helpBlockHelper->setTranslator(
    					$this->getTranslator(),
    					$this->getTranslatorTextDomain()
    			);
    		}
    	}
    	return $this->helpBlockHelper;
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
	
	/**
	 * @return the $helpBlock
	 */
	public function getHelpBlock() {
		return $this->helpBlock;
	}

	/**
	 * @param boolean $helpBlock
	 */
	public function setHelpBlock($helpBlock) {
		$this->helpBlock = (boolean)$helpBlock;
	}

    
}

?>