<?php
namespace BootstrapTest;
use Bootstrap\Form\View\Helper\Offset;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Element\Checkbox;
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Offset test case.
 */
class OffsetTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Offset
     */
    private $offset;
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
        $this->offset = new Offset($this->formUtil);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->offset = null;
        $this->formUtil = null;
        parent::tearDown();
    }

    /**
     * Tests Offset->render()
     */
    public function testRender ()
    {
        $this->assertNull($this->offset->render());
        $this->assertNull($this->offset->render(null, null,$this->formUtil));
        
        $expected = 'Some text';
        $this->assertEquals($expected, $this->offset->render(null,'Some text'));
        $this->assertEquals($expected, $this->offset->render(null,'Some text'),$this->formUtil);
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_INLINE);
        $this->assertEquals($expected, $this->offset->render(null,'Some text'));
        $this->assertEquals($expected, $this->offset->render(null,'Some text'),$this->formUtil);
        
        $expected = '<div class="col-sm-8">Some text</div>';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_HORIZONTAL);
        $this->assertEquals($expected, $this->offset->render(null,'Some text'));
        $this->assertEquals($expected, $this->offset->render(null,'Some text',$this->formUtil));
        $element = new Checkbox('foo');
        $expected = '<div class="col-sm-8 col-sm-offset-4">Some text</div>';
        $this->assertEquals($expected, $this->offset->render($element,'Some text',$this->formUtil));
        
        $expected = 'Some text';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_BASIC);
        $this->assertEquals($expected, $this->offset->render(null,'Some text'));
        $this->assertEquals($expected, $this->offset->render(null,'Some text'),$this->formUtil);
        
    }

    /**
     * Tests Offset->openTag()
     */
    public function testOpenTag ()
    {
        $this->assertEquals('<div class="col-sm-8">', 
                $this->offset->openTag());
        $this->assertEquals('<div class="col-sm-8 col-sm-offset-4">', 
                $this->offset->openTag(true));
        $this->assertEquals('<div class="col-sm-8">', 
                $this->offset->openTag(false));
    }

    /**
     * Tests Offset->closeTag()
     */
    public function testCloseTag ()
    {
        $this->assertEquals('</div>', $this->offset->closeTag());
    }

    /**
     * Tests Offset->__invoke()
     */
    public function test__invoke ()
    {
        $offset = $this->offset;
        $this->assertTrue(is_callable($offset));
        
        $this->assertNull($offset());
        $this->assertNull($offset(null,null,$this->formUtil));
        
        $expected = 'Some text';
        $this->assertEquals($expected, $offset(null,'Some text'));
        $this->assertEquals($expected, $offset(null,'Some text'),$this->formUtil);
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_INLINE);
        $this->assertEquals($expected, $offset(null,'Some text'));
        $this->assertEquals($expected, $offset(null,'Some text'),$this->formUtil);
        
        $expected = '<div class="col-sm-8">Some text</div>';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_HORIZONTAL);
        $this->assertEquals($expected, $offset(null,'Some text'));
        $this->assertEquals($expected, $offset(null,'Some text',$this->formUtil));
        
        $expected = '<div class="col-sm-8 col-sm-offset-4">Some text</div>';
        $checkbox = new Checkbox();
        $this->assertEquals($expected, $offset($checkbox,'Some text'));
        $this->assertEquals($expected, $offset($checkbox,'Some text',$this->formUtil));
        
        $expected = 'Some text';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_BASIC);
        $this->assertEquals($expected, $offset(null,'Some text'));
        $this->assertEquals($expected, $offset(null,'Some text'),$this->formUtil);
        
    }
}

