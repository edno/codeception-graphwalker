<?php
class thirdTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testThirdScenario()
    {
        $this->assertEquals("thirdTest", __CLASS__);
    }
}
