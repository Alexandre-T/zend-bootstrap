<?php
namespace BootstrapTest;
use Bootstrap\Util;
use \Zend\View\Helper\EscapeHtmlAttr;
use Zend\Form\Element\Button;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Util test case.
 */
class UtilTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var string
     */
    protected $words = "      one ONE two three\rFour\nfive\r\nSix\n\rseven\t  Eight    nine \f ten    ";

    /**
     *
     * @var string
     */
    protected $correct = 'one two three Four five Six seven Eight nine ten';

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Util = null;
        parent::tearDown();
    }

    /**
     * Tests Util->addWords()
     */
    public function testAddWords ()
    {
        $newWords = "      alpha  three     six   beta \n gamma     nine \t\t    alpha   delta \r  ";
        $correct = $this->correct . ' alpha beta gamma delta';
        $combined = Util::addWords($newWords, $this->words);
        $this->assertEquals($correct, $combined);
    }

    /**
     * Tests Util->removeWords()
     */
    public function testRemoveWords ()
    {
        $toRemovedWords = "      alpha  three     six   beta \n gamma  nine   nine \t\t    alpha   delta \r  ";
        $correct = "one two Four five seven Eight ten";
        $combined = Util::RemoveWords($toRemovedWords, $this->words);
        $this->assertEquals($correct, $combined);
    }

    /**
     * Tests Util->addWordsToArrayItem()
     */
    public function testAddWordsToArrayItem ()
    {
        $newWords = "      alpha  three     six   beta \n gamma     nine \t\t    alpha   delta \r  ";
        $ay = array(
                'a' => 'foo',
                'my' => $this->words,
                'b' => 'bar'
        );
        $correct = array(
                'a' => 'foo',
                'my' => $this->correct . ' alpha beta gamma delta',
                'b' => 'bar'
        );
        $combined = Util::addWordsToArrayItem($newWords, $ay, 'my');
        $this->assertEquals($correct, $combined);
    }

    /**
     * Tests Util->escapeWords()
     */
    public function testEscapeWords ()
    {
        $escaper = new EscapeHtmlAttr();
        $words = "   \n  mon&day  tues<da>y     wed\"nesday thu'rsday    fri\\day     ";
        $correct = 'mon&amp;day tues&lt;da&gt;y wed&quot;nesday thu&#x27;rsday fri&#x5C;day';
        $escaped = Util::escapeWords($words, $escaper);
        $this->assertEquals($correct, $escaped);
    }

    /**
     * Tests Util->getWordsArray()
     */
    public function testGetWordsArray ()
    {
        $correct = array(
                0 => 'one',
                2 => 'two',
                3 => 'three',
                4 => 'Four',
                5 => 'five',
                6 => 'Six',
                7 => 'seven',
                8 => 'Eight',
                9 => 'nine',
                10 => 'ten'
        );
        $wordsArray = Util::getWordsArray($this->words);
        $this->assertEquals($correct, $wordsArray);
    }

    /**
     * Tests Util->singleSpace()
     */
    public function testSingleSpace ()
    {
        $singleSpaced = Util::singleSpace($this->words);
        $expected = "one ONE two three Four five Six seven Eight nine ten";
        $this->assertEquals($expected, $singleSpaced);
    }

    /**
     * Test Util->addClassToArray()
     */
    public function testAddClassToArray ()
    {
        $array = null;
        $array = Util::addClassToArray($array, 'foo bar');
        $this->assertArrayHasKey('class', $array);
        $this->assertEquals('foo bar', $array['class']);
        
        $array = array();
        $array = Util::addClassToArray($array, 'foo bar');
        $this->assertArrayHasKey('class', $array);
        $this->assertEquals('foo bar', $array['class']);
        
        $array = array(
                'foo' => 'bar'
        );
        $array = Util::addClassToArray($array, 'foo bar');
        $this->assertArrayHasKey('class', $array);
        $this->assertEquals('foo bar', $array['class']);
        $this->assertArrayHasKey('foo', $array);
        $this->assertEquals('bar', $array['foo']);
        
        $array = array(
                'foo' => 'bar',
                'class' => 'foo three'
        );
        $array = Util::addClassToArray($array, 'foo bar');
        $this->assertArrayHasKey('class', $array);
        $this->assertEquals('foo three bar', $array['class']);
        $this->assertArrayHasKey('foo', $array);
        $this->assertEquals('bar', $array['foo']);
    }
    
    public function testIsButton(){
        $button = new Button();
        $reset = new Text('bar');
        $reset->setAttribute('type','reset');
        $submit = new Submit('foo2');
        
        $text = new Text('foo');
        
        $this->assertTrue(Util::isButton($button));
        $this->assertTrue(Util::isButton($reset));
        $this->assertTrue(Util::isButton($submit));
        $this->assertFalse(Util::isButton($text));
    }
}

