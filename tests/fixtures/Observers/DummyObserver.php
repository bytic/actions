<?php

declare(strict_types=1);

namespace Bytic\Actions\Tests\Fixtures\Observers;

use Bytic\Actions\Observers\Observers\ObserverBase;

class DummyObserver extends ObserverBase
{
    protected $states = [];

    public function onStateChange($subject, $state)
    {
        $this->states[] = $state;
    }

    public function getStates()
    {
        return $this->states;
    }
}
