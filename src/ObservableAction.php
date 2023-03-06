<?php

namespace Bytic\Actions;

use Bytic\Actions\Observers\Subject\Observable;
use Bytic\Actions\Observers\Subject\ObservableBehavior;
use Bytic\Actions\Observers\Subject\ObservableLogBehavior;

abstract class ObservableAction extends Action implements Observable
{
    use ObservableBehavior;
    use ObservableLogBehavior;
}