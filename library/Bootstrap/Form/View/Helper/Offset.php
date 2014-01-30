<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Checkbox;

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
                $checkbox = false;
            }else{
                $checkbox = ($element instanceof Checkbox || $element instanceof Radio);
            } 
            return $this->openTag($checkbox) . $content . $this->closeTag();
    	}
    	return $content;
    }
    
    /**
     * Returns the form offset open tag
     *
     * @return string
     */
    public function openTag($width = false)
    {
        $class = $this->formUtil->getOffsetCss();
        if ($width){
            $class .= ' ' . $this->formUtil->getWidthCss();
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