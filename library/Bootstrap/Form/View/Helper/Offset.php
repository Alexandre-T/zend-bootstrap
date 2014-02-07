<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\MultiCheckbox;
use Bootstrap\Util;

/**
 *
 * @author alexandre
 *        
 */
class Offset extends AbstractHelper
{
    /**
     * 
     * @var FormUtil
     */
    protected $formUtil;
    /**
     * 
     * @param FormUtil $formUtil
     */
    public function __construct(FormUtil $formUtil = null){
        if (null === $formUtil){
            $formUtil = new FormUtil();
        }
        $this->formUtil = $formUtil;
    }
    /**
     * Renders the form group div tag
     *
     * @param ElementInterface $element
     * @param string $content
     * @return string
     */
    public function render(ElementInterface $element = null, $content = null, FormUtil $formUtil = null)
    {
        if (null !== $formUtil){
            $this->formUtil = $formUtil;
        }
        if (FormUtil::FORM_TYPE_HORIZONTAL == $this->formUtil->getDefaultFormType()){
            if (null == $element){
                $offset = false;
            }else{
                $offset = (!($element instanceof MultiCheckbox) and ($element instanceof Checkbox || Util::isButton($element)));
            } 
            return $this->openTag($offset) . $content . $this->closeTag();
    	}
    	return $content;
    }
    
    /**
     * Returns the form offset open tag
     *
     * @return string
     */
    public function openTag($offset = false)
    {
        $class = $this->formUtil->getWidthCss();
        if ($offset){
            $class .= ' ' . $this->formUtil->getOffsetCss();
        }
    	return '<div class="' . $class  . '">';
    }
    /**
     * Returns the form offset closing tag
     *
     * @return string
     */
    public function closeTag()
    {
    	return '</div>';
    }
    
    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     *
     * @param string $content
     * @param null|FormUtil $formUtil
     * @return string
     */
    public function __invoke(ElementInterface $element = null, $content = null,FormUtil $formUtil = null)
    {
    	return $this->render($element, $content,$formUtil);
    }
}

?>