<?php

namespace App\Logging;

use Monolog\Handler\WhatFailureGroupHandler;
use App\Logging\LokiHandler;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\TagProcessor;
use Monolog\Logger;

class CustomLog
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {

        $handler = new WhatFailureGroupHandler(
            [
                new LokiHandler(
                    [
                        'entrypoint' => 'http://localhost:3100',
                        'context' => [
                            // Set here your globally applicable context variables
                        ],
                        'labels' => [
                            $env = "loki"
                        ],
                        'client_name' => 'loki test',
                    ]
                )
            ]
        );

        $logger->pushHandler($handler);
        $logger->pushProcessor(new MemoryUsageProcessor());
        $logger->pushProcessor(new MemoryPeakUsageProcessor());
        $logger->pushProcessor(new GitProcessor());
        $logger->pushProcessor(new TagProcessor());
        $logger->pushProcessor(new WebProcessor());
        $logger->pushProcessor(new IntrospectionProcessor());
        $logger->pushProcessor(new ProcessIdProcessor());
        $logger->pushProcessor(new HostnameProcessor());

    }
}
