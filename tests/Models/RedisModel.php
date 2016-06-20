<?php

namespace Isswp101\Persimmon\Test\Models;

use Isswp101\Persimmon\DAL\RedisDAL;
use Isswp101\Persimmon\RedisModel as Model;

class RedisModel extends Model
{
    public static $_table = 'redismodel';

    public function __construct(array $attributes = [])
    {
        $dal = new RedisDAL($this, app('redis'));

        parent::__construct($dal, $attributes);
    }

    public static function createInstance()
    {
        return new static();
    }
}
