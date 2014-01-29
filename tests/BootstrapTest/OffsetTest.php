<?php
namespace BootstrapTest;
use Bootstrap\Form\View\Helper\Offset;
use Bootstrap\Form\Util as FormUtil;
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
        $this->assertNull($this->offset->render(null,$this->formUtil));
        
        $expected = 'Some text';
        $this->assertEquals($expected, $this->offset->render('Some text'));
        $this->assertEquals($expected, $this->offset->render('Some text'),$this->formUtil);
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_INLINE);
        $this->assertEquals($expected, $this->offset->render('Some text'));
        $this->assertEquals($expected, $this->offset->render('Some text'),$this->formUtil);
        
        $expected = '<div class="col-sm-offset-8">Some text</div>';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_HORIZONTAL);
        $this->assertEquals($expected, $this->offset->render('Some text'));
        $this->assertEquals($expected, $this->offset->render('Some text',$this->formUtil));
        
        $expected = 'Some text';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_BASIC);
        $this->assertEquals($expected, $this->offset->render('Some text'));
        $this->assertEquals($expected, $this->offset->render('Some text'),$this->formUtil);
        
    }

    /**
     * Tests Offset->openTag()
     */
    public function testOpenTag ()
    {
        $this->assertEquals('<div class="col-sm-offset-8">', 
                $this->offset->openTag());
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
        $this->assertNull($offset(null,$this->formUtil));
        
        $expected = 'Some text';
        $this->assertEquals($expected, $offset('Some text'));
        $this->assertEquals($expected, $offset('Some text'),$this->formUtil);
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_INLINE);
        $this->assertEquals($expected, $offset('Some text'));
        $this->assertEquals($expected, $offset('Some text'),$this->formUtil);
        
        $expected = '<div class="col-sm-offset-8">Some text</div>';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_HORIZONTAL);
        $this->assertEquals($expected, $offset('Some text'));
        $this->assertEquals($expected, $offset('Some text',$this->formUtil));
        
        $expected = 'Some text';
        $this->formUtil->setDefaultFormType(FormUtil::FORM_TYPE_BASIC);
        $this->assertEquals($expected, $offset('Some text'));
        $this->assertEquals($expected, $offset('Some text'),$this->formUtil);
        
        /*$expected = '<div class="form-group">Some text</div> ';
        $actual = $this->offset->__invoke(new Text('name'), 'Some text');
        $this->assertEquals($expected, $actual);
        
        $expected = 'Some text';
        $actual = $this->offset->__invoke(new Button('name'), 'Some text');
        $this->assertEquals($expected, $actual);
        
        $expected = '<div class="form-group">Some text</div> ';
        $actual = $offset(new Text('name'), 'Some text');
        $this->assertEquals($expected, $actual);
        
        $expected = 'Some text';
        $actual = $offset(new Button('name'), 'Some text');
        $this->assertEquals($expected, $actual);*/
    }
}

