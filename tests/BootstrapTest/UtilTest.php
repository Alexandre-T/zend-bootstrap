<?php
use Bootstrap\Util;
use \Zend\View\Helper\EscapeHtmlAttr;

require_once 'PHPUnit/Framework/TestCase.php';


/**
 * Util test case.
 */
class UtilTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $words        = "      one  two three\rfour\nfive\r\nsix\n\rseven\t  eight    nine \f ten    ";
    
    /**
     * @var string
     */
    protected $correct      = 'one two three four five six seven eight nine ten';
    
    /**
     *
     * @var Util
     */
    private $Util;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->Util = new Util();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->Util = null;
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
     * Tests Util->addWords()
     */
    public function testAddWords()
    {
        
        $newWords           = "      alpha  three     six   beta \n gamma     nine \t\t    alpha   delta \r  ";
        $correct            = $this->correct . ' alpha beta gamma delta';
        $combined           = $this->Util->addWords($newWords, $this->words);
        $this->assertEquals($correct, $combined);
        
    }

    /**
     * Tests Util->addWordsToArrayItem()
     */
    public function testAddWordsToArrayItem()
    {
        $newWords   = "      alpha  three     six   beta \n gamma     nine \t\t    alpha   delta \r  ";
        $ay         = array(
            'a'         => 'foo',
            'my'        => $this->words,
            'b'         => 'bar',
        );
        $correct    = array(
            'a'         => 'foo',
            'my'        => $this->correct . ' alpha beta gamma delta',
            'b'         => 'bar',
        );
        $combined   = $this->Util->addWordsToArrayItem($newWords, $ay, 'my');
        $this->assertEquals($correct, $combined);
    }

    /**
     * Tests Util->escapeWords()
     */
    public function testEscapeWords()
    {
        $escaper    = new EscapeHtmlAttr();
        $words      = "   \n  mon&day  tues<da>y     wed\"nesday thu'rsday    fri\\day     ";
        $correct    = 'mon&amp;day tues&lt;da&gt;y wed&quot;nesday thu&#x27;rsday fri&#x5C;day';
        $escaped    = $this->Util->escapeWords($words, $escaper);
        $this->assertEquals($correct, $escaped);
    }

    /**
     * Tests Util->getWordsArray()
     */
    public function testGetWordsArray()
    {
        $correct    = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');
        $wordsArray = $this->Util->getWordsArray($this->words);
        $this->assertEquals($correct, $wordsArray);
    }

    /**
     * Tests Util->singleSpace()
     */
    public function testSingleSpace()
    {
        $singleSpaced   = $this->Util->singleSpace($this->words);
        $this->assertEquals($this->correct, $singleSpaced);
    }
}

