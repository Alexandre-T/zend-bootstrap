<?php
namespace Bootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormCollection;

/**
 *
 * @author alexandre
 *        
 */
class Collection extends FormCollection
{
    /**
     * Constructor
     * 
     */
    public function __construct(){
        $this->defaultElementHelper = 'bsrow';
    }

}

?>