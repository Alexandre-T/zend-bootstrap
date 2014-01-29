<?php

namespace BootstrapTest;

use Bootstrap\Form\View\Helper\Group;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Group test case.
 */
class GroupTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Group
     */
    private $group;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->group = new Group();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->group = null;
        parent::tearDown();
    }

    /**
     * Tests Group->render()
     */
    public function testRender()
    {
        $expected = '<div class="form-group">Some text</div> ';
        $actual   = $this->group->render('Some text');
        $this->assertEquals($expected, $actual);
        $expected = '<div class="foo bar">Some text</div> ';
        $actual   = $this->group->render('Some text','foo bar');
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests Group->openTag()
     */
    public function testOpenTag()
    {
        $this->assertEquals('<div class="form-group">',$this->group->openTag());
        $this->assertEquals('<div class="foo bar">',$this->group->openTag('foo bar'));
    }

    /**
     * Tests Group->closeTag()
     */
    public function testCloseTag()
    {
        $this->assertEquals('</div> ',$this->group->closeTag());
    }

    /**
     * Tests Group->__invoke()
     */
    public function test__invoke()
    {
        $group = $this->group;
        $this->assertTrue(is_callable($group));
        
        $expected = '<div class="form-group">Some text</div> ';
        $actual   = $this->group->__invoke('Some text');        
        $this->assertEquals($expected, $actual);
        $actual   = $group('Some text');
        $this->assertEquals($expected, $actual);

        $expected = '<div class="foo bar">Some text</div> ';
        $actual   = $this->group->__invoke('Some text','foo bar');
        $this->assertEquals($expected, $actual);
        $actual   = $group('Some text','foo bar');
        $this->assertEquals($expected, $actual);
        
    }
}

