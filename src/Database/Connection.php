<?php

namespace App\Database;

use App\Core\Config;

class Connection
{
    public function __construct(Config $config)
    {
        $databaseConfig = $config->get('database');

        if (!$databaseConfig) {
            throw new \Exception("Database connection cannot be established!");
        }

        $this->makeConnection($databaseConfig);
    }

    private function makeConnection($databaseConfig)
    {
        
    }
}