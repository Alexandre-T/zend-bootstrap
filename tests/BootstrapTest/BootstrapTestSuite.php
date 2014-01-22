<?php

namespace BootstrapTest;

require_once 'PHPUnit/Framework/TestSuite.php';


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
        $this->addTestSuite('FormUtilTest');
        $this->addTestSuite('FormTest');
    }

    /**
     * Creates the suite.
     */
    public static function suite()
    {
        return new self();
    }
}

