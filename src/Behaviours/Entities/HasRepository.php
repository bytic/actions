<?php

namespace Bytic\Actions\Behaviours\Entities;

use Nip\Records\AbstractModels\Record;
use Nip\Records\AbstractModels\RecordManager;

trait HasRepository
{
    protected ?RecordManager $repository = null;

    protected function getRepository(): RecordManager
    {
        if (!isset($this->repository)) {
            $this->initRepository();
        }
        return $this->repository;
    }

    protected function initRepository($repository = null): void
    {
        $this->repository = $repository ?? $this->generateRepository();
    }

    protected function generateNewRecord($data = []): Record
    {
        return $this->getRepository()->getNewRecord($data);
    }

    abstract protected function generateRepository(): RecordManager;

}