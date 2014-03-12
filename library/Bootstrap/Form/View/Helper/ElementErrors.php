<?php
namespace Bootstrap\Form\View\Helper;
use Zend\Form\View\Helper\FormElementErrors;

/**
 *
 * @author alexandre
 *        
 */
class ElementErrors extends FormElementErrors
{

    public function __construct ()
    {
        $this->setMessageOpenFormat('<div class="help-block">');
        $this->setMessageCloseString('</div>');
        $this->setMessageSeparatorString('</div><div class="help-block">');
    	//parent::__construct();
        
    }
}

?>