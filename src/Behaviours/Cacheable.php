<?php

namespace Bytic\Actions\Behaviours;

use Nip\Cache\Cacheable\CanCache;
use Nip\Utility\Str;
use Nip\Utility\Time\DurationValues;

trait Cacheable
{
    use CanCache;

    public function handle()
    {
        return $this->cacheStore()->remember(
            $this->dataCacheKey(),
            $this->dataCacheTtl(),
            function () {
                return $this->generate();
            }
        );
    }

    public static function forgetCache()
    {
        $self = new self(...func_get_args());
        $self->cacheStore()->forget($self->cacheName());
    }

    protected function cacheName()
    {
        return $this->dataCacheKey();
    }

    abstract protected function generate();

    protected function dataCacheKey($key = null)
    {
        $base = Str::slug(__CLASS__);
        if ($key) {
            $base .= '.' . $key;
        }
        return $base;
    }
}