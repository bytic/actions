<?php

namespace Bytic\Actions\Behaviours\Entities;

use Bytic\Actions\Behaviours\HasDefaultReturn;
use Nip\Records\AbstractModels\Record;

trait FindRecord
{
    use HasRepository;
    use HasSelectQuery;
    use HasDefaultReturn;
    use HasResultRecordTrait;

    public function fetch(): Record|null
    {
        $found = $this->findOne();
        return $found ?: $this->getDefaultReturn();
    }

    public function fetchAndUpdate($data = [])
    {
        $found = $this->findOne();
        if ($found) {
            $found->fill($this->orCreateData($data));
            return $found;
        }
        return $this->getDefaultReturn();
    }

    protected function findOne(): Record|false|null
    {
        $params = $this->findParams();
        return $this->getRepository()->findOneByParams($params);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function orCreate(array $data = []): self
    {
        $data = $this->orCreateData($data);
        $this->orReturn(function () use ($data) {
            return $this->createRecord($data);
        });

        return $this;
    }

    protected function orCreateData($data)
    {
        return $data;
    }


    protected function createRecord($data): Record
    {
        $contact = $this->generateNewRecord($data);
        $contact->saveRecord();
        return $contact;
    }
}