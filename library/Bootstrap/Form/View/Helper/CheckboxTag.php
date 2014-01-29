<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

/**
 *
 * @author alexandre
 *        
 */
class CheckboxTag extends AbstractHelper
{

    const DEFAULT_CLASS = 'checkbox';

    /**
     * Renders the checkbox div tag
     *
     * @param string $content            
     * @return string
     */
    public function render($content, $class = self::DEFAULT_CLASS)
    {
        return $this->openTag($class) . $content . $this->closeTag();
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
    public function __invoke($content, $class = self::DEFAULT_CLASS)
    {
        return $this->render($content,$class);
    }
}

?>