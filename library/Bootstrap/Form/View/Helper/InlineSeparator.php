<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

/**
 *
 * @author alexandre
 *        
 */
class InlineSeparator extends AbstractHelper
{

    const ROW_CLASS    = 'row';
    const ROW_SPLITTER = 'col-sm-%s';

    /**
     * Renders the form group div tag
     *
     * @param string $content            
     * @return string
     */
    public function render($content, $prepend = null, $append = null)
    {        
        if (!is_array($content)){
            $pattern = $append.$prepend;
            $content = explode($pattern, $content);
        }        
        $count = count($content);
        switch ($count) {
        	case 2 :
        	    $size = 6;
        	    break;
        	case 3 :
        	    $size = 4;
           	    break;
           	case 4 :
           	  	$size = 3;
           	   	break;
           	case 6 :
           	   	$size = 2;
           	   	break;
           	case 12 :
           		$size = 1;
           		break;
        	default:
        		//throw new ...;
        	break;
        }
        $result = $this->openTag($size);
        foreach ($content as $cell){
            //not the first line
            if ($cell !== reset($content)){
            	$result .= $prepend;
            }
            $result .= $cell;
            //not the last line
            if ($cell !== end($content)){
                $result .= $append;
            }
            $result .= $this->splitTag($size);
        }
        $result .= $this->closeTag();
        return $result;
    }

    /**
     * Returns the open tag
     *
     * @param integer $size             
     * @return string
     */
    public function openTag($size)
    {
        return '<div class="' . self::ROW_CLASS . '">'
               .'<div class="'. sprintf(self::ROW_SPLITTER,$size).'">';
    }
    
    /**
     * Returns the split tag
     *
     * @param integer $size
     * @return string
     */
    public function splitTag($size)
    {
    	return   '</div><div class="'. sprintf(self::ROW_SPLITTER,$size).'">';
    }
    
    /**
     * Returns the closing tag
     *
     * @return string
     */
    public function closeTag()
    {
        //don't forget triming space because of form-inline separation
        return '</div></div> ';
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