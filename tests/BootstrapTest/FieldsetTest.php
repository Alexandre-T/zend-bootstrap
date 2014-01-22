<?php
namespace BootstrapTest;

require_once 'PHPUnit/Framework/TestCase.php';

use Bootstrap\Util;
use Bootstrap\Form\View\Helper\Fieldset;
use Bootstrap\Form\View\Helper\Form as FormHelper;
use Bootstrap\Form\Util as FormUtil;
use Zend\Form\Form;
use Zend\View\Renderer\PhpRenderer;
use Zend\ServiceManager\ServiceManager;
use BootstrapTest\Util\ServiceManagerFactory;

/**
 * Fieldset test case.
 */
class FieldsetTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Fieldset
     */
    private $Fieldset;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $application    = $serviceManager->get('Application');
        $application->bootstrap();

        $this->Fieldset = new Fieldset(new Util(), new FormUtil());
        
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->Fieldset = null;
        
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
     * Tests Fieldset->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated FieldsetTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        
        $this->Fieldset->__construct(/* parameters */);
    }

    /**
     * Tests Fieldset->openTag()
     */
    public function testOpenTag()
    {
        // TODO Auto-generated FieldsetTest->testOpenTag()
        $this->markTestIncomplete("openTag test not implemented");
        
        $this->Fieldset->openTag(/* parameters */);
    }

    /**
     * Tests Fieldset->closeTag()
     */
    public function testCloseTag()
    {
        // TODO Auto-generated FieldsetTest->testCloseTag()
        $this->markTestIncomplete("closeTag test not implemented");
        
        $this->Fieldset->closeTag(/* parameters */);
    }

    /**
     * Tests Fieldset->content()
     */
    public function testContent()
    {
        // TODO Auto-generated FieldsetTest->testContent()
        $this->markTestIncomplete("content test not implemented");
        
        $this->Fieldset->content(/* parameters */);
    }

    /**
     * Tests Fieldset->render()
     */
    public function testRender()
    {
        // TODO Auto-generated FieldsetTest->testRender()
        $this->markTestIncomplete("render test not implemented");
        
        $this->Fieldset->render(/* parameters */);
    }

    /**
     * Tests Fieldset->__invoke()
     */
    public function test__invoke()
    {
        // TODO Auto-generated FieldsetTest->test__invoke()
        $this->markTestIncomplete("__invoke test not implemented");
        
        $this->Fieldset->__invoke(/* parameters */);
    }
}

