<?php

namespace BenchmarkMaster\Model;

/**
 * Class Model
 * @package BenchmarkMaster\Model
 */
abstract class Model implements Loggable
{
    public function validate(){}
    public function log($params = [])
    {
        // TODO: Implement log() method.
    }
}
