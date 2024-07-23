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
            $this->cacheName(),
            $this->dataCacheTtl(),
            function () {
                return $this->generateCacheData();
            }
        );
    }

    public static function forgetCache()
    {
        $self = new self(...func_get_args());
        $self->cacheStore()->delete($self->cacheName());
    }

    protected function cacheName()
    {
        return $this->dataCacheKey();
    }

    protected function dataCacheKey($key = null)
    {
        $base = Str::slug(__CLASS__);
        if ($key) {
            $base .= '.' . $key;
        }
        return $base;
    }
}