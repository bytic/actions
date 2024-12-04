<?php

namespace Bytic\Actions\Behaviours;

use Nip\Cache\Cacheable\CanCache;

trait Cacheable
{
    use CanCache;

    public function handle()
    {
        return $this->getDataFromCache();
    }

    public static function forgetCache()
    {
        $self = new self(...func_get_args());
        $self->cacheStore()->delete($self->cacheName());
    }
}