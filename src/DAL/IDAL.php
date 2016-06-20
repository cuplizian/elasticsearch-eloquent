<?php

namespace Isswp101\Persimmon\DAL;

use Isswp101\Persimmon\Event\EventEmitter;
use Isswp101\Persimmon\Path\PathInterface;

interface IDAL
{
    /**
     * Get event emitter.
     * 
     * @return EventEmitter
     */
    public function getEventEmitter();

    /**
     * @param PathInterface $path
     * @param array $options
     * @return array
     */
    public function get(PathInterface $path, array $options = []);

    /**
     * @param PathInterface $path
     * @param array $body
     * @param array $columns
     * @return mixed Inserted id.
     */
    public function put(PathInterface $path, array $body, array $columns = ['*']);

    /**
     * @param PathInterface $path
     * @return mixed
     */
    public function delete(PathInterface $path);
}
