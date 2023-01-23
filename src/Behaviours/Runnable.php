<?php

namespace Bytic\Actions\Behaviours;

trait Runnable
{

    /**
     * @return static
     */
    public static function make(): static
    {
        if (function_exists('app')) {
            return app(static::class);
        }
        return new static();
    }

    /**
     * @see static::handle()
     * @param mixed ...$arguments
     * @return mixed
     */
    public static function run(...$arguments)
    {
        $instance = static::make();
        if (method_exists($instance, 'handle')) {
            return $instance->handle(...$arguments);
        }
        if (is_callable($instance)) {
            return $instance(...$arguments);
        }

        throw new \RuntimeException('Action must implement handle() or be callable');
    }

    /**
     * @param $boolean
     * @param ...$arguments
     * @return mixed|null
     */
    public static function runIf($boolean, ...$arguments)
    {
        return $boolean ? static::run(...$arguments) : null;
    }

    /**
     * @param $boolean
     * @param ...$arguments
     * @return mixed|null
     */
    public static function runUnless($boolean, ...$arguments)
    {
        return static::runIf(! $boolean, ...$arguments);
    }
}
