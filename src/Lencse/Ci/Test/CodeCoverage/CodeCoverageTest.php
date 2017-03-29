<?php

namespace Lencse\Ci\Test\CodeCoverage;

class CodeCoverageTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Code coverage test is skipped on HHVM');
        }
    }

    public function testCoverage()
    {
        $xml = new \SimpleXMLElement(file_get_contents($this->getCloverXmlFIle()));
        $metrics = $xml->xpath('//metrics');
        $total = 0;
        $covered = 0;
        foreach ($metrics as $metric) {
            $total += (int) $metric['elements'];
            $covered += (int) $metric['coveredelements'];
        }
        $this->assertGreaterThanOrEqual($this->getMinCoverage(), $covered / $total * 100);
    }

    /**
     * @return int
     */
    private function getMinCoverage()
    {
        global $argv;

        return (int)$argv[2];
    }

    /**
     * @return int
     */
    private function getCloverXmlFIle()
    {
        global $argv;

        return $argv[3];
    }
}
