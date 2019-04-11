<?php
class firstTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testFirstScenario()
    {
        $this->assertEquals("firstTest", __CLASS__);
    }
}
