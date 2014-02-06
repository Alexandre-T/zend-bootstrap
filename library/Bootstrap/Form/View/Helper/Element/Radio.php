<?php
namespace Bootstrap\Form\View\Helper\Element;
use Bootstrap\Form\View\Helper\RadioTag as HelperRadioTag;
use Zend\Form\ElementInterface;



/**
 *
 * @author alexandre
 *        
 */
class Radio extends MultiCheckbox
{

    /**
     * Return input type
     *
     * @return string
     */
    protected function getInputType()
    {
    	return 'radio';
    }
    
    /**
     * Get element name
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected static function getName(ElementInterface $element)
    {
    	return $element->getName();
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
    		$this->tagHelper = $this->view->plugin('bsradiotag');
    	}
    
    	if (! $this->tagHelper instanceof HelperRadioTag) {
    		$this->tagHelper = new HelperRadioTag();
    	}
    
    	return $this->tagHelper;
    }
}

?>