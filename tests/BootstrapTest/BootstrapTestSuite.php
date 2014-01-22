<?php
require_once 'PHPUnit/Framework/TestSuite.php';

require_once 'tests/BootstrapTest/UtilTest.php';

/**
 * Static test suite.
 */
class BootstrapTestSuite extends PHPUnit_Framework_TestSuite
{

    /**
     * Constructs the test suite handler.
     */
    public function __construct()
    {
        $this->setName('BootstrapTestSuite');
        
        $this->addTestSuite('UtilTest');
    }

    /**
     * Creates the suite.
     */
    public static function suite()
    {
        return new self();
    }
}

