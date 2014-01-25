<?php
namespace BootstrapTest;
use Bootstrap\Form\View\Helper\Row;
use Zend\Form\Element\Text;
use BootstrapTest\Util\ServiceManagerFactory;
use Zend\View\Renderer\ConsoleRenderer;
use Bootstrap\Form\Util;
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Row test case.
 */
class RowTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Row
     */
    private $rowHelper;
    /**
     * @var Text
     */
    private $elementText;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $application = $serviceManager->get('Application');
        $application->bootstrap();
        
        /* @var $viewManager \Zend\Mvc\View\Http\ViewManager */
        $viewManager = $serviceManager->get('view_manager');
        $view = $viewManager->getRenderer();
        
        $this->elementText = new Text('text-name');

        $this->rowHelper = new Row(new Util());
        $this->rowHelper->setView($view);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated RowTest::tearDown()
        $this->rowHelper = null;
        $this->elementText = null;
        parent::tearDown();
    }

    /**
     * Tests Row->render()
     */
    public function testRender()
    {
        $expected = '<div class="form-group"><input type="text" name="text-name" value=""></div>';
        $actual = $this->rowHelper->render($this->elementText);
        $this->assertEquals($expected, $actual);
    }
    /**
     * Tests Row->render() with a unplugabled view
     */
    public function testRenderWithConsoleView(){
        $view = new ConsoleRenderer();
        $this->rowHelper->setView($view);
        $this->assertEquals('',$this->rowHelper->render($this->elementText));
    }

    /**
     * Tests Row->getFormGroup()
     */
    public function testGetFormGroup()
    {
        $this->assertTrue($this->rowHelper->getFormGroup());
        $this->rowHelper->setFormGroup(false);
        $this->assertFalse($this->rowHelper->getFormGroup());
        $this->rowHelper->setFormGroup(true);
        $this->assertTrue($this->rowHelper->getFormGroup());
    }

    /**
     * Tests Row->setFormGroup()
     */
    public function testSetFormGroup()
    {
        $this->rowHelper->setFormGroup(true);
        $this->assertTrue($this->rowHelper->getFormGroup());
        $this->rowHelper->setFormGroup(false);
        $this->assertFalse($this->rowHelper->getFormGroup());
        $this->rowHelper->setFormGroup();
        $this->assertTrue($this->rowHelper->getFormGroup());
    }
}

