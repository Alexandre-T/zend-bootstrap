<?php
use Bootstrap\Form\Util;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Util test case.
 */
class FormUtilTest extends PHPUnit_Framework_TestCase
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
        $formUtil = new Util(Util::FORM_TYPE_BASIC);
        $expected = Util::FORM_TYPE_BASIC;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $formUtil = new Util(Util::FORM_TYPE_HORIZONTAL);
        $expected = Util::FORM_TYPE_HORIZONTAL;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $formUtil = new Util(Util::FORM_TYPE_VERTICAL);
        $expected = Util::FORM_TYPE_VERTICAL;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $formUtil = new Util(Util::FORM_TYPE_INLINE);
        $expected = Util::FORM_TYPE_INLINE;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
        $formUtil = new Util('foobar');
        $expected = Util::FORM_TYPE_BASIC;
        $this->assertEquals($expected,$formUtil->getDefaultFormType());
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
        
        $expected = Util::FORM_TYPE_VERTICAL;
        $this->formUtil->setDefaultFormType(Util::FORM_TYPE_VERTICAL);
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
        $this->assertTrue($this->formUtil->isFormTypeSupported(Util::FORM_TYPE_VERTICAL));

        $this->assertFalse($this->formUtil->isFormTypeSupported(null));
        $this->assertFalse($this->formUtil->isFormTypeSupported(false));
        $this->assertFalse($this->formUtil->isFormTypeSupported('foobar'));
        $this->assertFalse($this->formUtil->isFormTypeSupported(''));
        
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
        
        $expected = Util::FORM_TYPE_VERTICAL;
        $actual   = $this->formUtil->filterFormType(Util::FORM_TYPE_VERTICAL);
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
    
}

