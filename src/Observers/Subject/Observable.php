<?php

namespace Bytic\Actions\Observers\Subject;

use Bytic\Actions\Observers\State\State;

interface Observable extends \SplSubject
{
    public function getState(): ?State;

    public function setState(State|string $state): void;
}