#!/bin/bash

vendor/bin/phpunit --configuration test/project1/phpunit.xml --bootstrap vendor/autoload.php --coverage-clover build/logs/clover1.xml
vendor/bin/phpunit --configuration test/project2/phpunit.xml --bootstrap vendor/autoload.php --coverage-clover build/logs/clover2.xml

bin/ci-cc 50 build/logs/clover1.xml
if [[ $? != 0 ]]; then
    >&2 echo "Project1 should pass"
    exit 1
fi

bin/ci-cc 50 build/logs/clover2.xml
if [[ $? == 0 ]]; then
    >&2 echo "Project2 shouldn't pass"
    exit 1
fi
