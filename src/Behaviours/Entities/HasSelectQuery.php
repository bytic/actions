<?php

namespace Bytic\Actions\Behaviours\Entities;

use Nip\Records\AbstractModels\Record;
use Nip\Records\AbstractModels\RecordManager;

trait HasSelectQuery
{
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
}