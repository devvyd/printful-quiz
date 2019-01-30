<?php

namespace App\Core;

class Config
{
    /**
     * @var mixed
     */
    private $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
    }

    /**
     * Resolve a config value from application config.
     *
     * @param string $key
     * @return null
     */
    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }
}