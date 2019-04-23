# Codeception Graphwalker

[![Packagist](https://img.shields.io/packagist/dt/edno/codeception-graphwalker.svg?style=flat-square)](https://packagist.org/packages/edno/codeception-graphwalker)
[![Latest Version](https://img.shields.io/packagist/v/edno/codeception-graphwalker.svg?style=flat-square)](https://packagist.org/packages/edno/codeception-graphwalker)
[![Build Status](https://img.shields.io/travis/com/edno/codeception-graphwalker.svg?style=flat-square)](https://travis-ci.com/edno/codeception-graphwalker)
[![Coverage Status](https://img.shields.io/coveralls/edno/codeception-graphwalker.svg?style=flat-square)](https://coveralls.io/github/edno/codeception-graphwalker?branch=master)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/edno/codeception-graphwalker/master/LICENSE)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fedno%2Fcodeception-graphwalker.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fedno%2Fcodeception-graphwalker?ref=badge_shield)

Codeception GraphWalker brings Model-based testing into [Codeception](http://codeception.com/).

It is inspired from [GraphWalker](https://graphwalker.github.io/) and based on the library [GraPHP](https://github.com/graphp/graph).

## Minimum Requirements

- Codeception ≥ 2.4
- PHP ≥ 7.0

## Installation
The extension can be installed using [Composer](https://getcomposer.org)

```bash
$ composer require edno/codeception-graphwalker
```

## Configuration
Add the **GraphWalker** format to the list of supported format into your suite configuration file (`.suite.yml`):
```yaml
formats:
  - edno\codeception-graphwalker\GraphWalker
```

In the configuration file, declare the graph **algorithm** class to be used and the scripts **path** :
```yaml
graphwalker:
    algorithm: Graphp\Algorithms\ShortestPath\Dijkstra
    path: tests_/data/
```
*Refer to [graphp/algorithms](https://github.com/graphp/algorithms) for supported algorithms.*

## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fedno%2Fcodeception-graphwalker.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fedno%2Fcodeception-graphwalker?ref=badge_large)
