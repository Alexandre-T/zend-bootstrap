<?php

namespace BootstrapTest;

use Bootstrap\Form\View\Helper\HelpBlock;
use Zend\Form\Element;
use Zend\Form\Element\Hidden;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * HelpBlock test case.
 */
class HelpBlockTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var HelpBlock
     */
    private $helpBlock;
    /**
     * 
     * @var Hidden
     */
    private $elementHiddenNoHelp;
    /**
     * 
     * @var Text
     */
    private $elementTextNoHelp;
    /**
     * 
     * @var Hidden
     */
    private $elementHidden;
    /**
     * 
     * @var Text
     */
    private $elementText;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->elementText = new Element('text-name',array(
        	'class' => 'form-control',
            'help'  => 'Help description',
        ));
        $this->elementHidden = new Hidden('text-hidden',array(
            'foo'  => 'bar',
            'help' => 'Help description',
        ));
        $this->elementTextNoHelp = new Element('text-name',array(
        		'class' => 'form-control',
        ));
        $this->elementHiddenNoHelp = new Hidden('hidden',array(
        		'foo'  => 'bar',
        ));
        $this->helpBlock = new HelpBlock();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->helpBlock = null;
        $this->elementHiddenNoHelp = null;
        $this->elementTextNoHelp = null;
        $this->elementHidden = null;
        $this->elementText = null;
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
     * Tests HelpBlock->render()
     */
    public function testRender()
    {
        $this->assertEmpty($this->helpBlock->render($this->elementHiddenNoHelp));
        $this->assertEmpty($this->helpBlock->render($this->elementTextNoHelp));
        $expected='<p class="help-block">Help description</p>';
        $this->assertEquals($expected, $this->helpBlock->render($this->elementText));
        $this->assertEmpty($this->helpBlock->render($this->elementHidden));
        
    }

    /**
     * Tests HelpBlock->helpBlockTag()
     */
    public function testHelpBlockTag()
    {
        $this->assertEmpty($this->helpBlock->helpBlockTag(''));
        $this->assertEmpty($this->helpBlock->helpBlockTag(null));
        $this->assertEquals('<p class="help-block">Help</p>',$this->helpBlock->helpBlockTag('Help'));
        
    }

    /**
     * Tests HelpBlock->__invoke()
     */
    public function test__invoke()
    {
        $this->assertTrue(is_callable($this->helpBlock));
        $helpBlock = $this->helpBlock;
        $this->assertEmpty($this->helpBlock->__invoke($this->elementTextNoHelp));
        $this->assertEmpty($helpBlock($this->elementTextNoHelp));
        $this->assertEmpty($helpBlock($this->elementHidden));
        $this->assertEquals('<p class="help-block">Help description</p>',$helpBlock($this->elementText));
        $this->assertEquals('<p class="help-block">Help description</p>',$this->helpBlock->__invoke($this->elementText));
        
        
    }
}

