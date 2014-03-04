<?php
namespace Bootstrap\Form\View\Helper;
use Zend\Form\Element as FormElement;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as HelperElement;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Element\MonthSelect;
/**
 *
 * @author alexandre
 *        
 */
class Element extends HelperElement
{
    /**
     * @var FormUtil
     */
    protected $formUtil;
    
    /**
     * Render an element
     *
     * @param ElementInterface $element            
     * @param null|string $formType            
     * @param array $displayOptions            
     * @return string
     */
    public function render (ElementInterface $element)
    {
        $renderer = $this->getView();
        if (! method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }
        
        if ($element instanceof FormElement\Button) {
            $helper = $renderer->plugin('bs_button');
            return $helper($element, $element->getLabel());
        }

        if ($element instanceof FormElement\Collection) {
            $helper = $renderer->plugin('bs_collection');
            return $helper($element);
        }

        if ($element instanceof FormElement\Captcha) {
        	$helper = $renderer->plugin('bs_captcha');
        	return $helper($element);
        }
        
        //FIXME change form by bs
        if ($element instanceof FormElement\DateTimeSelect) {
        	$helper = $renderer->plugin('form_date_time_select');
        	return $helper($element);
        }
        
        //FIXME change form by bs
        if ($element instanceof FormElement\DateSelect) {
        	$helper = $renderer->plugin('form_date_select');
        	return $helper($element);
        }
                
        if ($element instanceof MonthSelect) {
        	$helper = $renderer->plugin('bs_month_select');
        	return $helper($element);
        }
        
        switch ($element->getAttribute('type')) {
            case 'color':
                $helper = $renderer->plugin('bs_color');
                return $helper($element);
            case 'checkbox':
                $helper = $renderer->plugin('bs_checkbox');
                return $helper($element);
            case 'date':
                $helper = $renderer->plugin('bs_date');
                return $helper($element);
            case 'datetime':
                $helper = $renderer->plugin('bs_date_time');
                return $helper($element);
            case 'datetime-local':
                $helper = $renderer->plugin('bs_date_time_local');
                return $helper($element);
            case 'email':
                $helper = $renderer->plugin('bs_email');
                return $helper($element);
            case 'file':
                $helper = $renderer->plugin('bs_file');
                return $helper($element);
            case 'image':
                $helper = $renderer->plugin('bs_image');
                return $helper($element);
            case 'month':
                $helper = $renderer->plugin('bs_month');
                return $helper($element);
            case 'multi_checkbox':
                $helper = $renderer->plugin('bs_multi_checkbox');
                return $helper->render($element,$this->getFormUtil());                
            case 'number':
                $helper = $renderer->plugin('bs_number');
                return $helper($element);
            case 'password':
                $helper = $renderer->plugin('bs_password');
                return $helper($element);
            case 'radio':
                $helper = $renderer->plugin('bs_radio');
                return $helper->render($element,$this->getFormUtil());
            case 'range':
                $helper = $renderer->plugin('bs_range');
                return $helper($element);
            case 'reset':
                $helper = $renderer->plugin('bs_reset');
                return $helper($element);                
            case 'search':
                $helper = $renderer->plugin('bs_search');
                return $helper($element);
            case 'select':
                $helper = $renderer->plugin('bs_select');
                return $helper($element);
            case 'submit':
                $helper = $renderer->plugin('bs_submit');
                return $helper($element);                
            case 'tel':
                $helper = $renderer->plugin('bs_tel');
                return $helper($element);
            case 'text':
                $helper = $renderer->plugin('bs_text');
                return $helper($element);
            case 'textarea':
                $helper = $renderer->plugin('bs_textarea');
                return $helper($element);
            case 'time':
                $helper = $renderer->plugin('bs_time');
                return $helper($element);
            case 'url':
                $helper = $renderer->plugin('bs_url');
                return $helper($element);
            case 'week':
                $helper = $renderer->plugin('bs_week');
                return $helper($element);
        }
        
        
        // So Csrf, Hidden are not override
        return parent::render($element);
        
        // @todo else case !
        $helper = $renderer->plugin('form_input');
        return $helper($element);
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     *
     * @param ElementInterface|null $element            
     * @param null|string $formType            
     * @param array $displayOptions            
     * @return string FormElementTwb
     */
    public function __invoke (ElementInterface $element = null, $formType = null, 
            array $displayOptions = array())
    {
        if (! $element) {
            return $this;
        }
        return $this->render($element, $formType, $displayOptions);
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