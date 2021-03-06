<?php
namespace BootstrapTest\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Form\Element\Submit;

class CreateProduct extends Form
{

    public function __construct()
    {
        parent::__construct('create_product');
        
        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setInputFilter(new InputFilter());
        
        $this->add(array(
            'type' => 'BootstrapTest\Fieldset\ProductFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));
        
        $submit = new Submit('submit');
        $submit->setLabel('Send');
        $this->add($submit);
    }
}

?>