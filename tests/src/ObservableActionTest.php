<?php

namespace Bytic\Actions\Tests;

use Bytic\Actions\Tests\Fixtures\ObservableAction;
use Bytic\Actions\Tests\Fixtures\Observers\DummyObserver;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class ObservableActionTest extends AbstractTest
{
    public function test_notify()
    {
        $action = new ObservableAction();
        $observer = new DummyObserver();
        $action->attach($observer);
        $action->setState('test1');
        $action->setState('test2');

        $states = $observer->getStates();
        self::assertCount(2, $states);
        self::assertSame('test1', $states[0]->getState());
        self::assertSame('test2', $states[1]->getState());
    }

    public function test_info()
    {
        $action = new ObservableAction();
        $observer = new DummyObserver();
        $action->attach($observer);
        $action->info('test1');
        $action->warning('test2');

        $states = $observer->getStates();
        self::assertCount(2, $states);

        self::assertSame('test1', $states[0]->getState());
        self::assertSame(LogLevel::INFO, $states[0]->context('level'));

        self::assertSame('test2', $states[1]->getState());
        self::assertSame(LogLevel::WARNING, $states[1]->context('level'));
    }
}
