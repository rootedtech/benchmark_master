<?php

namespace BenchmarkMaster\Model;

use Closure;
use Exception;
use InvalidArgumentException;
use Serializable;

trait ClosureTrait
{
    /**
     * @var array
     */
    private $methods = array();

    /**
     * @param $methodName
     * @param $methodCallable
     */
    public function addMethod($methodName, $methodCallable)
    {
        if (!is_callable($methodCallable)) {
            throw new InvalidArgumentException('Second param must be callable');
        }
        $this->methods[$methodName] = Closure::bind($methodCallable, $this, get_class());
    }

    /**
     * @param $methodName
     * @param array $args
     * @return mixed
     * @throws Exception
     */
    public function __call($methodName, array $args)
    {
        if (isset($this->methods[$methodName])) {
            return call_user_func_array($this->methods[$methodName], $args);
        }

        throw new Exception('There is no method with the given name to call');
    }
}

/**
 * Class Benchmark
 *
 * The benchmarker should accept any number of PHP functions (passed as callable type and a name representing the function).
 * The benchmark should also accept an integer representing the number of times to execute each function.
 * The benchmark should execute each function the specified number of cycles and collect it's execution time in the highest possible time resolution and return a resultset which can be passed to the reporter component.
 * @package BenchmarkMaster\Model
 */
class Benchmark extends Model implements Serializable
{
    use ClosureTrait;

    /**
     * @var float $execution_time
     */
    protected $execution_time;

    /**
     * @var string $method_name
     */
    protected $methodName;

    /**
     * @var integer $iterations
     */
    protected $iterations;

    /**
     * Benchmark constructor.
     * @param $methodName
     * @param Closure $callableMethod
     */
    public function __construct(string $methodName = '', Closure $callableMethod = null, $options = [])
    {
        if (isset($methodName) and isset($callableMethod)) {
            $this->addMethod($methodName,
                $callableMethod); // USed to get around serializing closure when passing through library
            $this->methodName = $methodName;
            $this->execution_time = floatval(0);
        }

        //TODO: Add custom option handling here(e.g. iterations). Currently not needed and passed through
        if (isset($options)) {
            foreach ($options as $optionKey => $optionValue) {
                //TODO: Add custom option initialization here
            }
        }
    }

    /**
     * @param $propertyArray
     * @return Benchmark
     */
    public static function __set_state($propertyArray) // As of PHP 5.1.0
    {
        $obj = new Benchmark($propertyArray['methodName'], $propertyArray['methods']);
        $obj->execution_time = $propertyArray['execution_time'];
        $obj->isValid = $propertyArray['isValid'];
        $obj->iterations = $propertyArray['iterations'];

        return $obj;
    }

    /**
     * Validate if object instantiated correctly
     * @return bool
     */
    public function validate()
    {
        parent::validate();
        $this->isValid = isset($this->isValid) ? $this->isValid : is_callable($this->methodName);
        return $this->isValid;
    }

    /**
     * Execute Callable function
     */
    public function execute()
    {
        if ($this->isValid) {
            ($this->methodName)();
        }
    }

    /**
     * Log benchmark metrics. This is not currently use and using library default logging.
     * @param array $params
     * @todo Logging engine could be defined using base class
     */
    public function log($params = [])
    {
        $params['type'] = 'benchmark';
        $params['message'] = 'total time: ' . $this->execution_time;
        parent::log($params);
    }

    /**
     * @return array|string
     */
    public function serialize()
    {
        return serialize($this);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $temp = unserialize($serialized);

        $this->execution_time = $temp->execution_time;
        $this->isValid = $temp->isValid;
        $this->iterations = $temp->iterations;
        $this->methodName = $temp->methodName;
        $this->methods = $temp->methods;
    }

    /**
     * Returns execution time as float val
     * @return float
     */
    public function getExecutionTime(): float
    {
        return $this->execution_time;
    }
}