<?php

namespace Isswp101\Persimmon;

use Exception;

class RedisModel extends Model
{
    /**
     * @var string
     */
    protected static $_table;

    /**
     * @return string
     */
    public static function getTable()
    {
        return static::$_table;
    }

    /**
     * @param string $id
     * @return string
     */
    public function getPath($id = null)
    {
        return $this->getTable() . ':' . ($id ?: $this->getId());
    }

    /**
     * @throws Exception
     */
    protected function validate()
    {
        if (is_null($this->getId())) {
            throw new Exception('[id] cannot be null');
        }
    }

    /**
     * @throws Exception
     */
    protected function saving()
    {
        $this->validate();
    }
}
