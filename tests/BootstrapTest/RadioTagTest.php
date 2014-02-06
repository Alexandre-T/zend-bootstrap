<?php

namespace BootstrapTest;

use Bootstrap\Form\View\Helper\RadioTag;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * radioTag test case.
 */
class RadioTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var radioTag
     */
    private $radioTagHelper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->radioTagHelper = new RadioTag();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->radioTagHelper = null;
        parent::tearDown();
    }

    /**
     * Tests radio->render()
     */
    public function testRender()
    {
        $expected = '<div class="radio">Some text</div> ';
        $actual   = $this->radioTagHelper->render('Some text');
        $this->assertEquals($expected, $actual);
        $expected = '<div class="foo bar">Some text</div> ';
        $actual   = $this->radioTagHelper->render('Some text','foo bar');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests radio->openTag()
     */
    public function testOpenTag()
    {
        $this->assertEquals('<div class="radio">',$this->radioTagHelper->openTag());
        $this->assertEquals('<div class="foo bar">',$this->radioTagHelper->openTag('foo bar'));
    }

    /**
     * Tests radio->closeTag()
     */
    public function testCloseTag()
    {
        $this->assertEquals('</div> ',$this->radioTagHelper->closeTag());
    }

    /**
     * Tests radio->__invoke()
     */
    public function test__invoke()
    {
        $radioTagHelper = $this->radioTagHelper;
        $this->assertTrue(is_callable($radioTagHelper));
        
        $expected = '<div class="radio">Some text</div> ';
        $actual   = $this->radioTagHelper->__invoke('Some text');        
        $this->assertEquals($expected, $actual);
        $actual   = $radioTagHelper('Some text');
        $this->assertEquals($expected, $actual);

        $expected = '<div class="foo bar">Some text</div> ';
        $actual   = $this->radioTagHelper->__invoke('Some text','foo bar');
        $this->assertEquals($expected, $actual);
        $actual   = $radioTagHelper('Some text','foo bar');
        $this->assertEquals($expected, $actual);
        
    }
}

