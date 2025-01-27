<?php

namespace Bytic\Actions\Behaviours\Entities;

use Nip\Records\AbstractModels\Record;
use Nip\Records\AbstractModels\RecordManager;

trait HasSelectQuery
{
    protected $query = null;

    public function findQuery(): \Nip\Database\Query\Select
    {
        if (!isset($this->query)) {
            $this->query = $this->generateQuery();
        }

        return $this->query;
    }

    protected function generateQuery(): \Nip\Database\Query\Select
    {
        $filterManager = $this->getRepository()->getFilterManager();
        $session = $filterManager->createSession($this->findFilters(), microtime());
        $query = $this->getRepository()->paramsToQuery($this->findParams());
        $query = $filterManager->filterQuery($query, $session->getName());
        return $query;
    }

    protected function findFilters()
    {
        return null;
    }

    /**
     * @return array
     */
    protected function findParams(): array
    {
        return [
        ];
    }
}