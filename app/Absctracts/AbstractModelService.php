<?php

namespace App\Abstracts;

abstract class AbstractModelService
{

    protected $repository;

    protected $repositoryHooks = [
        'all',
        'find',
        'create',
        'update',
        'delete',
        'refresh'
    ];

    public function __construct($repository)
    {
        $this->repository = $repository;
        $this->changeRepositoryHooks();
    }
    protected function changeRepositoryHooks() : void {}

    public function __call($method, $arguments)
    {
        if(in_array($method, $this->repositoryHooks))
        {
            return call_user_func_array([$this->repository, $method], $arguments);
        }
    }
}
