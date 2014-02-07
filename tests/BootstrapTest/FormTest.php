<?php
namespace BootstrapTest;
use Bootstrap\Form\View\Helper\Form as FormHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Form;
use BootstrapTest\Util\ServiceManagerFactory;
use Zend\View\Renderer\ConsoleRenderer;
use BootstrapTest\Form\CreateProduct;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Date;
use Zend\Form\Element\DateTimeLocal;
use Zend\Form\Element\Month;
use Zend\Form\Element\Number;
use Zend\Form\Element\Select;
use Zend\Form\Element\Color;
use Zend\Form\Element\Email;
use Zend\Form\Element\Url;
use Zend\Form\Element\Time;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Radio;
use Bootstrap\Form\View\Helper\HelpBlock;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\File;
use Zend\Form\Element\Image;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Button;
use Zend\Form\Element\Captcha;
use Zend\Captcha\Image as CaptchaImage;
use Zend\Form\Element\DateTimeSelect;
use Zend\Form\Element\DateSelect;
use Zend\Form\Element\MonthSelect;
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
        
        $helpcore = array(HelpBlock::HELP_BLOCK => 'This is an Help block gen. by element option : '.HelpBlock::HELP_BLOCK);
        
        $this->form = new Form();
        $this->formComplex = new Form('form-complex');
        $this->formDemonstration = new Form('form-demo');
        
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
        
        $email = new Email('exampleInputEmail1');
        $email->setLabel('Email address');
        $email->setAttribute('placeholder', 'Enter Email');
        $email->setOptions($helpcore);
        
        $password = new Password('exampleInputPassword1');
        $password->setLabel('Password');
        $password->setAttribute('placeholder', 'Enter password');
        $password->setOptions(
                array(
                        'options' => array(
                                'help' => 'Example block-level help text here.'
                        )
                ));
        $password->setOptions($helpcore);
        
        $captcha = new CaptchaImage(array(
        		'font' => __DIR__ . '/resources/fonts/LiberationMono-Regular.ttf',
        		'width' => 250,
        		'height' => 100,
        		'dotNoiseLevel' => 40,
        		'lineNoiseLevel' => 3,                
        ));
        $captcha->setImgDir(__DIR__ . '/resources/images/captcha');
        $captcha->setImgUrl('file://' . __DIR__ . '/resources/images/captcha');
        
        $captchaElement = new Captcha('captcha');
        $captchaElement->setLabel('Captcha');
        $captchaElement->setCaptcha($captcha);
        $captchaElement->setOptions($helpcore);
        
        $checkbox = new Checkbox('checkbox');
        $checkbox->setLabel('Check me out');
        $checkbox->setOptions($helpcore);
                
        $color = new Color('color-name');
        $color->setLabel('Color type');
        $color->setOptions($helpcore);
        
        $date = new Date('date-name');
        $date->setLabel('Date type');
        $date->setOptions($helpcore);
        
        $dateTime = new DateTime('datetime-name');
        $dateTime->setLabel('Date Time type');
        $dateTime->setOptions($helpcore);
        
        $dateTimeLocal = new DateTimeLocal('datetimelocal-name');
        $dateTimeLocal->setLabel('Date Time local type');
        $dateTimeLocal->setOptions($helpcore);
        
        $dateSelect = new DateSelect('dateselect-name');
        $dateSelect->setLabel('Zend Date Select');
        $dateSelect->setOptions($helpcore);
        
        $dateTimeSelect = new DateTimeSelect('datetimeselect-name');
        $dateTimeSelect->setLabel('Zend Date Time Select');
        $dateTimeSelect->setOptions($helpcore);
        
        $image = new Image('image-name');
        $image->setLabel('Image Type for upload');
        $image->setAttribute('src', '../images/ZF2-Logo.png'); // Src attribute is required
        $image->setOptions($helpcore);
        
        $file = new File('file-name');
        $file->setLabel('File Type for upload');
        $file->setOptions($helpcore);
        
        $month = new Month('month-name');
        $month->setLabel('Month type');
        $month->setOptions($helpcore);
        
        $monthSelect = new MonthSelect('month-select');
        $monthSelect->setLabel('monthselect-name');
        $monthSelect->setOptions($helpcore);
        
        $multicheckbox = new MultiCheckbox('multi-checkbox-name');
        $multicheckbox->setLabel('Multi Checkbox');
        $multicheckbox->setValueOptions(array(
                'cat' => 'Cat',
                'dog' => 'Dog',
                'horse' => 'Horse',
                'fish' => 'Red Fish',
        ));
        $multicheckbox->setOptions($helpcore);
        
        $number = new Number('number-name');
        $number->setLabel('Number type');
        $number->setOptions($helpcore);
        
        $radio = new Radio('radio-name');
        $radio->setLabel('Radio type');
        $radio->setValueOptions(array(
                1 => 'Male',
                2 => 'Female',
                3 => 'Unavailable information',
        )); 
        $radio->setOptions($helpcore);
        
        $reset = new Text('reset-name');
        $reset->setAttribute('type', 'reset');
        $reset->setLabel('Reset');
        $reset->setOptions($helpcore);
        
        $search = new Text('search-name');
        $search->setLabel('Search type');
        $search->setAttribute('type', 'search');
        $search->setOptions($helpcore);
        
        $select = new Select('select-name');
        $select->setLabel('Select input');
        $select->setValueOptions(array(
                '1' => 'Option 1',
                2 => 'Option 2'
        ));
        $select->setOptions($helpcore);
        
        $send = new Button('send-button');
        $send->setLabel('Send');

        $submit = new Submit('s1');
        $submit->setLabel('Submit');
        $submit->setOptions($helpcore);
        
        $tel = new Text('tel-name');
        $tel->setLabel('Tel type');
        $tel->setAttribute('type','tel');
        $tel->setOptions($helpcore);
        
        $text = new Text('text-name');
        $text->setLabel('Text type');
        $text->setAttribute('placeholder', 'Example Text placeholder');
        $text->setOptions($helpcore);
        
        $textarea = new Textarea('textarea-name');
        $textarea->setLabel('Textarea type');
        $textarea->setAttribute('placeholder', 'Example Textarea placeholder');
        $textarea->setOptions($helpcore);
        
        $time = new Time('time-name');
        $time->setLabel('Time type');
        $time->setAttribute('placeholder', 'Example Time placeholder');
        $time->setOptions($helpcore);
        
        $url = new Url('url-name');
        $url->setLabel('Url type');
        $url->setAttribute('placeholder', 'http://www.example.org');
        $url->setOptions($helpcore);
        
        $week = new Text('week-name');
        $week->setLabel('Week type');        
        $week->setOptions($helpcore);
        
        //Building form
        $this->formDemonstration->add($captchaElement);
        $this->formDemonstration->add($checkbox);
        $this->formDemonstration->add($color);
        $this->formDemonstration->add($date);
        $this->formDemonstration->add($dateTime);
        $this->formDemonstration->add($dateTimeLocal);
        $this->formDemonstration->add($dateSelect);
        $this->formDemonstration->add($dateTimeSelect);
        $this->formDemonstration->add($email);
        $this->formDemonstration->add($image);
        $this->formDemonstration->add($file);
        $this->formDemonstration->add($month);
        $this->formDemonstration->add($monthSelect);
        $this->formDemonstration->add($multicheckbox);
        $this->formDemonstration->add($number);
        $this->formDemonstration->add($password);
        $this->formDemonstration->add($radio);
        $this->formDemonstration->add($search);
        $this->formDemonstration->add($select);
        $this->formDemonstration->add($tel);
        $this->formDemonstration->add($text);
        $this->formDemonstration->add($textarea);
        $this->formDemonstration->add($time);
        $this->formDemonstration->add($url);
        $this->formDemonstration->add($week);
        
        $this->formDemonstration->add($reset);
        $this->formDemonstration->add($send);
        $this->formDemonstration->add($submit);
        
        // form build
        $this->formComplex->setAttribute('role', 'form');
        $this->formComplex->add($email);
        $this->formComplex->add($radio);
        $this->formComplex->add($password);
        $this->formComplex->add($checkbox);
        $this->formComplex->add($url);
        $this->formComplex->add($multicheckbox);
        $this->formComplex->add(
                array(
                        'name' => 'submit',
                        'type' => 'button',
                        'options' => array(
                                'label' => 'Send'
                        )
                ));
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
        $formHorizontal = $this->formHelperHorizontal->render($this->formComplex);
        $formInline = $this->formHelperInline->render($this->formComplex);
        $formDemonstration = $this->formHelperHorizontal->render($this->formDemonstration);
        // Merging
        $expected = file_get_contents('resources/layout.html', true);
        $expected = sprintf($expected, $formDemonstration, $formBasic, 
                $formHorizontal, $formInline);
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