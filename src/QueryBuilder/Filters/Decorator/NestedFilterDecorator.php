<?php

namespace Isswp101\Persimmon\QueryBuilder\Filters\Decorator;

use Isswp101\Persimmon\QueryBuilder\Filters\Filter;

class NestedFilterDecorator extends FilterDecorator
{
    protected $field;

    public function __construct(Filter $filter, $field)
    {
        parent::__construct($filter);
        $this->field = $field;
    }

    public function query($values)
    {
        $query = [
            'nested' => [
                'path' => $this->field,
                'filter' => $this->filter->query($values),
            ]
        ];
        return $query;
    }
}