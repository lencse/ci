<?php

namespace Lencse\Test\Project1\Test;

use Lencse\Test\Project1\CoveredClass;
use PHPUnit\Framework\TestCase;

class CoveredClassTest extends TestCase
{

    public function testOne()
    {
        $obj = new CoveredClass();
        $this->assertEquals(1, $obj->one());
    }
}
