<?php

namespace Lencse\Test\Project2\Test;

use Lencse\Test\Project2\NotCoveredClass;

class NotCoveredClassTest extends \PHPUnit_Framework_TestCase
{

    public function testNothing()
    {
        $obj = new NotCoveredClass();
        //$this->assertEquals(1, $obj->one());
    }
}
