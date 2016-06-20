<?php

namespace Isswp101\Persimmon\Path;

class Path implements PathInterface
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function make()
    {
        return $this->id;
    }
}
