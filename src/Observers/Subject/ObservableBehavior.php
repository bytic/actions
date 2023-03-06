<?php

namespace Bytic\Actions\Observers\Subject;

use Bytic\Actions\Observers\State\State;
use SplObserver;

trait ObservableBehavior
{
    /** All attached observers
     * @var SplObserver[]
     */
    protected array $observers = [];

    /** Current state of observable object */
    protected State|null $state = null;

    public function attachAll(array $observers): void
    {
        foreach ($observers as $observer) {
            $this->attach($observer);
        }
    }

    /**
     * Attach an observer to the set of observers for this object.
     *
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer): void
    {
        $objectId = spl_object_hash($observer);
        $this->observers[$objectId] = $observer;
    }

    /**
     * Detach an observer from the set of observers for this object.
     *
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer): void
    {
        $objectId = spl_object_hash($observer);
        unset($this->observers[$objectId]);
    }

    /**
     * Notify all of this object's observers.
     */
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getObservers(): array
    {
        return $this->observers;
    }

    /**
     * Detaches all observers.
     */
    public function detachAll(): void
    {
        $this->observers = [];
    }

    /**
     * Magic method called before object unserialization to return the names of all properties to be serialized.
     *
     * @return array
     */
    public function __sleep(): array
    {
        // We don't want observers to be serialized, since the reference to current objects are broken
        $allObjectProperties = array_keys(get_object_vars($this));
        $exclude = ['observers'];
        $objectPropertiesToSerialize = array_diff($allObjectProperties, $exclude);

        return $objectPropertiesToSerialize;
    }

    /**
     * @return State
     */
    public function getState(): ?State
    {
        return $this->state;
    }

    /**
     * @param State|string $state
     */
    public function setState(State|string $state): void
    {
        $this->state = State::from($state);
        $this->notify();
    }
}