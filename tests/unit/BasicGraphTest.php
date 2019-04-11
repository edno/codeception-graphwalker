<?php

use Codeception\Util\Autoload;
use edno\Codeception\GraphWalker;

class BasicGraphTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        Autoload::addNamespace('edno\Codeception',  codecept_root_dir().'src');
    }

    public function testGetTestsFromModel()
    {
        $model = codecept_data_dir().'basicgraph.graphml';
        $graphwalker = new  GraphWalker(['path' => 'tests/_data/']);
        $graphwalker->loadTests($model);
        $this->assertInstanceOf('\Fhaculty\Graph\Graph',$graphwalker->getGraph());
        $tests = $graphwalker->getTests();
        $this->assertCount(4, $tests);
        foreach($tests as $test) {
          $this->assertInstanceOf('\Codeception\Test\Unit',$test);
        }
        $this->assertContains('testFirstScenario', $tests[0]->getName());
        $this->assertContains('testFourthScenario', $tests[3]->getName());
    }


}
