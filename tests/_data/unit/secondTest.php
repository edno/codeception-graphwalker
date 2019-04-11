<?php
class secondTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testSecondScenario()
    {
        $this->assertEquals("secondTest", __CLASS__);
    }
}
