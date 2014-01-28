<?php

namespace BootstrapTest;

use Bootstrap\Form\Util;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Util test case.
 */
class FormUtilTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Util
     */
    private $formUtil;
    
    /* (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp() {
	    $this->formUtil = new Util();
		parent::setUp();
		
	}

	/**
     * Tests Util->__construct()
     */
    public function test__construct()
    {
        $formUtil = new Util();
        $expected = Util::FORM_TYPE_BASIC;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $this->assertTrue($formUtil->getOverride());
        $formUtil = new Util(Util::FORM_TYPE_BASIC);
        $expected = Util::FORM_TYPE_BASIC;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $this->assertTrue($formUtil->getOverride());
        $formUtil = new Util(Util::FORM_TYPE_HORIZONTAL);
        $expected = Util::FORM_TYPE_HORIZONTAL;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $formUtil = new Util(Util::FORM_TYPE_INLINE,false);
        $expected = Util::FORM_TYPE_INLINE;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $this->assertFalse($formUtil->getOverride());
        $formUtil = new Util('foobar','foobar');
        $expected = Util::FORM_TYPE_BASIC;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $this->assertTrue($formUtil->getOverride());
    }

    /**
     * Tests Util->getDefaultFormType()
     */
    public function testGetDefaultFormType()
    {        
        $expected = Util::FORM_TYPE_BASIC;
        $actual = $this->formUtil->getDefaultFormType();
        $this->assertEquals($expected,$actual);
    }

    /**
     * Tests Util->setDefaultFormType()
     */
    public function testSetDefaultFormType()
    {

        $expected = Util::FORM_TYPE_BASIC;
        $this->formUtil->setDefaultFormType(Util::FORM_TYPE_BASIC);
        $actual = $this->formUtil->getDefaultFormType();
        $this->assertEquals($expected,$actual);
        
        $expected = Util::FORM_TYPE_INLINE;
        $this->formUtil->setDefaultFormType(Util::FORM_TYPE_INLINE);
        $actual = $this->formUtil->getDefaultFormType();
        $this->assertEquals($expected,$actual);
        
        $expected = Util::FORM_TYPE_HORIZONTAL;
        $this->formUtil->setDefaultFormType(Util::FORM_TYPE_HORIZONTAL);
        $actual = $this->formUtil->getDefaultFormType();
        $this->assertEquals($expected,$actual);
        
        $expected = Util::FORM_TYPE_BASIC;
        $this->formUtil->setDefaultFormType('fooBar');
        $actual = $this->formUtil->getDefaultFormType();
        $this->assertEquals($expected,$actual);
        
    }

    /**
     * Tests Util->isFormTypeSupported()
     */
    public function testIsFormTypeSupported()
    {
        $this->assertTrue($this->formUtil->isFormTypeSupported(Util::FORM_TYPE_BASIC));
        $this->assertTrue($this->formUtil->isFormTypeSupported(Util::FORM_TYPE_HORIZONTAL));
        $this->assertTrue($this->formUtil->isFormTypeSupported(Util::FORM_TYPE_INLINE));

        $this->assertFalse($this->formUtil->isFormTypeSupported(null));
        $this->assertFalse($this->formUtil->isFormTypeSupported(false));
        $this->assertFalse($this->formUtil->isFormTypeSupported('foobar'));
        $this->assertFalse($this->formUtil->isFormTypeSupported(''));
        
    }

    
    /**
     * Tests Util->getOverride()
     */
    public function testGetOverride()
    {
        $this->assertTrue($this->formUtil->getOverride());
        $this->formUtil->setOverride(false);
        $this->assertFalse($this->formUtil->getOverride());
    }
    
    /**
     * Tests Util->getOverride()
     */
    public function testSetOverride()
    {
        $this->formUtil->setOverride(false);
        $this->assertFalse($this->formUtil->getOverride());
        $this->formUtil->setOverride(true);
        $this->assertTrue($this->formUtil->getOverride());
        $this->formUtil->setOverride();
        $this->assertTrue($this->formUtil->getOverride());
        $this->formUtil->setOverride('foobar');
        $this->assertTrue($this->formUtil->getOverride());
        
    }
    
    /**
     * Tests Util->filterFormType()
     */
    public function testFilterFormType()
    {

        $expected = Util::FORM_TYPE_BASIC;
        $actual   = $this->formUtil->filterFormType(Util::FORM_TYPE_BASIC);
        $this->assertEquals($expected,$actual);
        
        $expected = Util::FORM_TYPE_HORIZONTAL;
        $actual   = $this->formUtil->filterFormType(Util::FORM_TYPE_HORIZONTAL);
        $this->assertEquals($expected,$actual);
        
        $expected = Util::FORM_TYPE_INLINE;
        $actual   = $this->formUtil->filterFormType(Util::FORM_TYPE_INLINE);
        $this->assertEquals($expected,$actual);
        
        $expected = Util::FORM_TYPE_BASIC;
        $actual   = $this->formUtil->filterFormType(null);
        $this->assertEquals($expected,$actual);

        $this->setExpectedException('Bootstrap\Exception\InvalidParameterException');
        $actual   = $this->formUtil->filterFormType('foobar');

    }
    
    /**
     * Tests Util->filterFormType() Suite
     */
    public function testFilterFormTypeException()
    {
    
    	$this->setExpectedException('Bootstrap\Exception\InvalidParameterException');
    	$actual   = $this->formUtil->filterFormType('');
    
    }
    /**
     * Test->filterSize()
     */
    public function testFilterSize(){
        $this->assertEquals(0,$this->formUtil->filterSize('0'));
        $this->assertEquals(1,$this->formUtil->filterSize('1'));
        $this->assertEquals(0,$this->formUtil->filterSize('dflmjsf mlf slfjs '));
        $this->assertEquals(0,$this->formUtil->filterSize(null));
        $this->assertEquals(0,$this->formUtil->filterSize(0));
        $this->assertEquals(0,$this->formUtil->filterSize(13));
        $this->assertEquals(0,$this->formUtil->filterSize(-4));
        $this->assertEquals(1,$this->formUtil->filterSize(1));
        $this->assertEquals(2,$this->formUtil->filterSize(2));
        $this->assertEquals(3,$this->formUtil->filterSize(3));
        $this->assertEquals(4,$this->formUtil->filterSize(4));
        $this->assertEquals(5,$this->formUtil->filterSize(5));
        $this->assertEquals(6,$this->formUtil->filterSize(6));
        $this->assertEquals(7,$this->formUtil->filterSize(7));
        $this->assertEquals(8,$this->formUtil->filterSize(8));
        $this->assertEquals(9,$this->formUtil->filterSize(9));
        $this->assertEquals(10,$this->formUtil->filterSize(10));
        $this->assertEquals(11,$this->formUtil->filterSize(11));
        $this->assertEquals(0,$this->formUtil->filterSize(12));
    }
    
    /**
     * Test->getXsColSize()
     */
    public function testGetXsColSize(){
    	$this->assertEquals(0,$this->formUtil->getXsColSize());
    	$this->formUtil->setXsColSize(7);
    	$this->assertEquals(7,$this->formUtil->getXsColSize());
    	$this->formUtil->setSmColSize(9);
    	$this->formUtil->setMdColSize(9);
    	$this->formUtil->setLgColSize(9);
    	$this->assertEquals(7,$this->formUtil->getXsColSize());
    	$this->formUtil->setXsColSize(13);
    	$this->assertEquals(0,$this->formUtil->getXsColSize());
    }
    
    /**
     * Test->getSmColSize()
     */
    public function testGetSmColSize(){
        $this->assertEquals(4,$this->formUtil->getSmColSize());
        $this->formUtil->setSmColSize(7);
        $this->assertEquals(7,$this->formUtil->getSmColSize());
        $this->formUtil->setXsColSize(9);
        $this->formUtil->setMdColSize(9);
        $this->formUtil->setLgColSize(9);
        $this->assertEquals(7,$this->formUtil->getSmColSize());
        $this->formUtil->setSmColSize(13);
        $this->assertEquals(0,$this->formUtil->getSmColSize());
    }
    
    /**
     * Test->getXsColSize()
     */
    public function testGetMdColSize(){
    	$this->assertEquals(0,$this->formUtil->getMdColSize());
    	$this->formUtil->setMdColSize(7);
    	$this->assertEquals(7,$this->formUtil->getMdColSize());
    	$this->formUtil->setXsColSize(9);
    	$this->formUtil->setSmColSize(9);
    	$this->formUtil->setLgColSize(9);
    	$this->assertEquals(7,$this->formUtil->getMdColSize());
    	$this->formUtil->setMdColSize(13);
    	$this->assertEquals(0,$this->formUtil->getMdColSize());
    }
    
    /**
     * Test->getLgColSize()
     */
    public function testGetLgColSize(){
    	$this->assertEquals(0,$this->formUtil->getLgColSize());
    	$this->formUtil->setLgColSize(7);
    	$this->assertEquals(7,$this->formUtil->getLgColSize());
    	$this->formUtil->setXsColSize(9);
    	$this->formUtil->setSmColSize(9);
    	$this->formUtil->setMdColSize(9);
    	$this->assertEquals(7,$this->formUtil->getLgColSize());
    	$this->formUtil->setLgColSize(13);
    	$this->assertEquals(0,$this->formUtil->getLgColSize());
    }
    
    /**
     * Test->getCss()
     */
    public function testGetCss(){
        $this->assertEquals('col-sm-4',$this->formUtil->getCss());
        $this->formUtil->setXsColSize(7);
        $this->assertEquals('col-xs-7 col-sm-4',$this->formUtil->getCss());
        $this->formUtil->setMdColSize(8);
        $this->assertEquals('col-xs-7 col-sm-4 col-md-8',$this->formUtil->getCss());
        $this->formUtil->setLgColSize(10);
        $this->assertEquals('col-xs-7 col-sm-4 col-md-8 col-lg-10',$this->formUtil->getCss());
        $this->formUtil->setMdColSize();
        $this->assertEquals('col-xs-7 col-sm-4 col-lg-10',$this->formUtil->getCss());
    }
    /**
     * Test->getOffsetCss()
     */
    public function testGetOffsetCss(){
        $this->assertEquals('col-sm-offset-8',$this->formUtil->getOffsetCss());
        $this->formUtil->setXsColSize(7);
        $this->assertEquals('col-xs-offset-5 col-sm-offset-8',$this->formUtil->getOffsetCss());
        $this->formUtil->setMdColSize(8);
        $this->assertEquals('col-xs-offset-5 col-sm-offset-8 col-md-offset-4',$this->formUtil->getOffsetCss());
        $this->formUtil->setLgColSize(10);
        $this->assertEquals('col-xs-offset-5 col-sm-offset-8 col-md-offset-4 col-lg-offset-2',$this->formUtil->getOffsetCss());
        $this->formUtil->setMdColSize();
        $this->assertEquals('col-xs-offset-5 col-sm-offset-8 col-lg-offset-2',$this->formUtil->getOffsetCss());
    }
}

