<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\ElementInterface;

/**
 *
 * @author alexandre
 *        
 */
class Strong extends AbstractHelper
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
    public function render($content = null, FormUtil $formUtil = null)
    {
        if (null !== $formUtil){
            $this->formUtil = $formUtil;
        }
        if (FormUtil::FORM_TYPE_HORIZONTAL == $this->formUtil->getDefaultFormType()){
            return $this->openTag() . $content . $this->closeTag();
    	}
    	return $content;
    }
    
    /**
     * Returns the form offset open tag
     *
     * @return string
     */
    public function openTag()
    {
        $class = $this->formUtil->getCss();
    	return '<strong class="' . $class  . ' control-label">';
    }
    /**
     * Returns the form offset closing tag
     *
     * @return string
     */
    public function closeTag()
    {
    	return '</strong>';
    }
    
    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     *
     * @param string $content
     * @param null|FormUtil $formUtil
     * @return string
     */
    public function __invoke($content = null,FormUtil $formUtil = null)
    {
    	return $this->render($content,$formUtil);
    }
}

?>