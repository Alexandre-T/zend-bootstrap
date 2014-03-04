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
        $this->assertEquals('Bootstrap\Form\View\Helper\InlineSeparator',get_class($helperPluginManager->get('bsinlineseparator')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Label',get_class($helperPluginManager->get('bslabel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Row',get_class($helperPluginManager->get('bsrow')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element',get_class($helperPluginManager->get('bselement')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Button',get_class($helperPluginManager->get('bsbutton')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Captcha',get_class($helperPluginManager->get('bscaptcha')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Checkbox',get_class($helperPluginManager->get('bscheckbox')));
        $this->assertEquals('Bootstrap\Form\View\Helper\CheckboxTag',get_class($helperPluginManager->get('bscheckboxtag')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Color',get_class($helperPluginManager->get('bscolor')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Date',get_class($helperPluginManager->get('bsdate')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\DateTime',get_class($helperPluginManager->get('bsdatetime')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\DateTimeLocal',get_class($helperPluginManager->get('bsdatetimelocal')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Email',get_class($helperPluginManager->get('bsemail')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\File',get_class($helperPluginManager->get('bsfile')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Month',get_class($helperPluginManager->get('bsmonth')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\MonthSelect',get_class($helperPluginManager->get('bsmonthselect')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\MultiCheckbox',get_class($helperPluginManager->get('bsmulticheckbox')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Number',get_class($helperPluginManager->get('bsnumber')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Offset',get_class($helperPluginManager->get('bsoffset')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Password',get_class($helperPluginManager->get('bspassword')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Radio',get_class($helperPluginManager->get('bsradio')));
        $this->assertEquals('Bootstrap\Form\View\Helper\RadioTag',get_class($helperPluginManager->get('bsradiotag')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Range',get_class($helperPluginManager->get('bsrange')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Reset',get_class($helperPluginManager->get('bsreset')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Search',get_class($helperPluginManager->get('bssearch')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Select',get_class($helperPluginManager->get('bsselect')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Submit',get_class($helperPluginManager->get('bssubmit')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Strong',get_class($helperPluginManager->get('bsstrong')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Tel',get_class($helperPluginManager->get('bstel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Text',get_class($helperPluginManager->get('bstext')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Time',get_class($helperPluginManager->get('bstime')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Url',get_class($helperPluginManager->get('bsurl')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Week',get_class($helperPluginManager->get('bsweek')));
        //Are Zend View Helper preserved ?
        $this->assertEquals('Zend\Form\View\Helper\FormCollection',get_class($helperPluginManager->get('formcollection')));
        $this->assertEquals('Zend\Form\View\Helper\Form',get_class($helperPluginManager->get('form')));
        $this->assertEquals('Zend\Form\View\Helper\FormLabel',get_class($helperPluginManager->get('formlabel')));
        $this->assertEquals('Zend\Form\View\Helper\FormRow',get_class($helperPluginManager->get('formrow')));
        $this->assertEquals('Zend\Form\View\Helper\FormElement',get_class($helperPluginManager->get('formelement')));
        
        $this->assertEquals('Zend\Form\View\Helper\FormButton',get_class($helperPluginManager->get('formbutton')));
        $this->assertEquals('Zend\Form\View\Helper\FormCaptcha',get_class($helperPluginManager->get('formcaptcha')));
        $this->assertEquals('Zend\Form\View\Helper\FormCheckbox',get_class($helperPluginManager->get('formcheckbox')));
        $this->assertEquals('Zend\Form\View\Helper\FormColor',get_class($helperPluginManager->get('formcolor')));
        $this->assertEquals('Zend\Form\View\Helper\FormDate',get_class($helperPluginManager->get('formdate')));
        $this->assertEquals('Zend\Form\View\Helper\FormDateTime',get_class($helperPluginManager->get('formdatetime')));
        $this->assertEquals('Zend\Form\View\Helper\FormDateTimeLocal',get_class($helperPluginManager->get('formdatetimelocal')));
        $this->assertEquals('Zend\Form\View\Helper\FormEmail',get_class($helperPluginManager->get('formemail')));
        $this->assertEquals('Zend\Form\View\Helper\FormFile',get_class($helperPluginManager->get('formfile')));
        $this->assertEquals('Zend\Form\View\Helper\FormMonth',get_class($helperPluginManager->get('formmonth')));
        $this->assertEquals('Zend\Form\View\Helper\FormMonthSelect',get_class($helperPluginManager->get('formmonthselect')));
        $this->assertEquals('Zend\Form\View\Helper\FormMultiCheckbox',get_class($helperPluginManager->get('formmulticheckbox')));
        $this->assertEquals('Zend\Form\View\Helper\FormNumber',get_class($helperPluginManager->get('formnumber')));
        $this->assertEquals('Zend\Form\View\Helper\FormPassword',get_class($helperPluginManager->get('formpassword')));
        $this->assertEquals('Zend\Form\View\Helper\FormRadio',get_class($helperPluginManager->get('formradio')));
        $this->assertEquals('Zend\Form\View\Helper\FormRange',get_class($helperPluginManager->get('formrange')));
        $this->assertEquals('Zend\Form\View\Helper\FormReset',get_class($helperPluginManager->get('formreset')));
        $this->assertEquals('Zend\Form\View\Helper\FormSearch',get_class($helperPluginManager->get('formsearch')));
        $this->assertEquals('Zend\Form\View\Helper\FormSelect',get_class($helperPluginManager->get('formselect')));
        $this->assertEquals('Zend\Form\View\Helper\FormSubmit',get_class($helperPluginManager->get('formsubmit')));
        $this->assertEquals('Zend\Form\View\Helper\FormTel',get_class($helperPluginManager->get('formtel')));
        $this->assertEquals('Zend\Form\View\Helper\FormText',get_class($helperPluginManager->get('formtext')));
        $this->assertEquals('Zend\Form\View\Helper\FormTextarea',get_class($helperPluginManager->get('formtextarea')));
        $this->assertEquals('Zend\Form\View\Helper\FormTime',get_class($helperPluginManager->get('formtime')));
        $this->assertEquals('Zend\Form\View\Helper\FormUrl',get_class($helperPluginManager->get('formurl')));
        $this->assertEquals('Zend\Form\View\Helper\FormWeek',get_class($helperPluginManager->get('formweek')));
        //$this->assertEmpty(get_class($helperPluginManager->get('formgroup')));
        //$this->assertEquals('',get_class($helperPluginManager->get('formhelp')));
        
        //var_dump($helperPluginManager->getRegisteredServices());
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
        $this->assertEquals('Bootstrap\Form\View\Helper\InlineSeparator',get_class($helperPluginManager->get('bsinlineseparator')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Button',get_class($helperPluginManager->get('bsbutton')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Captcha',get_class($helperPluginManager->get('bscaptcha')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Checkbox',get_class($helperPluginManager->get('bscheckbox')));
        $this->assertEquals('Bootstrap\Form\View\Helper\CheckboxTag',get_class($helperPluginManager->get('bscheckboxtag')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Color',get_class($helperPluginManager->get('bscolor')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Date',get_class($helperPluginManager->get('bsdate')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\DateTime',get_class($helperPluginManager->get('bsdatetime')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\DateTimeLocal',get_class($helperPluginManager->get('bsdatetimelocal')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Email',get_class($helperPluginManager->get('bsemail')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\File',get_class($helperPluginManager->get('bsfile')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Month',get_class($helperPluginManager->get('bsmonth')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\MonthSelect',get_class($helperPluginManager->get('bsmonthselect')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\MultiCheckbox',get_class($helperPluginManager->get('bsmulticheckbox')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Number',get_class($helperPluginManager->get('bsnumber')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Password',get_class($helperPluginManager->get('bspassword')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Radio',get_class($helperPluginManager->get('bsradio')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Range',get_class($helperPluginManager->get('bsrange')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Reset',get_class($helperPluginManager->get('bsreset')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Search',get_class($helperPluginManager->get('bssearch')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Select',get_class($helperPluginManager->get('bsselect')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Submit',get_class($helperPluginManager->get('bssubmit')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Strong',get_class($helperPluginManager->get('bsstrong')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Tel',get_class($helperPluginManager->get('bstel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Text',get_class($helperPluginManager->get('bstext')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Textarea',get_class($helperPluginManager->get('bstextarea')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Time',get_class($helperPluginManager->get('bstime')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Url',get_class($helperPluginManager->get('bsurl')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Week',get_class($helperPluginManager->get('bsweek')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Offset',get_class($helperPluginManager->get('bsoffset')));
        //Are Zend View Helper override ?
        $this->assertEquals('Bootstrap\Form\View\Helper\Collection',get_class($helperPluginManager->get('formcollection')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Form',get_class($helperPluginManager->get('form')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Label',get_class($helperPluginManager->get('formlabel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Row',get_class($helperPluginManager->get('formrow')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element',get_class($helperPluginManager->get('formelement')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Button',get_class($helperPluginManager->get('formbutton')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Captcha',get_class($helperPluginManager->get('formcaptcha')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Checkbox',get_class($helperPluginManager->get('formcheckbox')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Color',get_class($helperPluginManager->get('formcolor')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Date',get_class($helperPluginManager->get('formdate')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\DateTime',get_class($helperPluginManager->get('formdatetime')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\DateTimeLocal',get_class($helperPluginManager->get('formdatetimelocal')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Email',get_class($helperPluginManager->get('formemail')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\File',get_class($helperPluginManager->get('formfile')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Month',get_class($helperPluginManager->get('formmonth')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\MonthSelect',get_class($helperPluginManager->get('formmonthselect')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\MultiCheckbox',get_class($helperPluginManager->get('formmulticheckbox')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Number',get_class($helperPluginManager->get('formnumber')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Password',get_class($helperPluginManager->get('formpassword')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Radio',get_class($helperPluginManager->get('formradio')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Range',get_class($helperPluginManager->get('formrange')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Reset',get_class($helperPluginManager->get('formreset')));
        $this->assertEquals('Bootstrap\Form\View\Helper\RadioTag',get_class($helperPluginManager->get('bsradiotag')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Search',get_class($helperPluginManager->get('formsearch')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Select',get_class($helperPluginManager->get('formselect')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Submit',get_class($helperPluginManager->get('formsubmit')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Tel',get_class($helperPluginManager->get('formtel')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Text',get_class($helperPluginManager->get('formtext')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Textarea',get_class($helperPluginManager->get('formtextarea')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Time',get_class($helperPluginManager->get('formtime')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Url',get_class($helperPluginManager->get('formurl')));
        $this->assertEquals('Bootstrap\Form\View\Helper\Element\Week',get_class($helperPluginManager->get('formweek')));
        //We don't create new plugin who didn't exists before override, no formoffset as example
        $this->assertFalse($helperPluginManager->has('formgroup'));
        $this->assertFalse($helperPluginManager->has('formhelp'));
        $this->assertFalse($helperPluginManager->has('formoffset'));
        $this->assertFalse($helperPluginManager->has('formstrong'));
        $this->assertFalse($helperPluginManager->has('formcheckboxtag'));
        $this->assertFalse($helperPluginManager->has('formradiotag'));
        
        // TODO Auto-generated ConfigTest->test__construct()
        $this->markTestIncomplete("testConfigureServiceManager test is not finished");
    }
}

