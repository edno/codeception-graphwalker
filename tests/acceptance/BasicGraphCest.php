<?php
class BasicGraphCest
{
    public function runBasicGraphTest(AcceptanceTester $I)
    {
        $I->runShellCommand('vendor/bin/codecept run mbt');
        $I->seeResultCodeIs(0);
        $I->seeInShellOutput('OK (4 tests, 4 assertions)');
    }
}
