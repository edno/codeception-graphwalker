<?php
namespace edno\Codeception;

use edno\GraphYEd\Loader as GraphLoader;
use Codeception\Test\Loader\LoaderInterface;
use Codeception\Test\Loader as TestLoader;
use Codeception\Lib\Di;
use Codeception\Exception\ModuleConfigException;
use Codeception\Exception\TestParseException;
use Codeception\Configuration;

class GraphWalker implements LoaderInterface
{

  protected static $defaultSettings = [
      'graphwalker' => [
          'algorithm' => ''
      ],
      'path' => ''
  ];

  protected $settings = [];

  protected $graph;

  protected $parser;

  protected $tests = [];

  protected $path;

  protected $di;

  protected $algorithmClass;

  public function __construct($settings = [])
  {
      $this->settings = Configuration::mergeConfigs(self::$defaultSettings, $settings);
      $this->algorithmClass = $this->settings['graphwalker']['algorithm'];
      if($this->algorithmClass == '' ) {
        throw new ModuleConfigException(__CLASS__, 'Configuration setting "algorithm" is missing');
      }

      $this->di = new Di();

      $this->parser = new GraphLoader();
      $this->loader = new TestLoader($this->settings);
  }

  public function loadTests($filename)
  {
      try {
        $this->graph = $this->parser->loadContents(file_get_contents($filename));
        $start = $this->graph->getVertices()->getVertexFirst();
        $algorithm = $this->di->instantiate($this->algorithmClass, [$start]);
      } catch (\Exception $e) {
        throw new TestParseException(__CLASS__, $e->getMessage());
      }
      $path = $algorithm->getWalkTo($this->graph->getVertices()->getVertexLast())->getGraph();
      $steps = $path->getVertices();
      foreach($steps as $step) {
          $file = $this->path . $step->getAttribute('labels')[0];
          $this->loader->loadTest($file);
      }
      $this->tests = $this->loader->getTests();
  }

  public function getTests()
  {
      return $this->tests;
  }


  public function getPattern()
  {
      return '~\.graphml$~';
  }

  public function getGraph()
  {
      return $this->graph;
  }
}
