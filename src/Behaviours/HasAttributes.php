<?php

namespace Bytic\Actions\Behaviours;

trait HasAttributes
{

    /**
     * @var array<string, mixed>
     */
    protected array $attributes = [];
    public static function withData(mixed $data = null)
    {
        return (new self())->setAttributes($data);
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function fillAttributes(array $attributes): self
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    public function allAttributes(): array
    {
        return $this->attributes;
    }

    public function resetAttributes(): static
    {
        $this->attributes = [];

        return $this;
    }
}