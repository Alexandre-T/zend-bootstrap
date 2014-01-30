<?php
namespace BootstrapTest;
use Bootstrap\Form\View\Helper\Form as FormHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Form;
use BootstrapTest\Util\ServiceManagerFactory;
use Zend\View\Renderer\ConsoleRenderer;
use BootstrapTest\Form\CreateProduct;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\File;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Form test case.
 */
class FormTest extends \PHPUnit_Framework_TestCase
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
     * @var Form
     */
    private $form;

    /**
     *
     * @var Form
     */
    private $formComplex;

    /**
     * A form with all Input type
     *
     * @var Form
     */
    private $formDemonstration;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        $this->form = new Form();
        
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $application = $serviceManager->get('Application');
        $application->bootstrap();
        
        /* @var $viewManager \Zend\Mvc\View\Http\ViewManager */
        $viewManager = $serviceManager->get('view_manager');
        $view = $viewManager->getRenderer();
        
        $this->formHelperBasic = new FormHelper(new FormUtil());
        $this->formHelperHorizontal = new FormHelper(
                new FormUtil(FormUtil::FORM_TYPE_HORIZONTAL));
        $this->formHelperInline = new FormHelper(
                new FormUtil(FormUtil::FORM_TYPE_INLINE));
        
        $this->formHelperBasic->setView($view);
        $this->formHelperHorizontal->setView($view);
        $this->formHelperInline->setView($view);
        
        // Form Build
        $this->formComplex = new Form('form-complex');
        $this->formComplex->setAttribute('role', 'form');
        $this->formComplex->add(
                array(
                        'name' => 'exampleInputEmail1',
                        'type' => 'email',
                        'options' => array(
                                'label' => 'Email address'
                        ),
                        'attributes' => array(
                                'placeholder' => 'Enter email'
                        )
                ));
        $password = new Password('exampleInputPassword1');
        $password->setLabel('Password');
        $password->setOptions(
                array(
                        'options' => array(
                                'help' => 'Example block-level help text here.'
                        ),
                        'attributes' => array(
                                'placeholder' => 'Enter password'
                        )
                ));
        $this->formComplex->add($password);
        $checkbox = new Checkbox('checkbox');
        $checkbox->setLabel('Check me out');
        $this->formComplex->add($checkbox);
        $this->formComplex->add(
                array(
                        'name' => 'submit',
                        'type' => 'button',
                        'options' => array(
                                'label' => 'Send'
                        )
                ));
        
        $this->formDemonstration = new Form();
        
        $text = new Text('text-name');
        $text->setLabel('Text type');
        
        $this->formDemonstration->add($text);
        $this->formDemonstration->add($password);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->formHelperBasic = null;
        $this->formHelperHorizontal = null;
        $this->formHelperInline = null;
        $this->form = null;
        $this->formComplex = null;
        parent::tearDown();
    }

    /**
     * Tests Form->__construct()
     */
    public function test__construct ()
    {
        $this->form = new Form();
        $this->assertEquals('Bootstrap\Form\View\Helper\Form', 
                get_class($this->formHelperBasic));
    }

    /**
     * Tests Form->__invoke()
     */
    public function test__invoke ()
    {
        // is_callable
        $this->assertTrue(is_callable($this->formHelperBasic));
        $this->assertTrue(is_callable($this->formHelperHorizontal));
        $this->assertTrue(is_callable($this->formHelperInline));
        
        // Callable Object
        $basic = $this->formHelperBasic;
        $horizontal = $this->formHelperHorizontal;
        $inline = $this->formHelperInline;
        
        // no-elements
        $this->assertSame($this->formHelperBasic, 
                $this->formHelperBasic->__invoke());
        $this->assertSame($this->formHelperHorizontal, 
                $this->formHelperHorizontal->__invoke());
        $this->assertSame($this->formHelperInline, 
                $this->formHelperInline->__invoke());
        
        // one element
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperBasic->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $basic($this->form));
        
        $expected = '<form action="" method="POST" class="form-horizontal"></form>';
        $actual = $this->formHelperHorizontal->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $horizontal($this->form));
        
        $expected = '<form action="" method="POST" class="form-inline"></form>';
        $actual = $this->formHelperInline->__invoke($this->form);
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $inline($this->form));
        
        // two-elements basic
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperBasic->__invoke($this->form, 'basic');
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $basic($this->form, 'basic'));
        
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperHorizontal->__invoke($this->form, 'basic');
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $horizontal($this->form, 'basic'));
        
        $expected = '<form action="" method="POST" class="form-horizontal"></form>';
        $actual = $this->formHelperBasic->__invoke($this->form, 'horizontal');
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $basic($this->form, 'horizontal'));
        
        $expected = '<form action="" method="POST" class="form-horizontal"></form>';
        $actual = $this->formHelperHorizontal->__invoke($this->form, 
                'horizontal');
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $horizontal($this->form, 'horizontal'));
        
        // three elements
        // $this->markTestIncomplete("__invoke test not implemented with 3
        // elements");
    }

    /**
     * Tests Form->__invoke()
     */
    public function test__InvokeException ()
    {
        // throwed exception ?
        $this->setExpectedException(
                'Bootstrap\Exception\InvalidParameterException');
        $this->formHelperBasic->__invoke($this->form, 'foobar');
    }

    /**
     * Tests Form->render()
     */
    public function testRender ()
    {
        $expected = '<form action="" method="POST" class=""></form>';
        $actual = $this->formHelperBasic->render($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal"></form>';
        $actual = $this->formHelperHorizontal->render($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-inline"></form>';
        $actual = $this->formHelperInline->render($this->form);
        $this->assertEquals($expected, $actual);
        
        $view = new ConsoleRenderer(); // unpluggable view
        $expected = ''; // The View is not pluggable
        $this->formHelperBasic->setView($view);
        $actual = $this->formHelperBasic->render($this->form);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Form->render() with a complex Form
     */
    public function testRenderComplexForm ()
    {
        $this->form->setName('my-form-name');
        $this->form->setAttributes(
                array(
                        'id' => 'form-id',
                        'role' => 'role',
                        'accesskey' => 'c',
                        'foo' => 'bar',
                        'class' => 'form-class'
                ));
        
        $actual = $this->formHelperHorizontal->render($this->form);
        // must contained them
        $matcher = array(
                'id' => 'form-id',
                'attributes' => array(
                        'role' => 'role',
                        'accesskey' => 'c',
                        'class' => 'form-class form-horizontal'
                ),
                'tag' => 'form'
        );
        $this->assertTag($matcher, $actual);
        // shouldn't contain them
        $matcher = array(
                'attributes' => array(
                        'foo' => 'bar'
                )
        );
        $this->assertNotTag($matcher, $actual);
    }

    /**
     * Tests Form->render() with a complex Form
     */
    public function testRenderEntityForm ()
    {
        $this->markTestSkipped("I have to correct some tests before this one");
        $form = new CreateProduct();
        $actual = $this->formHelperHorizontal->render($form);
        $actual = preg_replace('/> </', '><', $actual);
        $expected = file_get_contents('resources/entityForm.html', true);
        $expected = preg_replace('/\s+/', ' ', $expected);
        $expected = preg_replace('/> </', '><', $expected);
        $expected = sprintf($expected, $form->get('csrf')->getValue());
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Form->render() with a complex Form
     */
    public function testRenderFormBasic ()
    {
        $this->markTestSkipped("I have to correct some tests before this one");
        $actual = $this->formHelperBasic->render($this->formComplex);
        $actual = preg_replace('/> </', '><', $actual);
        $expected = file_get_contents('resources/form-basic.html', true);
        $expected = preg_replace('/\s+/', ' ', $expected);
        $expected = preg_replace('/> </', '><', $expected);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Render all forms and put them in an html page to have a look
     */
    public function testRenderFoms ()
    {
        // Rendering
        $formBasic = $this->formHelperBasic->render($this->formComplex);
        $formHorizontal = $this->formHelperHorizontal->render(
                $this->formComplex);
        $formInline = $this->formHelperInline->render($this->formComplex);
        $formDemonstration = $this->formHelperHorizontal->render(
                $this->formDemonstration);
        // Merging
        $expected = file_get_contents('resources/layout.html', true);
        $expected = sprintf($expected, $formDemonstration, $formBasic, $formHorizontal, $formInline 
                );
        // Writing
        $byte = file_put_contents('resources/results/render.html', $expected, 
                FILE_USE_INCLUDE_PATH | LOCK_EX);
        $this->assertInternalType('integer', $byte);
    }

    /**
     * Tests Form->openTag()
     */
    public function testOpenTag ()
    {
        // without element
        $expected = '<form action="" method="get">';
        $actual = $this->formHelperBasic->openTag();
        $this->assertEquals($expected, $actual);
        
        // with one element
        $expected = '<form action="" method="POST" class="">';
        $actual = $this->formHelperBasic->openTag($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal">';
        $actual = $this->formHelperHorizontal->openTag($this->form);
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-inline">';
        $actual = $this->formHelperInline->openTag($this->form);
        $this->assertEquals($expected, $actual);
        
        // two-elements basic
        $expected = '<form action="" method="POST" class="">';
        $actual = $this->formHelperBasic->openTag($this->form, 'basic');
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="">';
        $actual = $this->formHelperHorizontal->openTag($this->form, 'basic');
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal">';
        $actual = $this->formHelperBasic->openTag($this->form, 'horizontal');
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal">';
        $actual = $this->formHelperHorizontal->openTag($this->form, 
                'horizontal');
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-horizontal">';
        $actual = $this->formHelperHorizontal->openTag($this->form, 
                'horizontal');
        $this->assertEquals($expected, $actual);
        
        // three-elements
        $expected = '<form action="" method="POST" class="">';
        $actual = $this->formHelperBasic->openTag($this->form, 'basic', 
                array(
                        'id' => 'form-id'
                ));
        $this->assertEquals($expected, $actual);
        
        $expected = '<form action="" method="POST" class="form-class-foobar">';
        $actual = $this->formHelperBasic->openTag($this->form, 'basic', 
                array(
                        'class' => 'form-class-foobar'
                ));
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Form->openTag()
     */
    public function testOpenTagException ()
    {
        // throwed exception ?
        $this->setExpectedException(
                'Bootstrap\Exception\InvalidParameterException');
        $this->formHelperBasic->openTag($this->form, 'foobar');
    }
}