<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Button;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Submit;
use Zend\Form\Element;

/**
 *
 * @author alexandre
 *        
 */
class Group extends AbstractHelper
{

    const DEFAULT_CLASS = 'form-group';

    /**
     * Renders the form group div tag
     *
     * @param ElementInterface $element            
     * @param string $content            
     * @return string
     */
    public function render(ElementInterface $element, $content)
    {
        if ($element instanceof Hidden 
         || $element instanceof Csrf 
         || $element instanceof Button 
         || $element instanceof Submit
         //What a joke ! 
         || $element instanceof Element && $element->getAttribute('type') == 'submit') {
            return $content;
        }
        if ($element instanceof Checkbox) {
            $class = 'checkbox';
        } else {
            $class = self::DEFAULT_CLASS;
        }
        $html = $this->openTag($class) . $content . $this->closeTag();
        return $html;
    }

    /**
     * Returns the form group open tag
     *
     * @param ElementInterface $element            
     * @return string
     */
    public function openTag($class = self::DEFAULT_CLASS)
    {
        return '<div class="' . $class . '">';
    }

    /**
     * Returns the control group closing tag
     *
     * @return string
     */
    public function closeTag()
    {
        //don't forget triming space because of form-inline separation
        return '</div> ';
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     *
     * @param ElementInterface $element            
     * @param string $content            
     * @return string
     */
    public function __invoke(ElementInterface $element, $content = null)
    {
        return $this->render($element, $content);
    }
}

?>