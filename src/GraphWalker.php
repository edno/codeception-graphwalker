<?php
namespace edno\Codeception;

use edno\GraphYEd\Loader as GraphLoader;
use Graphp\Algorithms\ShortestPath\Dijkstra;
use Codeception\Test\Loader\LoaderInterface;
use Codeception\Test\Loader as TestLoader;

class GraphWalker implements LoaderInterface
{
  protected $graph;

  protected $parser;

  protected $tests = [];

  protected $settings = [];

  protected $path;

  public function __construct($settings = [])
  {
      if(isset($settings['path'])) {
        $this->path = $settings['path'];
      } else {
        $this->path = 'tests/';
      }
      $this->settings = $settings;
      
      $this->parser = new GraphLoader();
      $this->loader = new TestLoader($this->settings);
  }

  public function loadTests($filename)
  {
      $this->graph = $this->parser->loadContents(file_get_contents($filename));
      $shortestPath = new Dijkstra($this->graph->getVertices()->getVertexFirst());
      $path = $shortestPath->getWalkTo($this->graph->getVertices()->getVertexLast())->getGraph();
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
