<?php

namespace Bytic\Actions\Observers\Observers;

use Bytic\Actions\Observers\Subject\Observable;
use SplSubject;

trait ObserverBehavior
{
    /**
     * Trigger observer function fired by observable
     * @param Observable $observable
     */
    public function update(Observable|SplSubject $observable)
    {
        $state = $observable->getState();
        $stateName = $state->getState();
        // looks for an observer method with the state name
        if (method_exists($this, $stateName)) {
            call_user_func_array([$this, $stateName], [$observable]);
        }
        if (method_exists($this, 'onStateChange')) {
            call_user_func_array([$this, 'onStateChange'], [$observable, $state]);
        }
    }
}
