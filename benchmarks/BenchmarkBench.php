<?php

use BenchmarkMaster\Model\Benchmark;
use Opis\Closure\SerializableClosure;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;


/**
 * Class BenchmarkBench
 */
class BenchmarkBench
{

    /**
     * Test Case 1 Data Provider
     * @return Generator
     */
    public function provideMethods(){
        $closure        = function($item = 'test') { return $item; };
        $benchMarker    = new Benchmark('closureMethod1', $closure);
        yield 'test case 1' => ['benchmark' =>  $benchMarker];
        // Additional test cases here
    }

    /**
     * Execute bench mark for dataset
     */
    public function benchExecute(){
        $closure        = function($item = 'test') { return $item; };
        $benchMarker    = new Benchmark('closureMethod1', $closure);
        $benchMarker->execute();
    }
}