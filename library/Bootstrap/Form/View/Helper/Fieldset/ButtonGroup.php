<?php
namespace Bootstrap\Form\View\Helper\Fieldset;
use Bootstrap\Util;
use Bootstrap\Form\Exception\UnsupportedButtonTypeException;
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

    public function render (FieldsetInterface $fieldset)
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
        return $result;
    }

    /**
     * Render fieldset
     *
     * @param FieldsetInterface $fieldset            
     */
    public function __invoke (FieldsetInterface $fieldset)
    {
        return self::render($fieldset);
    }
}

?>