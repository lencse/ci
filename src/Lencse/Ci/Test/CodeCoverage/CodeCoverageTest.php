<?php

namespace Lencse\Ci\Test\CodeCoverage;

use GetOptionKit\Option;
use GetOptionKit\OptionCollection;
use GetOptionKit\OptionParser;
use PHPUnit\Framework\TestCase;

class CodeCoverageTest extends TestCase
{

    public function setUp()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Code coverage test is skipped on HHVM');
        }
    }

    public function testCoverage()
    {
        $xml = new \SimpleXMLElement(file_get_contents($this->getCloverXmlFile()));
        $metrics = $xml->xpath('//metrics');
        $total = 0;
        $covered = 0;
        foreach ($metrics as $metric) {
            $total += (int) $metric['elements'];
            $covered += (int) $metric['coveredelements'];
        }
        $percent = $covered / $total * 100;

        $this->assertGreaterThanOrEqual(
            $this->getMinCoverage(),
            $percent,
            sprintf('Code coverage is %.2f%%, (Minimum: %d%%)', $percent, $this->getMinCoverage())
        );
    }

    /**
     * @return int
     */
    private function getMinCoverage()
    {
        $options = $this->getArgOpts();

        return $options['min-coverage']->value;
    }

    /**
     * @return string
     */
    private function getCloverXmlFile()
    {
        $options = $this->getArgOpts();

        return $options['clover-file']->value;
    }

    /**
     * @return Option[]
     */
    private function getArgOpts()
    {
        $specs = new OptionCollection();
        $specs->add('c|min-coverage:', 'Minimum coverage')->isa('Number');
        $specs->add('f|clover-file:', 'Clover XML output file')->isa('String');
        $parser = new OptionParser($specs);

        return $parser->parse($this->getTransformedArguments())->keys;
    }

    /**
     * @return string[]
     */
    private function getTransformedArguments()
    {
        global $argv;
        $result = [__FILE__];
        $parsing = false;
        foreach ($argv as $arg) {
            if ($parsing) {
                $result[] = $arg;
            }
            if ($arg == '--') {
                $parsing = true;
            }
        }

        return $result;
    }
}
