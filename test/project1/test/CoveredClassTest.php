<?php

namespace Lencse\Test\Project1\Test;

use Lencse\Test\Project1\CoveredClass;

class CoveredClassTest extends \PHPUnit_Framework_TestCase
{

    public function testOne()
    {
        $obj = new CoveredClass();
        $this->assertEquals(1, $obj->one());
    }
}
