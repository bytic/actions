<?php


namespace Bytic\Actions\Observers\State;

class State
{
    protected $state;

    protected $context = [];

    /**
     * @param $state
     * @param array $context
     */
    public function __construct($state, array $context)
    {
        $this->state = $state;
        $this->context = $context;
    }

    public static function from($state, $context = []): self
    {
        if ($state instanceof static) {
            return $state;
        }

        return new static($state, $context);
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function context($key, $default = null)
    {
        return $this->context[$key] ?? $default;
    }
}