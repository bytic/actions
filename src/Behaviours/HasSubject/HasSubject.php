<?php

namespace Bytic\Actions\Behaviours\HasSubject;

trait HasSubject
{
    protected $subject;

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public static function for($subject): static
    {
        $action = new static();
        $action->setSubject($subject);
        return $action;
    }
}
