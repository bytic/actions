<?php

namespace Bytic\Actions\Behaviours\HasReturn;

trait HasReturn
{
    protected mixed $return;

    public function handle()
    {
        return $this->getReturn();
    }

    public function getReturn()
    {
        if ($this->returnIsSet()) {
            return $this->return;
        }
        $this->return = $this->generateReturn();
        return $this->return;
    }

    protected function generateReturn()
    {
        return null;
    }

    public function setReturn($return): self
    {
        $this->return = $return;
        return $this;
    }

    protected function returnIsSet(): bool
    {
        static $reflection;
        $reflection = $reflection ?: new \ReflectionProperty(self::class, 'return');
        return $reflection->isInitialized($this);
    }
}