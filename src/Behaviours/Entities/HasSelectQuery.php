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
}