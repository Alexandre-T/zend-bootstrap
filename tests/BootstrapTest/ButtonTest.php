<?php
namespace BootstrapTest;

use Bootstrap\Form\View\Helper\Element\Button;
use Zend\Form\Element\Button as ElementButton;

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Button test case.
 */
class ButtonTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var ElementButton
     */
    private $button1;
    /**
     *
     * @var ElementButton
     */
    private $button2;
    /**
     *
     * @var ElementButton
     */
    private $button3;
    /**
     *
     * @var ElementButton
     */
    private $button4;
    /**
     *
     * @var ElementButton
     */
    private $button5;
    /**
     * 
     * @var Button
     */
    private $buttonHelper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        $this->button1 = new ElementButton('button1');
        $this->button2 = new ElementButton('button2');

        $this->button5 = new ElementButton('button5');
        $this->buttonHelper = new Button();
        
        $this->button2->setOptions(array(
        	Button::BUTTON_ACTIVE => true,
            Button::BUTTON_BLOCK  => true,
            Button::BUTTON_OPTION => Button::BUTTON_OPTION_SUCCESS,
            Button::BUTTON_SIZE   => Button::BUTTON_SIZE_LG,
        ));
        
        $this->button3 = clone ($this->button2);
        $this->button3->setName('button3');
        $this->button3->setAttribute('class', 'foo bar');
        
        $this->button4 = new ElementButton('button4',array(
    		Button::BUTTON_ACTIVE => false,
    		Button::BUTTON_BLOCK  => false,
    		Button::BUTTON_OPTION => Button::BUTTON_OPTION_DEFAULT,
    		Button::BUTTON_SIZE   => Button::BUTTON_SIZE_DEFAULT,
        ));
        
        $this->button5 = new ElementButton('button5',array(
        		Button::BUTTON_ACTIVE => 'foo',
        		Button::BUTTON_BLOCK  => 'bar',
        		Button::BUTTON_OPTION => 'foo',
        		Button::BUTTON_SIZE   => 'bar',
        ));
        $this->button5->setValue(17);
        
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->button1 = null;
        $this->button2 = null;
        $this->button3 = null;
        $this->button4 = null;
        $this->button5 = null;
        $this->buttonHelper = null;
        parent::tearDown();
    }

    /**
     * Tests Button->openTag()
     */
    public function testOpenTag ()
    {
        $this->assertEquals('<button class="btn btn-default">',$this->buttonHelper->openTag(null));
        $expected = '<button class="foo btn btn-default">';
        $actual = $this->buttonHelper->openTag(array('class' => 'foo'));
        $this->assertEquals($expected, $actual);
        $expected = '<button class="foo btn btn-default" type="submit">';
        $actual = $this->buttonHelper->openTag(array('class' => 'foo','type' => 'submit','foo'=>'bar'));
        $this->assertEquals($expected, $actual);
        
        $expected = '<button type="button" name="button1" class="btn-default btn">';
        $this->assertEquals($expected, $this->buttonHelper->openTag($this->button1));
        
        $expected = '<button type="button" name="button2" class="btn-success btn-lg btn-block active btn">';
        $this->assertEquals($expected, $this->buttonHelper->openTag($this->button2));

        $expected = '<button type="button" name="button3" class="btn-success btn-lg btn-block active btn foo bar">';
        $this->assertEquals($expected, $this->buttonHelper->openTag($this->button3));
        
        $expected = '<button type="button" name="button4" class="btn-default btn">';
        $this->assertEquals($expected, $this->buttonHelper->openTag($this->button4));
        
        $expected = '<button type="button" name="button5" class="btn-default btn-block active btn" value="17">';
        $this->assertEquals($expected, $this->buttonHelper->openTag($this->button5));
    }
}

