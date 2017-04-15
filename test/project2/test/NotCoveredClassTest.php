<?php

namespace Lencse\Test\Project2\Test;

use Lencse\Test\Project2\NotCoveredClass;
use PHPUnit\Framework\TestCase;

class NotCoveredClassTest extends TestCase
{

    public function testNothing()
    {
        $obj = new NotCoveredClass();
        //$this->assertEquals(1, $obj->one());
    }
}
