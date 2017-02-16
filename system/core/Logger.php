<?php

namespace framework\core;

use SplObjectStorage;
use framework\adapter\DB;
use framework\logger\Logger as SystemLogger;
use framework\logger\routes\FileRoute;
use framework\logger\routes\DatabaseRoute;
use framework\logger\routes\SyslogRoute;

/**
 * 
 * $logger = new Logger();
 * 
 * $logger->emergency("Emergency message"); 
 * $logger->alert("Alert message");
 * $logger->critical("Critical message");
 * $logger->error("Error message");
 * $logger->warning("Warning message");        
 * $logger->notice("Notice message");
 * $logger->info("Info message");
 * $logger->debug("Debug message");
 * 
 */
class Logger extends SystemLogger
{

    public function __construct() 
    {           
        $this->routes = new SplObjectStorage();

        $this->routes->attach(new FileRoute([
            'enabled' => true,
            'filePath' => __DIR__ . '/../../data/logs/',
        ]));

        $this->routes->attach(new DatabaseRoute([
            'enabled' => false,
            'db' => DB::getInstance(),
            'table' => 'log',
        ]));

        $this->routes->attach(new SyslogRoute([
            'enabled' => false,
        ]));
    }

}