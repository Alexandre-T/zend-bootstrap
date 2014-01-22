<?php
namespace BootstrapTest;

require_once 'PHPUnit/Framework/TestCase.php';

use Bootstrap\Util;
use Bootstrap\Form\View\Helper\Fieldset as FieldsetHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Form;
use BootstrapTest\Util\ServiceManagerFactory;
use Zend\Form\Fieldset;

/**
 * Fieldset test case.
 */
class FieldsetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * 
     * @var Zend\Form\Form
     */
    private $form;
    /**
     *
     * @var Bootstrap\Form\View\Helper\Fieldset
     */
    private $fieldsetHelper;
    /**
     * 
     * @var Zend\Form\Fieldset
     */
    private $fieldset;

    /**
     *
     * @var Zend\Form\Fieldset
     */
    private $fieldsetNamed;
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $application    = $serviceManager->get('Application');
        $application->bootstrap();
        $viewManager = $serviceManager->get('view_manager');
        $view = $viewManager->getRenderer();
        
        $this->fieldsetHelper = new FieldsetHelper(new Util(), new FormUtil());
        $this->fieldsetHelper->setView($view);
        
        $this->fieldset = new Fieldset();
        $this->fieldsetNamed = new Fieldset('senderbar');
        $this->fieldsetNamedAndId = new Fieldset('senderfoobar');
        $this->fieldsetNamedAndId->setAttribute('id', 'sender-foobar-id');
        $this->fieldsetNamedAndId->setAttribute('disabled', '');
        
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->fieldsetHelper = null;
        $this->form = null;
        
        parent::tearDown();
    }


    /**
     * Tests Fieldset->openTag()
     */
    public function testOpenTag()
    {
        //one element
        $expected = '<fieldset>';
        $actual = $this->fieldsetHelper->openTag($this->fieldset);
        $this->assertEquals($expected, $actual);
        
        $expected = '<fieldset name="senderbar">';
        $actual = $this->fieldsetHelper->openTag($this->fieldsetNamed);
        $this->assertEquals($expected, $actual);
        
        $expected = '<fieldset name="senderfoobar" id="sender-foobar-id" disabled>';
        $actual = $this->fieldsetHelper->openTag($this->fieldsetNamed);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Fieldset->closeTag()
     */
    public function testCloseTag()
    {
        // TODO Auto-generated FieldsetTest->testCloseTag()
        $this->markTestIncomplete("closeTag test not implemented");
        
        $this->fieldsetHelper->closeTag(/* parameters */);
    }

    /**
     * Tests Fieldset->content()
     */
    public function testContent()
    {
        // TODO Auto-generated FieldsetTest->testContent()
        $this->markTestIncomplete("content test not implemented");
        
        $this->fieldsetHelper->content(/* parameters */);
    }

    /**
     * Tests Fieldset->render()
     */
    public function testRender()
    {
        // TODO Auto-generated FieldsetTest->testRender()
        $this->markTestIncomplete("render test not implemented");
        
        $this->fieldsetHelper->render(/* parameters */);
    }

    /**
     * Tests Fieldset->__invoke()
     */
    public function test__invoke()
    {
        // TODO Auto-generated FieldsetTest->test__invoke()
        $this->markTestIncomplete("__invoke test not implemented");
        
        $this->fieldsetHelper->__invoke(/* parameters */);
    }
}

