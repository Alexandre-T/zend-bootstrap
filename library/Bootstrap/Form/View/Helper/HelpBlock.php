<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Csrf;

/**
 *
 * @author alexandre
 *        
 */
class HelpBlock extends AbstractHelper
{
    const HELP_BLOCK = 'help';
    /**
     * Renders the form group div tag
     * 
     * @param ElementInterface $element            
     * @param string $content            
     * @return string
     */
    public function render(ElementInterface $element, $prepend = null)
    {
        $content = $element->getOption(self::HELP_BLOCK);
        if (empty($content) || $element instanceof Hidden || $element instanceof Csrf){
            return $prepend;
        }
        $html = $prepend . $this->helpBlockTag($content);
        return $html;
    }

    /**
     * Returns help block group tag
     * 
     * @return string
     */
    public function helpBlockTag($content = null)
    {
        if (empty($content)){
            return;
        }
        //Translation
        if (null !== ($translator = $this->getTranslator())) {
        	$content = $translator->translate(
        	   $content, $this->getTranslatorTextDomain()
        	);
        }
        $escaper = $this->getEscapeHtmlHelper();
        return '<p class="help-block">'.$escaper($content).'</p>';
    }

    /**
     * Invoke helper as function
     * Proxies to {@link render()}.
     * 
     * @param ElementInterface $element            
     * @param string $prepend            
     * @return string
     */
    public function __invoke(ElementInterface $element, $prepend = null)
    {
        return $this->render($element, $prepend);
    }
}

?>