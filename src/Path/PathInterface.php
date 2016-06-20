<?php

namespace Isswp101\Persimmon\Path;

use Isswp101\Persimmon\Contracts\Arrayable;

interface PathInterface extends Arrayable
{
    /**
     * @return mixed
     */
    public function make();
}
