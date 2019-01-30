<?php

namespace App\Core;

use Exception;
use ReflectionClass;

class Container
{
    /**
     * @var array 
     */
    protected $instances = [];

    /**
     * Mapping abstract implementations to their
     * respective concrete implementations.
     * 
     * @param $abstract
     * @param null $concrete
     */
    public function set($abstract, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }
        
        $this->instances[$abstract] = $concrete;
    }

    /**
     * Get the specified implementation out of container.
     *
     * @param $abstract
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function get($abstract, array $params = [])
    {
        if (!isset($this->instances[$abstract])) {
            $this->set($abstract);
        }

        return $this->resolve($this->instances[$abstract], $params);
    }

    public function resolve($concrete, array $params)
    {
        // In case anonymous function gets passed in.
        if ($concrete instanceof \Closure) {
            return $concrete($this, $params);
        }

        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} cannot be instantiated!");
        }

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return $reflector->newInstance();
        }

        $params = $constructor->getParameters();
        $dependencies = $this->getDependencies($params);

        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * Resolve all dependencies.
     *
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getDependencies(array $params)
    {
        $dependencies = [];

        foreach ($params as $param) {
            $dependency = $param->getClass();

            if ($dependency === null) {
                if ($param->isDefaultValueAvailable()) {
                    $dependencies[] = $param->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolved class dependency {$param->name}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }

        return $dependencies;
    }
}