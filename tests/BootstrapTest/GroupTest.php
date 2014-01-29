<?php

namespace BootstrapTest;

use Zend\Form\Element\Text;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Button;
use Bootstrap\Form\View\Helper\Group;
use Zend\Form\Element\Submit;

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
        $actual   = $this->group->render(new Text('name'),'Some text');
        $this->assertEquals($expected, $actual);
        $expected = 'Some text';
        $this->assertEquals($expected, $this->group->render(new Hidden('name'),'Some text'));
        $this->assertEquals($expected, $this->group->render(new Button('name'),'Some text'));
        $this->assertEquals($expected, $this->group->render(new Csrf('name'),'Some text'));
        $this->assertEquals($expected, $this->group->render(new Submit('name'),'Some text'));
    }

    /**
     * Tests Group->openTag()
     */
    public function testOpenTag()
    {
        $this->assertEquals('<div class="form-group">',$this->group->openTag());
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
        $actual   = $this->group->__invoke(new Text('name'),'Some text');
        $this->assertEquals($expected, $actual);

        $expected = 'Some text';
        $actual   = $this->group->__invoke(new Button('name'),'Some text');
        $this->assertEquals($expected, $actual);
        
        $expected = '<div class="form-group">Some text</div> ';
        $actual   = $group(new Text('name'),'Some text');
        $this->assertEquals($expected, $actual);
        
        $expected = 'Some text';
        $actual   = $group(new Button('name'),'Some text');
        $this->assertEquals($expected, $actual);
        
    }
}

