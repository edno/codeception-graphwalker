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
        $graphwalker = new  GraphWalker([
                              'graphwalker' => [
                                'algorithm' => 'Graphp\Algorithms\ShortestPath\Dijkstra',
                                'path' => 'tests/_data/'
                              ]
                            ]);
        $graphwalker->loadTests($model);
        $this->assertInstanceOf('\Fhaculty\Graph\Graph',$graphwalker->getGraph());
        $tests = $graphwalker->getTests();
        $this->assertCount(4, $tests);
        foreach($tests as $test) {
          $this->assertInstanceOf('\Codeception\Test\Unit',$test);
        }
        $this->assertStringContainsString('testFirstScenario', $tests[0]->getName());
        $this->assertStringContainsString('testFourthScenario', $tests[3]->getName());
    }

    public function testExceptionAlgorithmSettingMissing()
    {
        $this->expectException(Codeception\Exception\ModuleConfigException::class);

        $graphwalker = new  GraphWalker();
    }

    public function testExceptionAlgorithmSettingInvalid()
    {
        $this->expectException(Codeception\Exception\TestParseException::class);

        $model = codecept_data_dir().'basicgraph.graphml';
        $graphwalker = new  GraphWalker([
                              'graphwalker' => [
                                'algorithm' => 'Graphp\Algorithms\DoesNotExist',
                                'path' => 'tests/_data/'
                              ]
                            ]);
        $graphwalker->loadTests($model);
        $this->assertInstanceOf('\Fhaculty\Graph\Graph',$graphwalker->getGraph());
        $tests = $graphwalker->getTests();
    }

    public function testExceptionTestFileNotExist()
    {
        $this->expectException(Codeception\Exception\TestParseException::class);

        $model = codecept_data_dir().'doesnotexist.graphml';
        $graphwalker = new  GraphWalker([
                              'graphwalker' => [
                                'algorithm' => 'Graphp\Algorithms\ShortestPath\Dijkstra',
                                'path' => 'tests/_data/'
                              ]
                            ]);
        $graphwalker->loadTests($model);
        $this->assertInstanceOf('\Fhaculty\Graph\Graph',$graphwalker->getGraph());
        $tests = $graphwalker->getTests();
    }

    public function testExceptionTestFileInvalid()
    {
        $this->expectException(Codeception\Exception\TestParseException::class);

        $model = codecept_data_dir().'notagrapfile.graphml';
        $graphwalker = new  GraphWalker([
                              'graphwalker' => [
                                'algorithm' => 'Graphp\Algorithms\ShortestPath\Dijkstra',
                                'path' => 'tests/_data/'
                              ]
                            ]);
        $graphwalker->loadTests($model);
        $this->assertInstanceOf('\Fhaculty\Graph\Graph',$graphwalker->getGraph());
        $tests = $graphwalker->getTests();
    }

}
