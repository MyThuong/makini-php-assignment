<?php

namespace App\Traits;

trait AirtableableTrait
{
    protected $fields = [];

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}
