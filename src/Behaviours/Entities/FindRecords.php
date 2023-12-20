<?php

namespace Bytic\Actions\Behaviours\Entities;


use Bytic\Actions\Behaviours\HasDefaultReturn;

trait FindRecords
{
    use HasRepository;
    use HasSelectQuery;
    use HasDefaultReturn;

    public function fetch(): \Nip\Records\Collections\Collection
    {
        return $this->findAll();
    }


    protected function findAll(): \Nip\Records\Collections\Collection
    {
        $query = $this->findQuery();
        return $this->getRepository()->findByQuery($query);
    }
}