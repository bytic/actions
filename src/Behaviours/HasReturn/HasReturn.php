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
        $this->setReturn($this->generateNewReturn());
        $this->populateReturn();
        return $this->return;
    }

    protected function generateNewReturn()
    {
        return null;
    }

    protected function populateReturn()
    {
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