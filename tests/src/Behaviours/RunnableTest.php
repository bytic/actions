<?php

declare(strict_types=1);

namespace Bytic\Actions\Tests\Behaviours;

use Bytic\Actions\Tests\Fixtures\BasicAction;
use PHPUnit\Framework\TestCase;

class RunnableTest extends TestCase
{
    public function test_run()
    {
        self::assertSame('handled', BasicAction::run());
    }
}
