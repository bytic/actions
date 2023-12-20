<?php

namespace Bytic\Actions\Behaviours\Entities;

use Nip\Records\AbstractModels\Record;

trait HasResultRecordTrait
{

    protected Record|null $resultRecord = null;

    public function getResultRecord(): Record|null
    {
        if ($this->resultRecord === null) {
            $this->resultRecord = $this->generateResultRecord();
        }
        return $this->resultRecord;
    }

    protected function generateResultRecord(): Record|null
    {
        /** @var Record $result */
        $this->resultRecord = $this->generateNewRecord();
        $this->populateResultRecord();
        return $this->resultRecord;
    }

    protected function populateResultRecord()
    {
    }

    protected function fillResultRecordWithData(array $data)
    {
    }
}