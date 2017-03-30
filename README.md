# Continuous integration dev tools

[![GitHub version](https://badge.fury.io/gh/lencse%2Fci-tools.svg)](https://badge.fury.io/gh/lencse%2Fci-tools)
[![Build Status](https://travis-ci.org/lencse/ci-tools.svg?branch=master)](https://travis-ci.org/lencse/ci-tools)

## Install

Via Composer

````bash
composer require lencse/ci-tools
````

## Usage

### Checking code coverage

````bash
# Create a Clover XML output of your project with PHPUnit
phpunit --coverage-clover build/logs/clover.xml
# Check code coverage
vendor/bin/ci-test-coverage --min-coverage 95 --clover-file build/logs/clover.xml
````

#### Integrating into composer.json

````json
{
    "scripts": {
        "test-all": [
            "phpunit --coverage-clover build/logs/clover.xml",
            "vendor/bin/ci-test-coverage --min-coverage 95 --clover-file build/logs/clover.xml"
        ]
    }
}
````

````bash
composer test-all
````

## Testing

``` bash
$ composer test
```


## License

The MIT License (MIT)