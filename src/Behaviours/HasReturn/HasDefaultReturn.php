<?php

namespace Bytic\Actions\Behaviours\HasReturn;

use Closure;

trait HasDefaultReturn
{
    protected $defaultReturn = null;

    /**
     * @param null|Closure|mixed $default
     * @return $this
     */
    public function orReturn($default = null): self
    {
        $this->defaultReturn = $default;

        return $this;
    }

    protected function getDefaultReturn()
    {
        return $this->defaultReturn instanceof Closure ? ($this->defaultReturn)() : $this->defaultReturn;
    }
}