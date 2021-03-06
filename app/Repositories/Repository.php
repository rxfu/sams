<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;
use App\Exceptions\InvalidRequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository
{
    protected $model;

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function find($id, $trashed = false)
    {
        try {
            if ($trashed) {
                return $this->model->withTrashed()->findOrFail($id);
            }

            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function findAll($orders = null, $trashed = false)
    {
        try {
            return $this->queryBy(null, null, $orders, $trashed)->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function findWith($relations, $orders = null, $trashed = false)
    {
        try {
            return $this->queryBy(null, $relations, $orders, $trashed)->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function findBy($attributes, $relations = null, $orders = null, $trashed = false)
    {
        try {
            return $this->queryBy($attributes, $relations, $orders, $trashed)->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function queryBy($attributes = null, $relations = null, $orders = null, $trashed = false)
    {
        $query = $this->model;

        if (!is_null($relations)) {
            $relations = is_array($relations) ? $relations : [$relations];

            $query = $query->with($relations);
        }

        if (!is_null($attributes)) {
            $query = $this->parseAttributes($query, $attributes);
        }

        $query = $this->parseOrders($query, $orders);

        if ($trashed) {
            $query = $query->withTrashed();
        }

        return $query;
    }

    public function get($query)
    {
        try {
            return $query->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function paginate($query, $limit)
    {
        try {
            return $query->paginate($limit);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function save($attributes)
    {
        try {
            $attributes = is_array($attributes) ? $attributes : [$attributes];
            $object = $this->model->create($attributes);

            if (!$object) {
                throw new InvalidRequestException(500001, $this->getModel(), __FUNCTION__);
            } else {
                return $object;
            }
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function update($id, $attributes)
    {
        try {
            $object = $this->find($id);
            $attributes = is_array($attributes) ? $attributes : [$attributes];

            if (false === $object->update($attributes)) {
                throw new InvalidRequestException(500002, $this->getModel(), __FUNCTION__);
            }

            return $object;
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function delete($id, $force = false)
    {
        $object = $this->find($id);
        $success =  $force ? $object->forceDelete() : $object->delete();

        if (is_null($success) || (false === $success)) {
            throw new InvalidRequestException(500003, $this->getModel(), __FUNCTION__);
        }

        return $success;
    }

    public function deleteAll($ids, $force = false)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        $count = 0;

        foreach ($ids as $id) {
            if ($this->delete($id, $force)) {
                $count++;
            }
        }

        return $count;
    }

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }

    protected function parseAttributes($query, $attributes)
    {
        $attributes = is_array($attributes) ? $attributes : [$this->model->getKeyName() => $attributes];

        foreach ($attributes as $field => $attribute) {
            $attribute = is_array($attribute) ? $attribute : ['=', $attribute];

            if ('in' === Str::lower(trim($attribute[0]))) {
                $values = is_array($attribute[1]) ? $attribute[1] : [$attribute[1]];

                $query = $query->whereIn($field, $values);
            } elseif ('not in' === Str::lower(trim($attribute[0]))) {
                $values = is_array($attribute[1]) ? $attribute[1] : [$attribute[1]];

                $query = $query->whereNotIn($field, $values);
            } elseif ('null' === Str::lower(trim($attribute[0]))) {
                $query = $query->whereNull($field);
            } elseif ('not null' === Str::lower(trim($attribute[0]))) {
                $query = $query->whereNotNull($field);
            } elseif (('like' === Str::lower($attribute[0]) && (0 !== Str::length(trim($attribute[1], '%'))))
                || ('like' !== Str::lower($attribute[0])) && (0 !== Str::length($attribute[1]))
            ) {
                $query = $query->where($field, $attribute[0], $attribute[1]);
            }
        }

        return $query;
    }

    protected function parseOrders($query, $orders)
    {
        $orders = is_null($orders) ? $this->model->getKeyName() : $orders;
        $orders = is_array($orders) ? $orders : [$orders => 'asc'];

        foreach ($orders as $attribute => $direction) {
            if (is_numeric($attribute)) {
                $query = $query->orderBy($direction, 'asc');
            } else {
                $query = $query->orderBy($attribute, $direction);
            }
        }

        return $query;
    }
}
