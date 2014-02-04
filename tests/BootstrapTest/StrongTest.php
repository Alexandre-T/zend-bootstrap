<?php
namespace BootstrapTest;
use Bootstrap\Form\View\Helper\Strong as HelperStrong;
use Bootstrap\Form\Util as FormUtil;
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Strong test case.
 */
class StrongTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Strong
     */
    private $strongHelper;
    
    /**
     *
     * @var FormUtil
     */
    private $formUtil;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->formUtil = new FormUtil();
        $this->strongHelper = new HelperStrong($this->formUtil);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->strongHelper = null;
        $this->formUtil = null;
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Strong->render()
     */
    public function testRender ()
    {
        $this->assertNull($this->strongHelper->render());
        $this->assertNull($this->strongHelper->render(null, null,$this->formUtil));
        
        $expected = 'Some text';
        $this->assertEquals($expected, $this->strongHelper->render('Some text'));
        $this->assertEquals($expected, $this->strongHelper->render('Some text'),$this->formUtil);
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_INLINE);
        $this->assertEquals($expected, $this->strongHelper->render('Some text'));
        $this->assertEquals($expected, $this->strongHelper->render('Some text'),$this->formUtil);
        
        $expected = '<strong class="col-sm-4 control-label">Some text</strong>';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_HORIZONTAL);
        $this->assertEquals($expected, $this->strongHelper->render('Some text'));
        $this->assertEquals($expected, $this->strongHelper->render('Some text',$this->formUtil));
        
        $expected = 'Some text';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_BASIC);
        $this->assertEquals($expected, $this->strongHelper->render('Some text'));
        $this->assertEquals($expected, $this->strongHelper->render('Some text'),$this->formUtil);
    }

    /**
     * Tests Strong->openTag()
     */
    public function testOpenTag ()
    {
        $this->assertEquals('<strong class="col-sm-4 control-label">', $this->strongHelper->openTag());
    }

    /**
     * Tests Strong->closeTag()
     */
    public function testCloseTag ()
    {
        $this->assertEquals('</strong>', $this->strongHelper->closeTag());
    }

    /**
     * Tests Strong->__invoke()
     */
    public function test__invoke ()
    {
        // TODO Auto-generated StrongTest->test__invoke()
        $this->markTestIncomplete("__invoke test not implemented");
        
        $this->strongHelper->__invoke(/* parameters */);
    }
}

