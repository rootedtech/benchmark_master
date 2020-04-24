<?php

use BenchmarkMaster\Model\Benchmark;

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
        $closure = function ($item = 'test') {
            return $item;
        };
        $benchMarker = new Benchmark('closureMethod1', $closure);
        yield 'test case 1' => ['benchmark' => $benchMarker];

        return [
            'test case 1' => ['benchmark' => $benchMarker],
            'test case 2' => [
                'benchmark' => function () {
                    $test = 'report 2';
                    return $test;
                }
            ],
            'test case 3' => [
                'benchmark' => function () {
                    $test_array = array('test', 'test', 'test', 'test', 'test');
                    return $closure = array_map(function ($item) {
                        return $item;
                    }, $test_array);
                }
            ],
            'test case 4' => [
                'benchmark' => function () {
                    $closure = function ($item) {
                        return $item;
                    };
                    $test_array = array('test', 'test', 'test', 'test', 'test');
                    return $closure = array_map($closure, $test_array);
                }
            ],
            'test case 5' => [
                'benchmark' => function () {
                    return $fn = create_function('$item', 'return $item;');
                }
            ],
            'test case 6' => function () {
                $test = 'report 6';
            }
            // Place additional test cases here if needed
        ];
    }

    /**
     * Execute benchmarks for provided dataset
     * @todo Bug in data param library preventing serializtion of objects that are non scalar or array types. Hard coded test case for now
     */
    public function benchExecute($params = [])
    {
        if (empty($params)) {
            $closure = function ($item = 'test') {
                return $item;
            };
            $benchMarker = new Benchmark('closureMethod1', $closure);
            $benchMarker->execute();
        } else {
            //TODO: Use data provider to execute multiple functions
        }


    }
}