<?php
namespace BootstrapTest;

use Bootstrap\Form\View\Helper\Config;
use Bootstrap\Form\Util;
use BootstrapTest\Util\ServiceManagerFactory;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Config test case.
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Config
     */
    private $Config;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        //Don't initialised Config now        
        //$this->Config = new Config(new Util());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->Config = null;
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
     * Tests Config->configureServiceManager()
     */
    public function testConfigureServiceManagerWithoutOverride()
    {
        $this->Config = new Config(new Util(null, false));
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $application = $serviceManager->get('Application');
        $application->bootstrap();
        $helperPluginManager = $serviceManager->get('view_helper_manager');
        $this->Config->configureServiceManager($helperPluginManager);
        
        
        //Are Bootstrap View Helper Loaded ?
        $this->assertEquals('Bootstrap\Form\View\Helper\Collection',get_class($helperPluginManager->get('bscollection')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Form',get_class($helperPluginManager->get('bsform')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Group',get_class($helperPluginManager->get('bsgroup')));
        $this->assertEquals('Bootstrap\Form\View\Helper\HelpBlock',get_class($helperPluginManager->get('bshelp')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Label',get_class($helperPluginManager->get('bslabel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Row',get_class($helperPluginManager->get('bsrow')));
        //Are Zend View Helper preserved ?
        $this->assertEquals('Zend\Form\View\Helper\FormCollection',get_class($helperPluginManager->get('formcollection')));
        $this->assertEquals('Zend\Form\View\Helper\Form',get_class($helperPluginManager->get('form')));
        $this->assertEquals('Zend\Form\View\Helper\FormLabel',get_class($helperPluginManager->get('formlabel')));
        $this->assertEquals('Zend\Form\View\Helper\FormRow',get_class($helperPluginManager->get('formrow')));
        //$this->assertEmpty(get_class($helperPluginManager->get('formgroup')));
        //$this->assertEquals('',get_class($helperPluginManager->get('formhelp')));
    }
    public function testConfigureServiceManagerWithOverride(){
        $this->Config = new Config(new Util(null,true));
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $application = $serviceManager->get('Application');
        $application->bootstrap();
        $helperPluginManager = $serviceManager->get('view_helper_manager');
        $this->Config->configureServiceManager($helperPluginManager);
        
        //Are Bootstrap View Helper Loaded ?
        $this->assertEquals('Bootstrap\Form\View\Helper\Collection',get_class($helperPluginManager->get('bscollection')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Form',get_class($helperPluginManager->get('bsform')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Group',get_class($helperPluginManager->get('bsgroup')));
        $this->assertEquals('Bootstrap\Form\View\Helper\HelpBlock',get_class($helperPluginManager->get('bshelp')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Label',get_class($helperPluginManager->get('bslabel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Row',get_class($helperPluginManager->get('bsrow')));
        //Are Zend View Helper override ?
        $this->assertEquals('Bootstrap\Form\View\Helper\Group',get_class($helperPluginManager->get('formgroup')));
        $this->assertEquals('Bootstrap\Form\View\Helper\HelpBlock',get_class($helperPluginManager->get('formhelp')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Collection',get_class($helperPluginManager->get('formcollection')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Form',get_class($helperPluginManager->get('form')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Label',get_class($helperPluginManager->get('formlabel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Row',get_class($helperPluginManager->get('formrow')));
        
        
        
        // TODO Auto-generated ConfigTest->test__construct()
        $this->markTestIncomplete("testConfigureServiceManager test is not finished");
    }
}

