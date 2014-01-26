<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\Element as FormElement;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as HelperElement;

/**
 *
 * @author alexandre
 *        
 */
class Element extends HelperElement
{
/**
     * Render an element
     * @param  ElementInterface $element
     * @param  null|string $formType
     * @param  array $displayOptions
     * @return string
     */
    public function render(ElementInterface $element, $formType = null, array $displayOptions = array())
    {
        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }
        
        if ($element instanceof FormElement\Button) {
        	$helper = $renderer->plugin('bs_button');
        	return $helper($element);
        }

        if ($element instanceof FormElement\Collection) {
        	$helper = $renderer->plugin('bs_collection');
        	return $helper($element);
        }
        
        $type = $element->getAttribute('type');
        
        if ('checkbox' == $type) {
        	$helper = $renderer->plugin('bs_checkbox');
        	return $helper($element);
        }
        
        //FIXME to render unmodify Element
        parent::render($element,$formType,$displayOptions);
        
        //FIXME Have I to overload Element\Captcha ?        
        if ($element instanceof FormElement\Captcha) {
            $helper = $renderer->plugin('form_captcha');
            return $helper($element);
        }

        //FIXME Have I to overload Element\Csrf ?        
        if ($element instanceof FormElement\Csrf) {
            $helper = $renderer->plugin('form_hidden');
            return $helper($element);
        }

        //FIXME Have I to overload FormElement\DateTimeSelect ?
        if ($element instanceof FormElement\DateTimeSelect) {
            $helper = $renderer->plugin('form_date_time_select');
            return $helper($element);
        }

        //FIXME Have I to overload FormElement\DateSelect
        if ($element instanceof FormElement\DateSelect) {
            $helper = $renderer->plugin('form_date_select');
            return $helper($element);
        }

        //FIXME Have I to overload FormElement\MonthSelect
        if ($element instanceof FormElement\MonthSelect) {
            $helper = $renderer->plugin('form_month_select');
            return $helper($element);
        }

        $type = $element->getAttribute('type');

        if ('checkbox' == $type) {
            $helper = $renderer->plugin('form_checkbox');
            return $helper($element);
        }

        if ('color' == $type) {
            $helper = $renderer->plugin('form_color');
            return $helper($element);
        }

        if ('date' == $type) {
            $helper = $renderer->plugin('form_date');
            return $helper($element);
        }

        if ('datetime' == $type) {
            $helper = $renderer->plugin('form_date_time');
            return $helper($element);
        }

        if ('datetime-local' == $type) {
            $helper = $renderer->plugin('form_date_time_local');
            return $helper($element);
        }

        if ('email' == $type) {
            $helper = $renderer->plugin('form_email');
            return $helper($element);
        }

        if ('file' == $type) {
            $helper = $renderer->plugin('form_file');
            return $helper($element);
        }

        if ('hidden' == $type) {
            $helper = $renderer->plugin('form_hidden');
            return $helper($element);
        }

        if ('image' == $type) {
            $helper = $renderer->plugin('form_image');
            return $helper($element);
        }

        if ('month' == $type) {
            $helper = $renderer->plugin('form_month');
            return $helper($element);
        }

        if ('multi_checkbox' == $type) {
            $helper = $renderer->plugin('form_multi_checkbox');
            return $helper($element);
        }

        if ('number' == $type) {
            $helper = $renderer->plugin('form_number');
            return $helper($element);
        }

        if ('password' == $type) {
            $helper = $renderer->plugin('form_password');
            return $helper($element);
        }

        if ('radio' == $type) {
            $helper = $renderer->plugin('form_radio');
            return $helper($element);
        }

        if ('range' == $type) {
            $helper = $renderer->plugin('form_range');
            return $helper($element);
        }

        if ('reset' == $type) {
            $helper = $renderer->plugin('form_reset');
            return $helper($element);
        }

        if ('search' == $type) {
            $helper = $renderer->plugin('form_search');
            return $helper($element);
        }

        if ('select' == $type) {
            $helper = $renderer->plugin('form_select');
            return $helper($element);
        }

        if ('submit' == $type) {
            $helper = $renderer->plugin('form_submit');
            return $helper($element);
        }

        if ('tel' == $type) {
            $helper = $renderer->plugin('form_tel');
            return $helper($element);
        }

        if ('text' == $type) {
            $helper = $renderer->plugin('form_text');
            return $helper($element);
        }

        if ('textarea' == $type) {
            $helper = $renderer->plugin('form_textarea');
            return $helper($element);
        }

        if ('time' == $type) {
            $helper = $renderer->plugin('form_time');
            return $helper($element);
        }

        if ('url' == $type) {
            $helper = $renderer->plugin('form_url');
            return $helper($element);
        }

        if ('week' == $type) {
            $helper = $renderer->plugin('form_week');
            return $helper($element);
        }

        $helper = $renderer->plugin('form_input');
        return $helper($element);
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * @param  ElementInterface|null $element
     * @param  null|string $formType
     * @param  array $displayOptions
     * @return string|FormElementTwb
     */
    public function __invoke(ElementInterface $element = null, $formType = null, array $displayOptions = array())
    {
        if (!$element) {
            return $this;
        }
        return $this->render($element, $formType, $displayOptions);
    }
}

?>