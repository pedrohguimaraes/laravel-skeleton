<?php

namespace App\Abstracts;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ModelRepositoryContract;

abstract class AbstractModelRepository implements ModelRepositoryContract
{
    /**
     * Eloquent model
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Construtor da classe
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model->replicate();
    }

    public function getQuery() : Builder
    {
        return $this->model->newQuery();
    }

    public function all(array $colunas = ['*'], callable $callback = null)
    {
        $query = $this->getQuery()->select($colunas);

        if($callback) {
            $query = $callback($query);
        }

        return $query->shouldPaginate();
    }

    public function find(int $id, bool $fail = false, array $colunas = ['*'], callable $callback = null)
    {
        $query = $this->getQuery()->select($colunas)->where($this->model->getKeyName(), $id);
        if($callback) {
            $query = $callback($query);
        }
        return $fail ? $query->firstOrFail() : $query->first();
    }

    public function create(array $dados): Model
    {
        return $this->getModel()->create($dados);
    }

    public function update(array $dados, Model $model)
    {
        $model->update($dados);
        $model->refresh();
        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
        return [];
    }

    public function refresh(Model $model)
    {
        return $model->refresh();
    }

    public function getRelation(Model $model, string $relation, callable $closure = null)
    {
        $query = $model->$relation();

        if($closure) {
            $query = $closure($query);
        }

        return $query->get();
    }
}
