<?php
use Bootstrap\Form\View\Helper\InlineSeparator;

/**
 * InlineSeparator test case.
 */
class InlineSeparatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var InlineSeparator
     */
    private $inlineSeparator;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        $this->inlineSeparator = new InlineSeparator();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->inlineSeparator = null;

        parent::tearDown();
    }

    /**
     * Tests InlineSeparator->render()
     */
    public function testRender ()
    {
        $content  = '5  4';
        $actual   = $this->inlineSeparator->render($content, ' ', ' ');
        $expected = '<div class="row"><div class="col-sm-6">5 </div><div class="col-sm-6"> 4</div></div> ';
        $this->assertEquals($expected, $actual);
        
        $content  = '5  4  3';
        $actual   = $this->inlineSeparator->render($content, ' ', ' ');
        $expected = '<div class="row"><div class="col-sm-4">5 </div><div class="col-sm-4"> 4 </div><div class="col-sm-4"> 3</div></div> ';
        $this->assertEquals($expected, $actual);
        
        $content  = '5  4  3  2';
        $actual   = $this->inlineSeparator->render($content, ' ', ' ');
        $expected = '<div class="row"><div class="col-sm-3">5 </div><div class="col-sm-3"> 4 </div><div class="col-sm-3"> 3 </div><div class="col-sm-3"> 2</div></div> ';
        $this->assertEquals($expected, $actual);
        
    }

    /**
     * Tests InlineSeparator->openTag()
     */
    public function testOpenTag ()
    {
        $expected = '<div class="row"><div class="col-sm-4">';
        $this->assertEquals($expected, $this->inlineSeparator->openTag(4));
        
        $expected = '<div class="row"><div class="col-sm-6">';
        $this->assertEquals($expected, $this->inlineSeparator->openTag(6));
        
    }

    /**
     * Tests InlineSeparator->splitTag()
     */
    public function testSplitTag ()
    {
        $actual   = $this->inlineSeparator->splitTag(4);
        $expected = '</div><div class="col-sm-4">';
        $this->assertEquals($expected, $actual);
        
        $actual   = $this->inlineSeparator->splitTag(2);
        $expected = '</div><div class="col-sm-2">';
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests InlineSeparator->closeTag()
     */
    public function testCloseTag ()
    {
        $this->assertEquals('</div></div> ',$this->inlineSeparator->closeTag());
    }

    /**
     * Tests InlineSeparator->__invoke()
     */
    public function test__invoke ()
    {
        $inlineSeparator = $this->inlineSeparator;
        $this->assertTrue(is_callable($inlineSeparator));
        
        $content  = '5  4';
        $actual   = $inlineSeparator($content, ' ', ' ');
        $expected = '<div class="row"><div class="col-sm-6">5 </div><div class="col-sm-6"> 4</div></div> ';
        $this->assertEquals($expected, $actual);
        
        $content  = '5  4  3';
        $actual   = $inlineSeparator($content, ' ', ' ');
        $expected = '<div class="row"><div class="col-sm-4">5 </div><div class="col-sm-4"> 4 </div><div class="col-sm-4"> 3</div></div> ';
        $this->assertEquals($expected, $actual);
        
        $content  = '5  4  3  2';
        $actual   = $inlineSeparator($content, ' ', ' ');
        $expected = '<div class="row"><div class="col-sm-3">5 </div><div class="col-sm-3"> 4 </div><div class="col-sm-3"> 3 </div><div class="col-sm-3"> 2</div></div> ';
        $this->assertEquals($expected, $actual);
        
    }
}

