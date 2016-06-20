<?php

namespace Isswp101\Persimmon\DAL;

use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Redis\Database;
use Isswp101\Persimmon\Model;

class RedisDAL implements IDAL
{
    protected $model;
    protected $client;
    protected $emitter;

    public function __construct(Model $model, Database $client)
    {
        $this->model = $model;
        $this->client = $client;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getEventEmitter()
    {
        return $this->emitter;
    }

    public function get($id, array $options = [])
    {
        $response = $this->client->command('GET', [$this->model->getPath($id)]);

        if (is_null($response)) {
            throw new Missing404Exception();
        }

        $this->model->fill(json_decode($response, true));

        return $this->model;
    }

    public function put(array $columns = ['*'])
    {
        $this->client->command('SET', [$this->model->getPath(), $this->model->toJson()]);
    }

    public function delete()
    {
        $this->client->command('DEL', [$this->model->getPath()]);
    }
}
