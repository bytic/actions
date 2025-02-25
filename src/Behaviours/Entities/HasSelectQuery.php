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
        $params = $this->findParams();
        $repository = $this->getRepository();
        $query = $repository->paramsToQuery($params);

        if (method_exists($repository, 'getFilterManager')) {
            $filterManager = $repository->getFilterManager();
            $session = $filterManager->createSession($this->findFilters(), microtime());
            $query = $filterManager->filterQuery($query, $session->getName());
        }
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