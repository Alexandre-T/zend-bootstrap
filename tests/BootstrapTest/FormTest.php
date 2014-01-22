<?php
use Bootstrap\Form\View\Helper\Form as FormHelper;
use Bootstrap\Util;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Form;
use Zend\View\View;
use Zend\View\Helper\ViewModel;
use Zend\View\Renderer\PhpRenderer;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Form test case.
 */
class FormTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var FormHelper
     */
    private $formHelperBasic;

    /**
     *
     * @var FormHelper
     */
    private $formHelperHorizontal;
    
    /**
     *
     * @var FormHelper
     */
    private $formHelperInline;
    
    /**
     *
     * @var FormHelper
     */
    private $formHelperVertical;
    
    /**
     *
     * @var Form
     */
    private $form;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->form = new Form();
        $view = new PhpRenderer();
        
        $this->formHelperBasic = new FormHelper(new Util(), new FormUtil());
        $this->formHelperHorizontal = new FormHelper(new Util(), new FormUtil(FormUtil::FORM_TYPE_HORIZONTAL));
        $this->formHelperVertical = new FormHelper(new Util(), new FormUtil(FormUtil::FORM_TYPE_VERTICAL));
        $this->formHelperInline = new FormHelper(new Util(), new FormUtil(FormUtil::FORM_TYPE_INLINE));
        
        $this->formHelperBasic->setView($view);
        $this->formHelperHorizontal->setView($view);
        $this->formHelperInline->setView($view);
        $this->formHelperVertical->setView($view);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->formHelperBasic = null;
        $this->formHelperHorizontal = null;
        $this->formHelperInline = null;
        $this->formHelperVertical = null;
        $this->form = null;
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Form->__construct()
     */
    public function test__construct()
    {
        $this->form = new Form();
        $this->assertEquals('Bootstrap\Form\View\Helper\Form', get_class($this->formHelperBasic));
    }

    /**
     * Tests Form->__invoke()
     */
    public function test__invoke()
    {
        //no-elements
        $this->assertSame($this->formHelperBasic, $this->formHelperBasic->__invoke());
        $this->assertSame($this->formHelperHorizontal, $this->formHelperHorizontal->__invoke());
        $this->assertSame($this->formHelperInline, $this->formHelperInline->__invoke());
        $this->assertSame($this->formHelperVertical, $this->formHelperVertical->__invoke());
        
        //one element
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperBasic->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal"></form>';
        $actual = $this->formHelperHorizontal->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-vertical"></form>';
        $actual = $this->formHelperVertical->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-inline"></form>';
        $actual = $this->formHelperInline->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        
        //two-elements basic
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperBasic->__invoke($this->form,'basic');
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperVertical->__invoke($this->form,'basic');
        $this->assertEquals($expected, $actual);

        $expected = '<form action="" method="POST" class="form-vertical"></form>';
        $actual = $this->formHelperBasic->__invoke($this->form,'vertical');
        $this->assertEquals($expected, $actual);

        $expected = '<form action="" method="POST" class="form-vertical"></form>';
        $actual = $this->formHelperVertical->__invoke($this->form,'vertical');
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-vertical"></form>';
        $actual = $this->formHelperVertical->__invoke($this->form,'vertical');
        $this->assertEquals($expected, $actual);
        
        //three elements        
        //$this->markTestIncomplete("__invoke test not implemented with 3 elements");
    }
    
    /**
     * Tests Form->__invoke()
     */
    public function test__InvokeException(){
        //throwed exception ?
        $this->setExpectedException('Bootstrap\Exception\InvalidParameterException');
        $this->formHelperBasic->__invoke($this->form,'foobar');
    }

    /**
     * Tests Form->render()
     */
    public function testRender()
    {

        /*$expected = '';//The View is not pluggable
        $actual = $this->formHelperBasic->render($this->form);
        $this->assertEquals($expected, $actual);*/
                
        
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperBasic->render($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal"></form>';
        $actual = $this->formHelperHorizontal->render($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-vertical"></form>';
        $actual = $this->formHelperVertical->render($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-inline"></form>';
        $actual = $this->formHelperInline->render($this->form);
        $this->assertEquals($expected, $actual);
        
    }

    /**
     * Tests Form->openTag()
     */
    public function testOpenTag()
    {
        $expected = '<form action="" method="get">';
        $actual = $this->formHelperBasic->openTag();
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="">';
        $actual = $this->formHelperBasic->openTag($this->form);
        $this->assertEquals($expected, $actual);

        $expected = '<form action="" method="POST" class="form-horizontal">';
        $actual = $this->formHelperHorizontal->openTag($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-vertical">';
        $actual = $this->formHelperVertical->openTag($this->form);
        $this->assertEquals($expected, $actual);

        $expected = '<form action="" method="POST" class="form-inline">';
        $actual = $this->formHelperInline->openTag($this->form);
        $this->assertEquals($expected, $actual);
        
    }
}

