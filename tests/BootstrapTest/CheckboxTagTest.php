<?php

namespace BootstrapTest;

use Bootstrap\Form\View\Helper\CheckboxTag;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * CheckboxTag test case.
 */
class CheckboxTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var CheckboxTag
     */
    private $checkboxTagHelper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->checkboxTagHelper = new CheckboxTag();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->checkboxTagHelper = null;
        parent::tearDown();
    }

    /**
     * Tests Checkbox->render()
     */
    public function testRender()
    {
        $expected = '<div class="checkbox">Some text</div> ';
        $actual   = $this->checkboxTagHelper->render('Some text');
        $this->assertEquals($expected, $actual);
        $expected = '<div class="foo bar">Some text</div> ';
        $actual   = $this->checkboxTagHelper->render('Some text','foo bar');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Checkbox->openTag()
     */
    public function testOpenTag()
    {
        $this->assertEquals('<div class="checkbox">',$this->checkboxTagHelper->openTag());
        $this->assertEquals('<div class="foo bar">',$this->checkboxTagHelper->openTag('foo bar'));
    }

    /**
     * Tests Checkbox->closeTag()
     */
    public function testCloseTag()
    {
        $this->assertEquals('</div> ',$this->checkboxTagHelper->closeTag());
    }

    /**
     * Tests Checkbox->__invoke()
     */
    public function test__invoke()
    {
        $checkboxTagHelper = $this->checkboxTagHelper;
        $this->assertTrue(is_callable($checkboxTagHelper));
        
        $expected = '<div class="checkbox">Some text</div> ';
        $actual   = $this->checkboxTagHelper->__invoke('Some text');        
        $this->assertEquals($expected, $actual);
        $actual   = $checkboxTagHelper('Some text');
        $this->assertEquals($expected, $actual);

        $expected = '<div class="foo bar">Some text</div> ';
        $actual   = $this->checkboxTagHelper->__invoke('Some text','foo bar');
        $this->assertEquals($expected, $actual);
        $actual   = $checkboxTagHelper('Some text','foo bar');
        $this->assertEquals($expected, $actual);
        
    }
}

