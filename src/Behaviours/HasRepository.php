<?php

namespace Bytic\Actions\Behaviours;

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
    public function fetch(): Record|null
    {
        $found = $this->findOne();
        return $found ?: $this->getDefault();
    }

    public function fetchAndUpdate($data = [])
    {
        $found = $this->findOne();
        if ($found)  {
            $found->fill($this->orCreateData($data));
            return $found;
        }
        return $this->getDefault();
    }

    protected function findOne(): Record|false|null
    {
        $params = $this->findParams();
        return $this->getRepository()->findOneByParams($params);
    }

    protected function findAll(): \Nip\Records\Collections\Collection
    {
        $query = $this->findQuery();
        return $this->getRepository()->findByQuery($query);
    }

    protected function findQuery(): \Nip\Database\Query\Select
    {
        $params = $this->findParams();
        return $this->getRepository()->paramsToQuery($params);
    }

    /**
     * @return array
     */
    protected function findParams(): array
    {
        return [
        ];
    }
    protected function createRecord($data): Record
    {
        $contact = $this->generateNewRecord($data);
        $contact->saveRecord();
        return $contact;
    }

    protected function generateNewRecord($data): Record
    {
        return $this->getRepository()->getNewRecord($data);
    }

    abstract protected function generateRepository(): RecordManager;

}