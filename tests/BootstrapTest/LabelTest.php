<?php

namespace BootstrapTest;

use Bootstrap\Form\View\Helper\Label;
use Bootstrap\Form\Util;
use Zend\Form\Element\Text;
use Zend\Form\Element\Checkbox;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Label test case.
 */
class LabelTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Label
     */
    private $label;
    /**
     *
     * @var Util
     */
    private $formUtil;
    /**
     * 
     * @var Text
     */
    private $textElement;
    /**
     * Checkbox
     * 
     * @var Checkbox
     */
    private $checkboxElement;
    /**
     * 
     * @var array
     */
    private $attributesArray;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->formUtil        = new Util();
        $this->textElement     = new Text('textName');
        $this->checkboxElement = new Checkbox('checkboxName');
        $this->attributesArray = array(
        	'id'  => 'label-id',
            'for' => 'label-for',
        );
        $this->attributesComplex = array(
        	'id'  => 'label-id',
            'for' => 'label-for',
            'class' => 'classBar classFoo',
        );
        $this->label = new Label($this->formUtil);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->label             = null;
        $this->formUtil          = null;
        $this->textElement       = null;
        $this->checkboxElement   = null;
        $this->attributesArray   = null;
        $this->attributesComplex = null;
        parent::tearDown();
    }

    /**
     * Tests Label->openTag()
     */
    public function testOpenTagFormBasic(){
        //None element
        $expected = '<label>';
        $actual   = $this->label->openTag();
        $this->assertEquals($expected, $actual);
        //CheckboxElement
        $expected = '<label for="checkboxName">';
        $actual   = $this->label->openTag($this->checkboxElement);
        $this->assertEquals($expected, $actual);
        //Text-Element
        $expected = '<label for="textName">';
        $actual   = $this->label->openTag($this->textElement);
        $this->assertEquals($expected, $actual);
        
        //Tableau sans classe
        $expected = '<label id="label-id" for="label-for">';
        $actual   = $this->label->openTag($this->attributesArray);
        $this->assertEquals($expected, $actual);
        
        //Tableau avec classe
        $expected = '<label id="label-id" for="label-for" class="classBar classFoo">';
        $actual   = $this->label->openTag($this->attributesComplex);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Tests Label->openTag()
     */
    public function testOpenTagFormHorizontal(){
        $this->formUtil->setDefaultFormType(Util::FORM_TYPE_HORIZONTAL);
        //None element
        $expected = '<label class="control-label col-sm-4">';
        $actual   = $this->label->openTag();
        $this->assertEquals($expected, $actual);
        //CheckboxElement
        $expected = '<label class="control-label col-sm-4" for="checkboxName">';
        $actual   = $this->label->openTag($this->checkboxElement);
        $this->assertEquals($expected, $actual);
        //Text-Element
        $expected = '<label class="control-label col-sm-4" for="textName">';
        $actual   = $this->label->openTag($this->textElement);
        $this->assertEquals($expected, $actual);
        
        //Tableau sans classe
        $expected = '<label id="label-id" for="label-for" class="control-label col-sm-4">';
        $actual   = $this->label->openTag($this->attributesArray);
        $this->assertEquals($expected, $actual);
        
        //Tableau avec classe
        $expected = '<label id="label-id" for="label-for" class="classBar classFoo control-label col-sm-4">';
        $actual   = $this->label->openTag($this->attributesComplex);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Label->openTag()
     */
    public function testOpenTagFormInline(){
    	$this->formUtil->setDefaultFormType(Util::FORM_TYPE_INLINE);    	
        
        //None element
        $expected = '<label class="sr-only">';
        $actual   = $this->label->openTag();
        $this->assertEquals($expected, $actual);
        
        //CheckboxElement
        $expected = '<label for="checkboxName">';
        $actual   = $this->label->openTag($this->checkboxElement);
        $this->assertEquals($expected, $actual);
        
        //Text-Element
        $expected = '<label class="sr-only" for="textName">';
        $actual   = $this->label->openTag($this->textElement);
        $this->assertEquals($expected, $actual);
        
        //Tableau sans classe
        $expected = '<label id="label-id" for="label-for" class="sr-only">';
        $actual   = $this->label->openTag($this->attributesArray);
        $this->assertEquals($expected, $actual);
        
        //Tableau avec classe
        $expected = '<label id="label-id" for="label-for" class="classBar classFoo sr-only">';
        $actual   = $this->label->openTag($this->attributesComplex);
        $this->assertEquals($expected, $actual);
        
    }
    
    
}

