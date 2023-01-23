<?php

declare(strict_types=1);

namespace Bytic\Actions\Tests\Fixtures;

use Bytic\Actions\Action;

class BasicAction extends Action
{
    public function handle()
    {
        return 'handled';
    }
}
