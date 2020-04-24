<?php

namespace BenchmarkMaster\Model;

/**
 * Class Model
 * Base class for all models/components
 * @package BenchmarkMaster\Model
 */
abstract class Model
{
    /**
     * @var Boolean $isValid
     */
    protected $isValid;

    public function validate()
    {
        //TODO: Identify and add generic validation here
    }

    /**
     * @param array $params
     * @todo Use params passed in to child to get custom message and type here
     */
    public function log($params = [])
    {
        // TODO: Base logging logic goes here
    }
}
