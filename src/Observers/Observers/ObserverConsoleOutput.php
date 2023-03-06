<?php

namespace Bytic\Actions\Observers\Observers;

use Psr\Log\LogLevel;
use Symfony\Component\Console\Output\Output;

class ObserverConsoleOutput
{
    protected Output $output;

    protected $types = [
        LogLevel::INFO,
        LogLevel::EMERGENCY,
        LogLevel::ALERT,
        LogLevel::CRITICAL,
        LogLevel::ERROR,
        LogLevel::WARNING,
        LogLevel::NOTICE,
        LogLevel::INFO,
        LogLevel::DEBUG,
    ];

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function onStateChange($subject, $state): void
    {
        $this->writeln($state->context('type'), $state->getState());
    }

    protected function writeln($type, $message)
    {
        $type = in_array($type, $this->types) ? $type : LogLevel::INFO;
        $this->output->writeln("<$type>$message</$type>");
    }
}