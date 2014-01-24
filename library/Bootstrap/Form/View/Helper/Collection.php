<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormCollection;
use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\Element\Collection as CollectionElement;

/**
 *
 * @author alexandre
 *        
 */
class Collection extends FormCollection
{
    /**
     * Add <div class="form-group">%s</div> when true and when final element isn't a fieldset
     *
     * @var boolean
     */
    protected $formGroup = true;
    
    /**
     * Render a collection by iterating through all fieldsets and elements
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }

        $markup           = '';
        $templateMarkup   = '';
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $elementHelper    = $this->getElementHelper();
        $fieldsetHelper   = $this->getFieldsetHelper();

        if ($element instanceof CollectionElement && $element->shouldCreateTemplate()) {
            $templateMarkup = $this->renderTemplate($element);
        }

        foreach ($element->getIterator() as $elementOrFieldset) {
            if ($elementOrFieldset instanceof FieldsetInterface) {                
                $markup .= $fieldsetHelper($elementOrFieldset);
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                if ($this->getFormGroup()){
                    $markup .= '<div class="form-group">'.$elementHelper($elementOrFieldset).'</div>';
                }else{
                    $markup .= $elementHelper($elementOrFieldset);
                }
            }
        }

        // If $templateMarkup is not empty, use it for simplify adding new element in JavaScript
        if (!empty($templateMarkup)) {
            $markup .= $templateMarkup;
        }

        // Every collection is wrapped by a fieldset if needed
        if ($this->shouldWrap) {
            $label = $element->getLabel();

            if (!empty($label)) {

                if (null !== ($translator = $this->getTranslator())) {
                    $label = $translator->translate(
                            $label, $this->getTranslatorTextDomain()
                    );
                }

                $label = $escapeHtmlHelper($label);

                $markup = sprintf(
                    '<fieldset><legend>%s</legend>%s</fieldset>',
                    $label,
                    $markup
                );
            }
        }

        return $markup;
    }
    /**
     * Only render a template
     *
     * @param  CollectionElement $collection
     * @return string
     */
    public function renderTemplate(CollectionElement $collection)
    {
    	$elementHelper          = $this->getElementHelper();
    	$escapeHtmlAttribHelper = $this->getEscapeHtmlAttrHelper();
    	$templateMarkup         = '';
    
    	$elementOrFieldset = $collection->getTemplateElement();
    
    	if ($elementOrFieldset instanceof FieldsetInterface) {
    		$templateMarkup .= $this->render($elementOrFieldset);
    	} elseif ($elementOrFieldset instanceof ElementInterface) {
    		$templateMarkup .= $elementHelper($elementOrFieldset);
    		if ($this->getFormGroup()){
    			$templateMarkup .= '<div class="form-group">'.$templateMarkup.'</div>';
    		}
    	}
    
    	return sprintf(
    			'<span data-template="%s"></span>',
    			$escapeHtmlAttribHelper($templateMarkup)
    	);
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
    public function setFormGroup($formGroup) {
    	$this->formGroup = (boolean)$formGroup;
    }
}

?>